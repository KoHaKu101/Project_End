<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emp;
use Illuminate\Support\Facades\Hash;

class EmpController extends Controller
{
    public function index()
    {
        return view('emp/list');
    }
    public function insert(Request $request){
        if($request->method() == 'POST'){
            $dataEmp = Emp::select('emp_id')->latest()->first();
            $emp_id = 'pd_0000001';
            if(!is_Null($dataEmp)){
                $emp_id = $dataEmp->emp_id;
                $numericPart = (int)substr($emp_id, 3);
                $numericPart++;
                $emp_id = sprintf('pd_%07d', $numericPart);
            }
            
            Emp::insert([
                'emp_id' => $emp_id,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'f_name' => $request->f_name,
                'l_name' => $request->l_name,
                'gender' => $request->gender,
                'national' => $request->national,
                'birthday' => $request->birthday,
                'age' => $request->age,
                'id_card' => $request->id_card,
                'tel' => $request->tel,
                'status' => $request->status,
                'address'=> $request->address            
            ]);

            return view('emp/list');
        }else{
            return view('emp/insert');
        }
    }
    
}
