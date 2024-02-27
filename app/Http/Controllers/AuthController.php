<?php

namespace App\Http\Controllers;

use App\Models\Emp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    function loginForm(){
        return view('login');
    }
    public function loginProcess(Request $request){
        $request->validate([
            'username'=>'required',
            'password'=>'required'
        ]);
        $username = $request->username;
        $password = $request->password;
        $dataEmp = Emp::select('emp_id','username','password','status')->where('username',$username)->first();

        if(is_Null($dataEmp) || !Hash::check($password,$dataEmp->password)){
            Alert::error('เข้าสู่ระบบไม่สำเร็จ','username หรือ Password ไม่ถูกต้อง');
            return redirect()->back();
        }
        Session::put('Logged', 'true');
        Session::put('emp',$dataEmp->emp_id);
        Session::put('username', $dataEmp->username);
        Session::put('status', $dataEmp->status);
        return redirect()->route('dashboard');
    }
    public function logout(){
        Session::flush();
        return redirect()->route('login');
    }

}
