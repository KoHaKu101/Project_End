<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\TypeMedia;
use Illuminate\Support\Facades\Validator;
use App\Models\Media;
use RealRashid\SweetAlert\Facades\Alert;
class MediaController extends Controller
{
    public function index()
    {
        $dataMediaType = TypeMedia::orderby('created_at')->get();
        $dataMedia = Media::orderby('created_at')->get();
        return view('media/list',compact('dataMediaType','dataMedia'));
    }
    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            'book_id' => 'required',
            'type_media_id' => 'required',
        ]);
        if($validator->fails()){
            Alert::error('Error', 'เกิดข้อผิดพลาดกรุณาลองใหม่');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $book_id = $request->book_id;
        $type_media_id = $request->type_media_id;
        $media_id = Media::generateID();
        $dataMedia = Media::where('book_id',$book_id)->where('type_media_id',$type_media_id)->first();
        if(!is_Null($dataMedia)){
            Alert::error('Error', 'รายการนี้มีแล้ว');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $number = Media::generateNumber($book_id,$type_media_id);
        Media::create([
            'media_id' => $media_id ,
            'book_id' => $book_id ,
            'type_media_id' => $type_media_id ,
            'number' => $number ,
            'amount_end' => $request->amount_end ,
            'braille_page' => $request->braille_page ,
            'status' => 1 ,
            'translator' => $request->translator ,
            'sound_sys' => $request->sound_sys ,
            'source' => $request->source 
        ]);

        Alert::success('บันทึกสำเร็จ');
        return redirect()->back();
    }
    public function fetchData(Request $request){
        $mediaData = Media::find($request->id);
        $BookType = $mediaData->Book->TypeBook->name;
        $data = [
            'media_data' => $mediaData,
            'book_type' => $BookType,
        ];
        return response()->json($data);
    }
    public function update(Request $request,$id){
        $mediaData = Media::find($id);
        $mediaData->update($request->all());
        Alert::success('บันทึกสำเร็จ');
        return redirect()->back();
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
    public function fetchDataNumber(Request $request){
        $data = Media::generateNumber($request->book_id,$request->type_media_id);
        return response()->json($data);
    }
}
