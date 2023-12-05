<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\ReceiveBook;
use App\Models\Emp;
use App\Models\Book;
use Carbon\Carbon;
use App\Models\ReceiveBookDesc;
class ReceiveBookController extends Controller
{
    //
    public function index(){
        $data = ReceiveBookDesc::orderBy("created_at")->paginate(10);
        return view('receive_book.list',compact('data'));
    }
    public function create(Request $request){
        $book = Book::where('name',$request->book_name)->first();
        $recv_id = ReceiveBook::generateID();
        $emp = Emp::where('username',session()->get('username'))->first();
        $emp_id = $emp->emp_id;
        $add_date = Carbon::now()->format('Y-m-d');
        $book_id = is_null($book) ? null : $book->book_id;
        ReceiveBook::create([
            'recv_id'=> $recv_id,
            'emp_id'=> $emp_id,
            'book_name'=>$request->book_name,
            'add_date'=> $add_date,
            'add_type'=> $request->add_type,
        ]);
        $recd_id = ReceiveBook::generateID();
        ReceiveBookDesc::create([
            'recd_id'=>$recd_id,
            'recv_id'=>$recv_id,
            'book_id'=>$book_id,
            'desc'=>$request->desc,
        ]);
        Alert::success('บันทึกสำเร็จ');
        return redirect()->back();
    }
    public function fetchData(Request $request){
        $id = $request->input('id');
        $data = ReceiveBook::find($id);
        $ReceiveBookDesc = ReceiveBookDesc::where('recv_id',$data->recv_id)->first();
        $data = ['receive' => $data ,'emp'=>$data->Emp,'desc'=>$ReceiveBookDesc->desc];
        return response()->json($data);

    }
    public function delete($id){
        $ReceiveBook = ReceiveBook::find($id);
        $ReceiveBookDesc = ReceiveBookDesc::where('recv_id',$ReceiveBook->recv_id)->first();
        $ReceiveBookDesc->delete();
        $ReceiveBook->delete();
        $check = true;
        return response()->json($check);
    }
}
