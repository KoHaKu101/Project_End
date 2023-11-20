<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\CopyBook;
use App\Models\TypeBook;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BookController extends Controller
{
    public function index()
    {
        $data = Book::orderby('created_at')->get();
        $type_book = TypeBook::all();
        return view('book/list', compact('type_book', 'data'));
    }
    public function create(Request $request)
    {
        $book_id = Book::generateID();
        Book::create([
            'book_id' => $book_id,
            'type_book_id' => $request->type_book_id,
            'name' => $request->name,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'edition' => $request->edition,
            'year' => $request->year,
            'original_page' => $request->original_page,
            'isbn' => $request->isbn,
            'level' => $request->level,
        ]);
        $copy_id = CopyBook::generateID();
        CopyBook::create([
            'copy_id' => $copy_id,
            'book_id' => $book_id,
            'amount' => 0,
        ]);
        Alert::success('บันทึกสำเร็จ');
        return redirect()->back();
    }
    public function fetchData(Request $request)
    {
        $id = $request->input('id');
        $data = Book::find($id);
        return response()->json($data);
    }
    public function update(Request $request, $id)
    {
        $data = Book::find($id);
        $data->update($request->all());
        
        Alert::success('บันทึกสำเร็จ');
        return redirect()->back();
    }
}
