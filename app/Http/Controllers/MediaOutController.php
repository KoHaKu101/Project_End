<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaOutController extends Controller
{
    //
    public function index(){
        return view('media_out.list');
    }
}
