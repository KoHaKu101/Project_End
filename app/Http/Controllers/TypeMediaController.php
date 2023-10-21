<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TypeMediaController extends Controller
{
    public function index(){
        return view('type_media.list');
    }
}
