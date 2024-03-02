<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\CopyBookOut;
use App\Models\CopyBook;
use App\Models\Emp;
use App\Models\Book;
class CopyBookOutController extends Controller
{
    public function index(Request $request){
        $search_data = $request->search_data != '' ? $request->search_data : '';
        $data = CopyBookOut::whereHas('copyBook', function ($query) use ($search_data) {
                                $query->whereHas('book', function ($query) use ($search_data) {
                                    $query->where('name', 'like', '%' . $search_data . '%');
                                });
        })->orderby('created_at')->paginate(10);
        return view('copy_book_out/list',compact('data','search_data'));
    }
    public function create(Request $request){
        if($request->book_id == null){
            Alert::error('กรุณาระบุหนังสือ');
            return redirect()->back();
        }
        if($request->amount == 0){
            Alert::error('กรุณาระบุจำนวนให้ถูกต้อง');
            return redirect()->back();
        }
        $copybook = CopyBook::select('copy_id','book_id','amount')->where('book_id',$request->book_id)->first();
        $amount  = $copybook->amount - $request->amount;
        if($amount < 0){
            Alert::error('ไม่สามารถจ่ายได้เนื่องจากสำเนาไม่พอ');
            return redirect()->back();
        }
        $username = session()->get('username');
        $emp = Emp::select('emp_id','username')->where('username', $username)->first();
        $copy_id = $copybook->copy_id;
        CopyBookOut::create([
            'copyout_id'=> CopyBookOut::generateID(),
            'copy_id'=> $copy_id,
            'emp_id'=> $emp->emp_id,
            'amount'=> $request->amount,
            'status'=> 1,
        ]);
        CopyBook::find($copy_id)->update(['amount'=>$amount]);
        Alert::success('บันทึกสำเร็จ');
        return redirect()->back();
    }
    public function fetchData(Request $request){
        $CopyBookOut = CopyBookOut::find($request->id);
        $CopyBook = CopyBook::where('copy_id',$CopyBookOut->copy_id)->first();
        $Book = Book::where('book_id', $CopyBook->book_id)->first();
        $data = ['CopyBookOut' => $CopyBookOut ,'Book'=>$Book];
        return response()->json($data);
    }
    public function update(Request $request,$id){
        if($request->amount == 0){
            Alert::error('กรุณาระบุจำนวนให้ถูกต้อง');
            return redirect()->back();
        }
        $copybookout = CopyBookOut::find($id);
        if($request->amount > $copybookout->amount ){
            Alert::error('จำนวนรับคืนเกินกว่าจ่าย');
            return redirect()->back();
        }

        $copybook = CopyBook::select('copy_id','amount')->where('copy_id',$copybookout->copy_id)->first();
        $amount  = $copybook->amount + $request->amount;
        $copybookout->update(['status'=> 2]);
        $copybook->update(['amount'=>$amount]);
        Alert::success('บันทึกสำเร็จ');
        return redirect()->back();
    }
}
