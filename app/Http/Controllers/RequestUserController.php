<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestUserController extends Controller
{
    //
    public function index(){
        return view('request_user.list');
    }
}
