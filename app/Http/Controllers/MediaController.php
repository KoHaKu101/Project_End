<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Media;
use App\Models\TypeBook;
use App\Models\TypeMedia;
use App\Models\OrderMedia;
use App\Models\RequestMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use Illuminate\Database\QueryException;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 10;
        $page = $request->input('page', 1);
        $dataMediaType = TypeMedia::orderby('created_at')->get();
        $dataMedia = Media::orderby('created_at')->get();
        $dataOrderMedia = OrderMedia::where('status', 1)->orderby('created_at')->paginate($perPage, ['*'], 'orderMedia');
        $type_book = TypeBook::all();
        return view('media/list', compact('dataMediaType', 'dataMedia', 'type_book', 'dataOrderMedia'));
    }
    private function createData($request, $select_type_file, $file_desc, $file_location)
    {
        $type_media_id = $request->type_media_id;
        $books = Book::find($request->book_id);
        Media::create([
            'media_id' => Media::generateID(),
            'book_id' => $books->book_id,
            'type_book_id' => $books->typeBook->type_book_id,
            'type_media_id' => $type_media_id,
            'number' => $this->generateNumberMedia($type_media_id),
            'amount_end' => $request->amount_end,
            'braille_page' => $request->braille_page,
            'status' => 1,
            'translator' => $request->translator,
            'sound_sys' => $request->sound_sys,
            'source' => $request->source,
            'file_type_select' => $select_type_file,
            'file_desc' => $file_desc,
            'file_location' => $file_location
        ]);
        return true;
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'book_id' => 'required',
            'type_media_id' => 'required',
        ]);
        if ($validator->fails()) {
            Alert::error('เกิดข้อผิดพลาด', 'กรุณากรอกข้อมูลให้ครบถ้วน');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if (Media::where('book_id', $request->book_id)->where('type_media_id', $request->type_media_id)->exists()) {
            return redirect()->back()->withErrors(['รายการนี้มีแล้ว'])->withInput();
        }
        $select_type_file = $request->select_type_file;
        $file_desc = '';
        $file_location = '';
        if ($select_type_file == 'text') {
            $file_desc = $request->input_text;
        } elseif ($select_type_file == 'file') {
            $file_location = '';
            if ($request->hasFile('input_file')) {
                $file = $request->file('input_file');
                $newFileName = uniqid() . '_' . $file->getClientOriginalName();
                $path = public_path('assets/fileMedia');

                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }

                $file->move($path, $newFileName);
                $newFilePath = $path . '/' . $newFileName;
                $file_location = $newFilePath;
            }
        } else {
            $file_desc = $request->input_textarea;
        }
        $this->createData($request, $select_type_file, $file_desc, $file_location);
        Alert::success('บันทึกสำเร็จ');
        return redirect()->back();
    }
    public function update(Request $request, $id)
    {
        $mediaData = Media::find($id);
        $select_type_file = $request->select_type_file;
        $file_location = null;
        $file_desc = '';
        if ($select_type_file == 'text') {
            $file_desc = is_null($request->input_text) ? '' : $request->input_text;
        } elseif ($select_type_file == 'file') {
            if ($request->hasFile('input_file')) {
                $file = $request->file('input_file');
                $path = public_path('assets/fileMedia');
                if (is_null($mediaData->file_location)) {
                    $newFileName = uniqid() . '_' . $file->getClientOriginalName();
                } else {
                    $old_file = $mediaData->file_location;
                    $newFileName = str_replace($path, "", $old_file);
                }

                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }

                $file->move($path, $newFileName);
                $newFilePath = $path . '/' . $newFileName;
                $file_location = $newFilePath;
            }
        } else {
            $file_desc = is_null($request->input_textarea) ? '' : $request->input_textarea;
        }
        if ($select_type_file != 'file') {
            File::delete($mediaData->file_location);
        }
        $mediaData->update([
            'amount_end' => $request->amount_end,
            'braille_page' => $request->braille_page,
            'translator' => $request->translator,
            'sound_sys' => $request->sound_sys,
            'source' => $request->source,
            'file_type_select' => $select_type_file,
            'file_desc' => $file_desc,
            'file_location' => $file_location
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

    public function confirmOrder($id, Request $request)
    {
        $orderMedia = OrderMedia::find($id);
        $book_id = $orderMedia->RequestMedia->book->book_id;
        $type_media_id = $orderMedia->RequestMedia->TypeMedia->type_media_id;
        $requestMedia = RequestMedia::where('book_id', $book_id)->where('type_media_id', $type_media_id)->get();
        $book = Book::where('book_id', $book_id)->first();
        Media::create([
            'media_id' => Media::generateID(),
            'book_id' => $book->book_id,
            'type_book_id' => $book->typeBook->type_book_id,
            'type_media_id' => $type_media_id,
            'number' => $this->generateNumberMedia($type_media_id),
            'status' => 1,
            'file_type_select' => 'textarea',
            'file_desc' => '',

        ]);
        foreach ($requestMedia as $datalist) {
            OrderMedia::where('request_id', $datalist->request_id)->where('status', 1)->update([
                'status' => 2
            ]);
        }
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
        $type_media_id = $request->type_media_id;
        $books = Book::where('book_id', $request->book_id)->first();
        $typeBook = $books->typeBook->name;
        $number = $this->generateNumberMedia($type_media_id);
        $img = $books->img_book;
        $data = ['number' => $number, 'typeBook' => $typeBook, 'img' => $img];
        return response()->json($data);
    }
    public function fetchDataConfirmOrder(Request $request)
    {
        $orderMedia = OrderMedia::find($request->id);
        $text = [1 => 'สั่งผลิต', 2 => 'พร้อมจ่ายสื่อ', 3 => 'รอผลิต', 4 => 'จ่ายสื่อเรียบร้อย'];
        $url = route('media.confirmOrder', $request->id);
        $status = $orderMedia->RequestMedia->status;
        $html = "<form action='{$url}' method='POST' id='form_confirmOrder'>
                    " . csrf_field() . "
                    <div class='row'>
                        <div class='col-lg-12'>
                            <label>ชื่อหนังสือ</label>
                            <input type='text' class='form-control' value='{$orderMedia->RequestMedia->book->name}'disabled>
                        </div>
                        <div class='col-lg-8'>
                            <label>ประเภทสื่อ</label>
                            <input type='text' class='form-control' value='{$orderMedia->RequestMedia->TypeMedia->name}' disabled>
                        </div>
                        <div class='col-lg-4'>
                            <label>สถานะ</label>
                            <input type='text' class='form-control' value='{$text[$status]}' disabled>
                        </div>
                        <div class='col-lg-6'>
                            <label>ชื่อ</label>
                            <input type='text' class='form-control' value='{$orderMedia->RequestMedia->RequestUser->f_name}' disabled>
                        </div>
                        <div class='col-lg-6'>
                            <label>นามสกุล</label>
                            <input type='text' class='form-control' value='{$orderMedia->RequestMedia->RequestUser->l_name}' disabled>
                        </div>
                        <div class='col-lg-12'>
                            <label>เบอร์โทรศัพท์</label>
                            <input type='text' class='form-control' value='{$orderMedia->RequestMedia->RequestUser->tel}' disabled>
                        </div>
                        <div class='col-lg-12'>
                            <label>เจ้าหน้าที่ </label>
                            <input type='text' class='form-control' value='{$orderMedia->RequestMedia->emp->f_name} {$orderMedia->RequestMedia->emp->l_name}' disabled>
                        </div>
                    </div>
                </form>";
        return response()->json($html);
    }
    public function fetchDataTableOrder()
    {
        $dataOrder = OrderMedia::where('status', 1)->orderby('created_at')->get();
        $html = "";
        foreach ($dataOrder as $index => $datalist) {
            $emp = $datalist->emp->f_name . " " . $datalist->emp->l_name;
            $html .= "";
        }
        return response()->json($html);
    }
    public function fetchDataTable($status)
    {
        $dataMedia = Media::where('status', $status)->orderby('created_at')->get();
        $html = '';
        $statusArray = [1 => 'กำลังผลิต', 2 => 'ตรวจเช็คเรียบร้อย'];
        $color_status = [1 => 'bg-warning', 2 => 'bg-success'];
        foreach ($dataMedia as $index => $datalist) {
            $statusNumber = $datalist->status;
            $statusBadge = "<span class='badge {$color_status[$statusNumber]} text-dark' >$statusArray[$statusNumber]</span>";
            $html .= "<tr>
                        <td class='text-center'>" . ($index + 1) . "</td>
                        <td>{$datalist->Book->name}</td>
                        <td>{$datalist->Book->TypeBook->name}</td>
                        <td>{$datalist->TypeMedia->name}</td>
                        <td class='text-center'>{$statusBadge}</td>
                        <td>
                            <button type='button' class='btn btn-sm btn-warning' onclick='editmodal_media(`{$datalist->media_id}`)'><i class='fas fa-edit'></i></button>
                            <button type='button' class='btn btn-sm btn-danger' onclick='confirm_delete(`{$datalist->media_id}`)'><i class='fas fa-trash'></i></button>
                                    <button type='button'
                                   class='btn btn-sm btn-primary'data-bs-toggle='modal'
                                    data-bs-target='#status_insert'>อัพเดพสถานะ</button>
                        </td>
                    </tr>";
        }

        return response()->json($html);
    }
    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $data = Media::find($id);
            $requestMedia = RequestMedia::where('book_id', $data->book->book_id)->where('type_media_id', $data->type_media_id)->first();
            if (!is_null($requestMedia)) {
                $order = OrderMedia::where('request_id', $requestMedia->request_id)->count();
                if ($order > 0) {
                    return response()->json(['error' => 'รายการถูกใช้งานอยู่ไม่สามารถลบได้'], 422);
                }
            }

            $data->delete();
            //
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

    public function generateNumberMedia($type_media_id){
        $typeMedia = TypeMedia::find($type_media_id);
        $dataMedia = Media::select('number', 'type_media_id')->where('type_media_id', $type_media_id)->latest()->first();
        $number = '1';

        if (!is_null($dataMedia)) {
            $dashPosition = strpos($dataMedia->number, "-");
            $lastNumber = (int)substr($dataMedia->number, $dashPosition + 1);
            $number = $lastNumber + 1;
        }
        return $typeMedia->head_number_media . '-' . $number;
    }
}
