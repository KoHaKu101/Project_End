<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return view('book/list');
    }
    public function insert(){
        return view('book/insert');
    }
}
