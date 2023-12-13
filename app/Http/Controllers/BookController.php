<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\CopyBook;
use App\Models\TypeBook;
use Illuminate\Http\Request;
use App\Models\ReceiveBookDesc;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{

    public function index()
    {
        $Book = Book::orderby('created_at')->get();
        $ReceiveBookDesc = ReceiveBookDesc::where('book_id', null)->orderby('created_at')->get();
        $type_book = TypeBook::all();
        return view('book/list', compact('type_book', 'ReceiveBookDesc', 'Book'));
    }
    private function validateBookRequest($request)
    {
        return Validator::make($request->all(), [
            'type_book_id' => 'required',
            'name' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'edition' => 'required',
            'year' => 'required',
            'original_page' => 'required',
            'isbn' => 'required|unique:books,isbn'
        ]);
    }
    public function createData($request){

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
        return $book_id;
    }
    public function create(Request $request){
        $validator = $this->validateBookRequest($request);
        if ($validator->fails()) {
            Alert::error('Error', 'กรุณากรอกข้อมูลให้ครบถ้วน หรือ เลข isbn ซ้ำ');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $this->createData($request);
        Alert::success('บันทึกสำเร็จ');
        return redirect()->back();
    }
    public function createBookNew($id, Request $request)
    {
        $validator = $this->validateBookRequest($request);
        if ($validator->fails()) {
            Alert::error('Error', 'กรุณากรอกข้อมูลให้ครบถ้วน หรือ เลข isbn ซ้ำ');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $book_id = $this->createData($request);
        ReceiveBookDesc::find($id)->update(['book_id' => $book_id]);
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
        $validator = $this->validateBookRequest($request);
        if ($validator->fails()) {
            Alert::error('Error', 'กรุณากรอกข้อมูลให้ครบถ้วน');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = Book::find($id);
        $data->update($request->all());
        $data->update(['updated_at' => now()]);

        Alert::success('บันทึกสำเร็จ');
        return redirect()->back();
    }
    public function delete($id){
        try {
            DB::beginTransaction();
            $book = Book::find($id);
            $copyBook = CopyBook::where('book_id',$id)->first();
            // คำสั่งลบ
            $copyBook->delete();
            $book->delete();
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
