<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CopyBookController extends Controller
{
    //
    public function index()
    {
        return view('copy_book/list');
    }
}
