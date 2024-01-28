<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\TypeBook;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        if (session()->get('Logged') != 'true') {
            return redirect()->route('login');
        }
        return view('dashboard_pd');
    }
    public function searchBook(Request $request){
        $search = $request->search;
        $dataBook = null;
        if(isset($search)){
        $dataBook = Book::where('name','like','%'.$search.'%')->get();
        }
        return view('searchBook',compact('search','dataBook'));
    }
    public function showBookDetail(Request $request){
        $book = Book::find($request->id);
        $book_type = TypeBook::where('type_book_id',$book->type_book_id)->first()->name;
        $bookFields = [
            'เลข ISBN' => $book->isbn,
            'ภาษา' => $book->language,
            'ผู้แต่ง/ผู้ประพันธ์' => $book->author,
            'ชื่อเรื่อง' => $book->name,
            'สำนักพิมพ์' => $book->publisher,
            'จำนวนหน้าตัวพิมพ์' => $book->original_page . ' หน้า',
            'ประเภทหนังสือ' => TypeBook::where('type_book_id', $book->type_book_id)->first()->name,
            'บทคัดย่อ' => $book->abstract,
            'ระดับชั้น' => $book->level,
        ];

        $html = "";
        foreach ($bookFields as $label => $value) {
            $html .= "<tr><td width='25%'>$label</td><td>: $value</td></tr>";
        }
        return response()->json(['book'=>$book,'book_type'=>$book_type,'html'=>$html]);

    }
}
