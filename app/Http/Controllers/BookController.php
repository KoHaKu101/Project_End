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
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BookController extends Controller
{

    public function index(Request $request){
        $perPage = 10; // จำนวนรายการต่อหน้า
        $page = $request->input('page', 1);

        $book = Book::orderby('created_at')->paginate($perPage, ['*'], 'bookPage');
        $receiveBookDesc = ReceiveBookDesc::where('book_id', null)->orderby('created_at')->paginate($perPage, ['*'], 'bookNewPage');

        $type_book = TypeBook::all();
        $active_book = isset($request->booksPage) ? 'active' : ( isset($request->bookNewPage) ? '' : 'active' ) ;
        $active_bookNew = isset($request->bookNewPage) ? 'active' : '';

        return view('book/list', compact('type_book', 'book','receiveBookDesc','active_book','active_bookNew'));
    }
    private function validateBookRequest($request){
        return Validator::make($request->all(), [
            'type_book_id' => 'required',
            'name' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'edition' => 'required',
            'year' => 'required',
            'original_page' => 'required',

        ]);
    }
    public function createFunction($request){
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
            'language' => $request->language,
            'abstract'=> $request->abstract,
            'synopsis'=>$request->synopsis,
            'img_book'=>$request->img_book_location,
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
            Alert::error('Error', 'กรุณากรอกข้อมูลให้ครบถ้วน');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if (Book::where('isbn', $request->isbn)->count() > 0) {
            Alert::error('Error', 'เลข isbn ซ้ำ');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $newFileName = '';
        if ($request->hasFile('img_book')) {
            $file = $request->file('img_book');
            $extension = $file->getClientOriginalExtension();
            $path = public_path('assets/images/book');
            $newFileName = hexdec(uniqid()) . '.' . $extension;
            $newFilePath = $path . '/' . $newFileName;
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            }
            $manager = new ImageManager(new Driver());
            $image = $manager->read($file);
            $image->resize(1280, 1800)->save($newFilePath);
        }
        $request->merge(['img_book_location'=>$newFileName]);
        $this->createFunction($request);
        Alert::success('บันทึกสำเร็จ');
        return redirect()->back();
    }
    public function createBookNew($id, Request $request)
    {
        $validator = $this->validateBookRequest($request);
        if ($validator->fails()) {
            Alert::error('Error', 'กรุณากรอกข้อมูลให้ครบถ้วน');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if (Book::where('isbn', $request->isbn)->count() > 0) {
            Alert::error('Error', 'เลข isbn ซ้ำ');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $book_id = $this->createFunction($request);
        ReceiveBookDesc::find($id)->update(['book_id' => $book_id]);
        Alert::success('บันทึกสำเร็จ');
        return redirect()->back();
    }

    public function update($id, Request $request)
    {
        $validator = $this->validateBookRequest($request);
        if ($validator->fails()) {
            Alert::error('Error', 'กรุณากรอกข้อมูลให้ครบถ้วน');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $dataExits = Book::where('isbn', $request->isbn)->where('book_id', '!=', $id)->exists();
        if ($dataExits) {
            Alert::error('Error', 'เลข isbn ซ้ำ');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $newFileName = Book::where('book_id',$id)->first()->img_book;
        if ($request->hasFile('img_book')) {
            $file = $request->file('img_book');
            $extension = $file->getClientOriginalExtension();
            $path = public_path('assets/images/book');
            if(is_null($newFileName)){
                $newFileName = hexdec(uniqid()) . '.' . $extension;
            }
            $newFilePath = $path . '/' . $newFileName;
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            }
            $manager = new ImageManager(new Driver());
            $image = $manager->read($file);
            $image->resize(1280, 1800)->save($newFilePath);
        }

        $request->merge(['img_book_location'=>$newFileName]);
        $data = Book::find($id);
        $data->update([
            'type_book_id' => $request->type_book_id,
            'name' => $request->name,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'edition' => $request->edition,
            'year' => $request->year,
            'original_page' => $request->original_page,
            'isbn' => $request->isbn,
            'level' => $request->level,
            'language' => $request->language,
            'abstract'=> $request->abstract,
            'synopsis'=>$request->synopsis,
            'img_book'=>$request->img_book_location,
        ]);
        Alert::success('บันทึกสำเร็จ');
        return redirect()->back();
    }
    public function delete($id){
        try {
            DB::beginTransaction();
            $book = Book::find($id);
            $copyBook = CopyBook::where('book_id', $id)->first();
            if ($copyBook->amount > 0) {
                return response()->json(['error' => 'รายการถูกใช้งานอยู่ไม่สามารถลบได้'], 422);
            }
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
    public function fetchData(Request $request)
    {
        $id = $request->input('id');
        $data = Book::find($id);
        return response()->json($data);
    }


}
