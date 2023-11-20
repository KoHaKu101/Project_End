<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\TypeMedia;

class MediaController extends Controller
{
    public function index()
    {
        $dataMediaType = TypeMedia::orderby('created_at')->get();
        return view('media/list',compact('dataMediaType'));
    }
    public function insert(){
        return view('media/insert');
    }
    public function fetchDataBook(Request $request){
        $term = $request->term;
        $books = Book::where('name', 'like', '%' . $term . '%')
        ->select('book_id', 'name')
        ->get();
        return response()->json($books);

    }
    public function fetchDataBookType(Request $request){
        $books = Book::where('book_id',$request->book_id)->first();
        return response()->json($books->typeBook);

    }
}
