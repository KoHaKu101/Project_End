<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index()
    {
        return view('media/list');
    }
    public function insert(){
        return view('media/insert');
    }
}
