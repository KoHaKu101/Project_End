<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emp;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;


class EmpController extends Controller
{
    public function index()
    {
        $data = Emp::orderByRaw("CAST(SUBSTRING(emp_id FROM 4) AS SIGNED) ASC")->get();
        $statusArray = array(1=>'เจ้าหน้าที่ฝ่ายผลิต',2=>'เจ้าหน้าที่ฝ่ายบริการ',3=>'ผู้จัดการระบบ');
        return view('emp.list',compact('data','statusArray'));
    }
    public function create(Request $request){
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
                'address'=> $request->address            
            ]);
            Alert::success('บันทึกสำเร็จ');
            return redirect()->back();
        
    }
    public function fetchData(Request $request)
    {
        $id = $request->input('id');
        $data = Emp::find($id);
        return response()->json($data);
    }
    public function update(Request $request,$id){
        $data = Emp::find($id);
            if(is_Null($request->password)){
                    $data->username = $request->username;
                    $data->f_name = $request->f_name;
                    $data->l_name = $request->l_name;
                    $data->gender = $request->gender;
                    $data->birthday = $request->birthday;
                    $data->age = $request->age;
                    $data->id_card = $request->id_card;
                    $data->tel = $request->tel;
                    $data->status = $request->status;
                    $data->address= $request->address;      
                $data->save();
            }else{
                $data->update($request->all());
            }
        Alert::success('บันทึกสำเร็จ');
        return redirect()->back();
    }
    
}
