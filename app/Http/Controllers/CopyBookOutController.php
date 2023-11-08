<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CopyBookOutController extends Controller
{
    public function index(){
        return view('copy_book_out/list');
    }
}
