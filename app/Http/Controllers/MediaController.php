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
        return view('media/list', compact('dataMediaType', 'dataMedia'));
    }
    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'book_id' => 'required',
            'type_media_id' => 'required',
        ]);
        if ($validator->fails()) {
            Alert::error('Error', 'เกิดข้อผิดพลาดกรุณาลองใหม่');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $book_id = $request->book_id;
        $type_media_id = $request->type_media_id;
        $media_id = Media::generateID();
        $dataMedia = Media::where('book_id', $book_id)->where('type_media_id', $type_media_id)->first();
        if (!is_Null($dataMedia)) {
            Alert::error('Error', 'รายการนี้มีแล้ว');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $number = Media::generateNumber($book_id, $type_media_id);
        Media::create([
            'media_id' => $media_id,
            'book_id' => $book_id,
            'type_media_id' => $type_media_id,
            'number' => $number,
            'amount_end' => $request->amount_end,
            'braille_page' => $request->braille_page,
            'status' => 1,
            'translator' => $request->translator,
            'sound_sys' => $request->sound_sys,
            'source' => $request->source
        ]);

        Alert::success('บันทึกสำเร็จ');
        return redirect()->back();
    }
    public function fetchData(Request $request)
    {
        $mediaData = Media::find($request->id);
        $bookType = $mediaData->Book->TypeBook->name;
        $book_name = $mediaData->book->name;
        $data = [
            'book_name' => $book_name,
            'media_data' => $mediaData,
            'book_type' => $bookType,
        ];
        return response()->json($data);
    }
    public function update(Request $request, $id)
    {
        $mediaData = Media::find($id);
        $mediaData->update($request->all());
        Alert::success('บันทึกสำเร็จ');
        return redirect()->back();
    }
    public function fetchDataBook(Request $request)
    {
        $term = $request->term;
        $books = Book::where('name', 'like', '%' . $term . '%')
            ->select('book_id', 'name')
            ->get();
        return response()->json($books);
    }
    public function fetchDataInput(Request $request)
    {
        $book_id = $request->book_id;
        $typeBook = '-----';
        if (!is_null($book_id)) {
            $books = Book::where('book_id', $book_id)->first();
            $typeBook = $books->typeBook->name;
        }
        $number = Media::generateNumber($request->type_media_id);
        $data = ['number' => $number, 'typeBook' => $typeBook];
        return response()->json($data);
    }
    public function fetchDataTable($status){
        $dataMedia = Media::where('status',$status)->orderby('created_at')->get();

        $html = '';
        $statusArray = [1 => 'กำลังผลิต', 2 => 'ตรวจเช็คเรียบร้อย'];
        $color_status = [1 => 'bg-warning', 2 => 'bg-success'];
        foreach ($dataMedia as $index => $datalist){
            $statusNumber = $datalist->status;
            $statusBadge ="<span class='badge {$color_status[$statusNumber]} text-dark' >$statusArray[$statusNumber]</span>";
            $html.="<tr>
                        <td class='text-center'>" . ($index + 1) . "</td>
                        <td>{$datalist->Book->name}</td>
                        <td>{$datalist->Book->TypeBook->name}</td>
                        <td>{$datalist->TypeMedia->name}</td>
                        <td>{$statusBadge}</td>
                        <td>
                            <button type='button' class='btn btn-sm btn-warning' onclick='editmodal_media(`{$datalist->media_id}`)'><i class='fas fa-edit'></i></button>
                            <button type='button' class='btn btn-sm btn-danger'><i
                                    class='fas fa-trash'></i></button>
                                    <button type='button'
                                   class='btn btn-sm btn-primary'data-bs-toggle='modal'
                                    data-bs-target='#status_insert'>อัพเดพสถานะ</button>
                        </td>
                    </tr>";
        }
        // @if ($statusNumber == 1)
        //
        //                     @endif


        return response()->json($html);
    }
}
