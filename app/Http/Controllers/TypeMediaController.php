<?php

namespace App\Http\Controllers;

use App\Models\TypeMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class TypeMediaController extends Controller
{
    public function index()
    {
        $data = TypeMedia::orderby('created_at')->get();
        return view('type_media.list',compact('data'));
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'desc'=>'required'
        ]);
        if ($validator->fails()) {
            Alert::error('เกิดข้อผิดพลาด', 'กรอกข้อมูลไม่ครบ กรุณากรอกข้อมูลให้ครบถ้วน');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if(TypeMedia::where('name',$request->name)->count() > 0){
            Alert::error('เกิดข้อผิดพลาด', 'มีรายการนี้อยู่แล้ว');
                return redirect()->back()->withErrors($validator)->withInput();
        }

        $id = TypeMedia::generateID();
        TypeMedia::create([
            'type_media_id' => $id,
            'name' => $request->name,
            'desc' => $request->desc

        ]);
        Alert::success('บันทึกสำเร็จ');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $dataExists = TypeMedia::where('name', $request->name)->where('type_media_id', '!=', $id)->exists();
        if(!$dataExists){
            $data = TypeMedia::find($id);
            $data->name = $request->name;
            $data->desc = $request->desc;
            $data->save();
            Alert::success('บันทึกสำเร็จ');
            return redirect()->back();
        }
        Alert::error('เกิดข้อผิดพลาด', 'มีรายการนี้อยู่แล้ว');
        return redirect()->back();

    }
    public function delete($id){
        try {
            DB::beginTransaction();
            $data = TypeMedia::find($id);
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

    public function fetchData(Request $request)
    {
        $id = $request->input('id');
        $data = TypeMedia::find($id);
        return response()->json($data);
    }


}
