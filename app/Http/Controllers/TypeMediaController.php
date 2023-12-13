<?php

namespace App\Http\Controllers;

use App\Models\TypeMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class TypeMediaController extends Controller
{
    public function index()
    {
        $data = TypeMedia::orderby('created_at')->get();
        return view('type_media.list',compact('data'));
    }
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'desc'=>'required|string'
        ]);
        $id = TypeMedia::generateID();
        TypeMedia::create([
            'type_media_id' => $id,
            'name' => $request->name,
            'desc' => $request->desc

        ]);
        return redirect()->back();
    }
    public function fetchData(Request $request)
    {
        $id = $request->input('id');
        $data = TypeMedia::find($id);
        return response()->json($data);
    }
    public function update(Request $request, $id)
    {
        $data = TypeMedia::find($id);
        $data->name = $request->name;
        $data->desc = $request->desc;
        $data->save();
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


}
