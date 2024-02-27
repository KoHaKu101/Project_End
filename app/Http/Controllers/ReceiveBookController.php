<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Emp;
use App\Models\Book;
use App\Models\ReceiveBook;
use Illuminate\Http\Request;
use App\Models\ReceiveBookDesc;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class ReceiveBookController extends Controller
{
    //
    public function index(Request $request){
        $search_data = $request->search_data != '' ? $request->search_data : '';
        $data = ReceiveBookDesc::WhereHas('ReceiveBook', function ($query) use ($search_data) {
            $query->where('book_name', 'like', '%' . $search_data . '%');
        })->orderBy("created_at")->paginate(10);
        return view('receive_book.list',compact('data','search_data'));
    }
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'book_name' => 'required',
            'desc' => 'required',
            'add_type' => 'required',

        ]);
        if ($validator->fails()) {
            Alert::error('เกิดข้อผิดพลาด', 'กรุณากรอกข้อมูลให้ครบถ้วน');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $book = Book::where('book_id',$request->book_name)->first();
        if(is_null($book)){
            $book_name = $request->book_name;
            $book_id = null;
        }else{
            $book_id = $book->book_id;
            $book_name = $book->name;
        }
        $recv_id = ReceiveBook::generateID();
        $emp = Emp::where('username',session()->get('username'))->first();
        $emp_id = $emp->emp_id;
        $add_date = Carbon::now()->format('Y-m-d');

        ReceiveBook::create([
            'recv_id'=> $recv_id,
            'emp_id'=> $emp_id,
            'book_name'=>$book_name,
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
        try {
            DB::beginTransaction();
            $receiveBook = ReceiveBook::find($id);
            $receiveBookDesc = ReceiveBookDesc::where('recv_id',$receiveBook->recv_id)->first();
            // คำสั่งลบ
            $receiveBookDesc->delete();
            $receiveBook->delete();
            DB::commit();
            // แสดงค่าลบรายการสำเร็จ
            return response()->json(['message' => 'ลบรายการสำเร็จ']);
        } catch (QueryException $e) {
            //ไว้สำหรับลบข้อมูลไม่สำเร็จและข้อมูลไม่หายไป
            DB::rollBack();
            // เช็คค่าหากมี fk ที่ใช้อยู่จะแจ้งเตือน
            if ($e->getCode() == 23000) {
                // Display a SweetAlert with a custom error message
                return response()->json(['error' => 'รายการถูกใช้งานอยู่ไม่สามารถลบได้'], 422);
            }
            // หากเกิด error อื่นๆขึ้น
            return response()->json(['error' => 'An error occurred while deleting the record.'], 500);
        }
    }
}
