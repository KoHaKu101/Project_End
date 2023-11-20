<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {

        if (session()->get('Logged') != 'true') {
            return redirect()->route('login');
        }
        // if (Str::startsWith('http://127.0.0.1:8000/ser/dashboard', request()->url())){
            // return view('dashboard_ser');
        // }else{
            return view('dashboard_pd');
        // }
    }
}
