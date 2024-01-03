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
        if(Book::where('isbn',$request->isbn)->count() > 0 ){
            Alert::error('Error', 'เลข isbn ซ้ำ');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $this->createFunction($request);
        Alert::success('บันทึกสำเร็จ');
        return redirect()->back();
    }
    public function createBookNew($id, Request $request){
        $validator = $this->validateBookRequest($request);
        if ($validator->fails()) {
            Alert::error('Error', 'กรุณากรอกข้อมูลให้ครบถ้วน');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if(Book::where('isbn',$request->isbn)->count() > 0 ){
            Alert::error('Error', 'เลข isbn ซ้ำ');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $book_id = $this->createFunction($request);
        ReceiveBookDesc::find($id)->update(['book_id' => $book_id]);
        Alert::success('บันทึกสำเร็จ');
        return redirect()->back();
    }

    public function update($id,Request $request){
        $validator = $this->validateBookRequest($request);
        if ($validator->fails()) {
            Alert::error('Error', 'กรุณากรอกข้อมูลให้ครบถ้วน');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $dataExits = Book::where('isbn',$request->isbn)->where('book_id','!=',$id)->exists();
        if($dataExits){
            Alert::error('Error', 'เลข isbn ซ้ำ');
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
            if($copyBook->amount > 0){
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
    public function fetchData(Request $request){
        $id = $request->input('id');
        $data = Book::find($id);
        return response()->json($data);
    }
    public function fetchDataTableBook(Request $request){
        $html = '';
        $Book = Book::orderby('created_at')->get();
        foreach($Book as $index => $datalist){
                $type_book_name = optional($datalist->TypeBook)->name ?? '';
                $amount = optional($datalist->CopyBook)->amount ?? 0;
                $copy_id = optional($datalist->CopyBook)->copy_id ?? '';
                $badge = is_null($datalist->updated_at) ? 'bg-danger' : ($amount > 0 ? 'bg-success' : 'bg-warning text-dark');
                $textBadge = is_null($datalist->updated_at) ? 'ไม่มีข้อมูล' : ($amount > 0 ? 'มีสำเนา' : 'ยังไม่มีสำเนา');
                $number = $index + 1;
                $html.= "<tr>
                            <td class='text-center'>{$number}</td>
                            <td>{$datalist->name}</td>
                            <td>{$type_book_name}</td>
                            <td>{$datalist->isbn}</td>
                            <td><span class='badge {$badge}'> {$textBadge} </span></td>
                            <td>
                                <button type='button' class='btn btn-sm btn-warning' onclick='editmodal(`{$datalist->getKey()}`)'>
                                    <i class='fas fa-edit'></i>
                                </button>
                                <button type='button' class='btn btn-sm btn-danger me-1' onclick='confirm_delete(`{$datalist->getKey()}`)'>
                                    <i class='fas fa-trash'></i>
                                </button>";
                if($amount == 0){
                    $html.= "<button type='button' class='btn btn-sm btn-primary'
                                onclick='openModalCopy(`plus`, `{$copy_id}`, `{$datalist->name}`)'>
                                <i class='fas fa-copy'></i>
                                เพิ่มสำเนา
                            </button>";
                }
                $html.="</td>
                        </tr>";
        }
        return response()->json($html);
    }
    public function fetchDataTableBookNew(Request $request){
        $html = '';
        $ReceiveBookDesc = ReceiveBookDesc::where('book_id', null)->orderby('created_at')->get();
        foreach($ReceiveBookDesc as $index => $datalist){
            $number = $index + 1;
            $html.= "<tr>
                    <td class='text-center'>{$number}</td>
                    <td>{$datalist->ReceiveBook->book_name}</td>
                    <td>
                        <button type='button' class='btn btn-success btn-sm' onclick='OpenModalBookNew(`{$datalist->recd_id}`,`{$datalist->ReceiveBook->book_name}`)'>
                        <i class='fas fa-plus me-1'></i>เพิ่มข้อมูล</button>
                    </td>
                </tr>";
        }
        return response()->json($html);
    }
}
