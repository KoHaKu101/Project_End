<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestMediaController extends Controller
{
    //
    public function index(){
        return view('request_media.list');
    }
}
