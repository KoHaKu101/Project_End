<?php

namespace App\Http\Controllers;

use App\Models\RequestUser;
use App\Models\RequestMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use RealRashid\SweetAlert\Facades\Alert;

class RequestUserController extends Controller
{
    //
    public function index(){
        $data = RequestUser::orderby('f_name')->get();
        $dataRequestMedia = RequestMedia::select('requesters_id','status')->get();
        return view('request_user.list',compact('data','dataRequestMedia'));
    }
    public function create(Request $request){
        $f_name = $request->f_name;
        $l_name = $request->l_name;
        $dataRequestUser = RequestUser::where('f_name',$f_name)->where('l_name',$l_name)->count();
        if($dataRequestUser > 0){
            Alert::error('มีผู้ขอสื่อชื่อนี้แล้ว');
            return redirect()->back();
        }
        $requesters_id  = RequestUser::generateID();
        RequestUser::create([
            "requesters_id"=>$requesters_id,
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
    public function update($id,Request $request){
        $f_name = $request->f_name;
        $l_name = $request->l_name;
        $dataRequestUser = RequestUser::where('f_name',$f_name)->where('l_name',$l_name)->count();
        if($dataRequestUser > 0){
            $data = [
                "id_card" => $request->id_card,
                "birthday" => $request->birthday,
                "age" => $request->age,
                "gender" => $request->gender,
                "tel" => $request->tel,
            ];
        }else{
            $data = [
                "id_card" => $request->id_card,
                "f_name" => $f_name,
                "l_name" => $l_name,
                "birthday" => $request->birthday,
                "age" => $request->age,
                "gender" => $request->gender,
                "tel" => $request->tel,
            ];
        }
        RequestUser::find($id)->update($data);
        Alert::success('แก้ไขรายการสำเร็จ');
        return redirect()->back();
    }
    public function delete($id){
        try {
            DB::beginTransaction();
            $data = RequestUser::find($id);
            if(RequestMedia::where('requesters_id',$data->requesters_id)->count() > 0){
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
    public function fetchData($id){
        $data = RequestUser::find($id);
        return response()->json($data);
    }
}
