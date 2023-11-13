<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Emp;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class AuthController extends Controller
{
    function loginForm(){
        return view('login');
    }
    public function loginProcess(Request $request){
        $credentials = $request->only('username', 'password');
        $request->validate([
            'username'=>'required',
            'password'=>'required'
        ]);
        $username = $request->username;
        $password = $request->password;
        $dataEmp = Emp::select('username','password')->where('username',$username)->first();
        if(is_Null($dataEmp)){
            dd('false');
            return redirect()->route('login');
        }
        if(!Hash::check($password,$dataEmp->password)){
            dd('false2');
            return redirect()->route('login');
        }
        Session::put('Logged', 'true');
        return redirect()->route('dashboard_pd');
    }
    
}
