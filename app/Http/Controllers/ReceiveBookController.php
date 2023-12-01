<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\ReceiveBook;
use App\Models\Emp;
use App\Models\Book;
use Carbon\Carbon;
class ReceiveBookController extends Controller
{
    //
    public function index(){
        $data = ReceiveBook::orderBy("created_at")->paginate(10);
        return view('receive_book.list',compact('data'));
    }
    public function create(Request $request){
        $book_id = $request->book_name;
        $book = Book::select('book_id','name')->find($book_id);
        if(is_null($book)){
            $book_id = Book::generateID();
            Book::create([
                'book_id' => $book_id,
                'name'=>$request->book_name,
                'updated_at'=>null,
            ]);
        }
        $id = ReceiveBook::generateID();
        $emp = Emp::where('username',session()->get('username'))->first();
        $emp_id = $emp->emp_id;
        $add_date = Carbon::now()->format('Y-m-d');
        $book_name = is_null($book) ? $request->book_name :$book->name;
        ReceiveBook::create([
            'recv_id'=> $id,
            'emp_id'=> $emp_id,
            'book_name'=>$book_name,
            'add_date'=> $add_date,
            'add_type'=> $request->add_type,
            'desc'=> $request->desc,
        ]);
        
        Alert::success('บันทึกสำเร็จ');
        return redirect()->back();
    }
    public function fetchData(Request $request){
        $id = $request->input('id');
        $data = ReceiveBook::find($id);
        $data = ['receive' => $data ,'emp'=>$data->Emp];
        
        return response()->json($data);

    }
    public function delete($id){
        $ReceiveBook = ReceiveBook::find($id);
        $Book = Book::where('name', '=', $ReceiveBook->book_name)->first();
        if($Book->updated_at != null) {
            $check = false;
            return response()->json($check);
        }
        $ReceiveBook->delete();
        $Book->delete();
        $check = true;
        return response()->json($check);
    }
}
