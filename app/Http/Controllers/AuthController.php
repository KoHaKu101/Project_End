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
        $request->validate([
            'username'=>'required',
            'password'=>'required'
        ]);
        $username = $request->username;
        $password = $request->password;
        $dataEmp = Emp::select('username','password','status')->where('username',$username)->first();
        if(is_Null($dataEmp)){
            dd('false');
            return redirect()->route('login');
        }
        if(!Hash::check($password,$dataEmp->password)){
            dd('false2');
            return redirect()->route('login');
        }
        Session::put('Logged', 'true');
        Session::put('username', $dataEmp->username);
        Session::put('status', $dataEmp->status);
        $route_name = $dataEmp->status == 1 ? 'dashboard_pd' : 'dashboard_ser';
        return redirect()->route($route_name);
    }
    
}
