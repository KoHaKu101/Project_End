<?php

namespace App\Http\Controllers;

use App\Models\Emp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;


class EmpController extends Controller
{
    public function index(Request $request)
    {
        $search_data = $request->search_data != '' ? $request->search_data : '';

        $data = Emp::where('f_name', 'like', "%$search_data%")
            ->orWhere('l_name', 'like', "%$search_data%")
            ->orWhere('emp_id', 'like', "%$search_data%")
            ->orWhere('tel', 'like', "%$search_data%")
            ->orderByRaw("CAST(SUBSTRING(emp_id FROM 4) AS SIGNED) ASC")->paginate(10);

        $statusArray = array(1 => 'เจ้าหน้าที่ฝ่ายผลิต', 2 => 'เจ้าหน้าที่ฝ่ายบริการ', 3 => 'ผู้จัดการระบบ');
        return view('emp.list', compact('data', 'statusArray', 'search_data'));
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
            'f_name' => 'required',
            'l_name' => 'required',
            'gender' => 'required',
            'birthday' => 'required',
            'age' => 'required',
            'id_card' => 'required',
            'tel' => 'required',
            'status' => 'required',
            'address' => 'required',
        ]);
        if ($validator->fails()) {
            Alert::error('เกิดข้อผิดพลาด', 'กรอกข้อมูลไม่ครบ กรุณากรอกข้อมูลให้ครบถ้วน');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if (Emp::whereIn('username', [$request->username])->orWhereIn('id_card', [$request->id_card])->exists()) {
            $errorMessages = [];
            if (Emp::where('username', $request->username)->exists()) {
                $errorMessages[] = 'มี username นี้อยู่แล้ว';
            }
            if (Emp::where('id_card', $request->id_card)->exists()) {

                $errorMessages[] = 'มี รหัสประจำตัวประชาชน นี้อยู่แล้ว';
            }
            Alert::error('เกิดข้อผิดพลาด', implode(' ', $errorMessages));
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if (str($request->id_card)->length() < 13) {
            Alert::error('เกิดข้อผิดพลาด', 'กรุณากรอกรหัสบัตรประชาชนให้ถูกต้อง');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $id = Emp::generateID();
        Emp::create([
            'emp_id' => $id,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'age' => $request->age,
            'id_card' => $request->id_card,
            'tel' => $request->tel,
            'status' => $request->status,
            'address' => $request->address
        ]);
        Alert::success('บันทึกสำเร็จ');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $data = Emp::find($id);
        $idCardExists = Emp::where('id_card', $request->id_card)->where('emp_id', '!=', $id)->exists();
        if (!$idCardExists) {
            // Update the data
            $data->f_name = $request->f_name;
            $data->l_name = $request->l_name;
            $data->gender = $request->gender;
            $data->birthday = $request->birthday;
            $data->age = $request->age;
            $data->id_card = $request->id_card;
            $data->tel = $request->tel;
            $data->status = $request->status;
            $data->address = $request->address;
            $data->save();

            Alert::success('บันทึกสำเร็จ');
        } else {
            Alert::error('เกิดข้อผิดพลาด', 'มี รหัสประจำตัวประชาชน นี้อยู่แล้วในระบบ');
        }
        return redirect()->back();
    }
    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $data = Emp::find($id);
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
        $data = Emp::find($id);
        return response()->json($data);
    }
}
