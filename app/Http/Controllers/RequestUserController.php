<?php

namespace App\Http\Controllers;

use App\Models\RequestUser;
use App\Models\RequestMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class RequestUserController extends Controller
{
    //
    public function index(Request $request)
    {
        $data = RequestUser::orderby('f_name')->get();
        $search = '';
        if(!is_null($request->search)){
            $search = $request->search;
            $data = RequestUser::where('f_name','like','%'.$search.'%')->orWhere('l_name','like','%'.$search.'%')->orderby('f_name')->get();
        }
        $dataRequestMedia = RequestMedia::select('requesters_id', 'status')->get();
        return view('request_user.list', compact('data', 'dataRequestMedia','search'));
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'f_name' => 'required',
            'l_name' => 'required',
            'tel' => 'required',
        ]);
        if ($validator->fails()) {
            Alert::error('เกิดข้อผิดพลาด', 'กรุณากรอกข้อมูลให้ครบถ้วน');
            return redirect()->back();
        }
        $f_name = $request->f_name;
        $l_name = $request->l_name;
        $dataRequestUser = RequestUser::where('f_name', $f_name)->where('l_name', $l_name)->count();
        if ($dataRequestUser > 0) {
            Alert::error('เกิดข้อผิดพลาด', 'ชื่อ และนามสกุลซ้ำกัน');
            return redirect()->back();
        }
        $requesters_id  = RequestUser::generateID();
        RequestUser::create([
            "requesters_id" => $requesters_id,
            "id_card" => $request->id_card,
            "f_name" => $f_name,
            "l_name" => $l_name,
            "birthday" => $request->birthday,
            "age" => $request->age,
            "gender" => $request->gender,
            "tel" => $request->tel,
        ]);
        Alert::success('บันทึกรายการสำเร็จ');
        return redirect()->back();
    }
    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'f_name' => 'required',
            'l_name' => 'required',
            'tel' => 'required',
        ]);
        if ($validator->fails()) {
            Alert::error('เกิดข้อผิดพลาด', 'กรุณากรอกข้อมูลให้ครบถ้วน');
            return redirect()->back();
        }
        $f_name = $request->f_name;
        $l_name = $request->l_name;
        $id_card = $request->id_card;
        $idCardExists = RequestUser::where('id_card', $id_card)->where('requesters_id','!=',$id)->exists();
        $requestUserExists = RequestUser::where('f_name', $f_name)->where('l_name', $l_name)->where('requesters_id','!=',$id)->exists();
        if($idCardExists){
            Alert::error('เกิดข้อผิดพลาด', 'รหัสบัตรประชาชนนี้มีอยู๋แล้ว');
            return redirect()->back();
        }
        if($requestUserExists){
            Alert::error('เกิดข้อผิดพลาด', 'ชื่อ และนามสกุลซ้ำกัน');
            return redirect()->back();
        }
        $data = [
            'id_card' => $id_card,
            'f_name' => $f_name,
            'l_name' => $l_name,
            "birthday" => $request->birthday,
            "age" => $request->age,
            "gender" => $request->gender,
            "tel" => $request->tel,

        ];
        RequestUser::find($id)->update($data);
        Alert::success('แก้ไขรายการสำเร็จ');
        return redirect()->back();

    }
    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $data = RequestUser::find($id);
            if (RequestMedia::where('requesters_id', $data->requesters_id)->count() > 0) {
                return response()->json(['error' => 'รายการถูกใช้งานอยู่ไม่สามารถลบได้'], 422);
            }
            // คำสั่งลบ
            $data->delete();
            DB::commit();
            // แสดงค่าลบรายการสำเร็จ
            return response()->json(['message' => 'ลบรายการสำเร็จ']);
        } catch (QueryException $e) {
            //ไว้สำหรับลบข้อมูลไม่สำเร็จและข้อมูลไม่หายไป
            DB::rollBack();
            // เช็คค่าหากมี fk ที่ใช้อยู่จะแจ้งเตือน
            if ($e->getCode() == 23000) {
                // Display a SweetAlert with a custom error message
                return response()->json(['error' => 'รายการถูกใช้งานอยู่ไม่สามารถลบได้'], 422);
            }
            // หากเกิด error อื่นๆขึ้น
            return response()->json(['error' => 'An error occurred while deleting the record.'], 500);
        }
    }
    public function fetchData($id)
    {
        $data = RequestUser::find($id);
        return response()->json($data);
    }
}
