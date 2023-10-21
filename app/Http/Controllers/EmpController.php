<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmpController extends Controller
{
    public function index()
    {
        return view('emp/list');
    }
    public function insert(){
        return view('emp/insert');
    }
}
