<?php

namespace App\Http\Controllers;

use App\Models\TypeBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class TypeBookController extends Controller
{
    //
    public function index()
    {
        $data = TypeBook::orderby('created_at')->get();
        return view('type_book.list', compact('data'));
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if ($validator->fails()) {
            Alert::error('เกิดข้อผิดพลาด', 'กรอกข้อมูลไม่ครบ กรุณากรอกข้อมูลให้ครบถ้วน');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if (TypeBook::where('name', $request->name)->count() > 0) {
            Alert::error('เกิดข้อผิดพลาด', 'มีรายการนี้อยู่แล้ว');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $id = TypeBook::generateID();
        TypeBook::create([
            'type_book_id' => $id,
            'name' => $request->name
        ]);

        Alert::success('บันทึกสำเร็จ');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $dataExists = TypeBook::where('name', $request->name)->where('type_book_id', '!=', $id)->exists();
        if (!$dataExists) {
            $data = TypeBook::find($id);
            $data->name = $request->name;
            $data->save();
            Alert::success('บันทึกสำเร็จ');
            return redirect()->back();
        }
        Alert::error('เกิดข้อผิดพลาด', 'มีรายการนี้อยู่แล้ว');
        return redirect()->back();
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $data = TypeBook::find($id);
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
        $data = TypeBook::find($id);
        return response()->json($data);
    }
}
