<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Media;
use App\Models\TypeBook;
use App\Models\TypeMedia;
use App\Models\OrderMedia;
use App\Models\RequestMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
        $search_data = $request->search_data != '' ? $request->search_data : '';
        $searchQuery = function ($query) use ($search_data) {$query->where('name', 'like', '%' . $search_data . '%');};
        $searchQueryOrderMedia = function ($query) use ($search_data) {
            $query->whereHas('book', function ($query) use ($search_data) {
                $query->where('name', 'like', '%' . $search_data . '%');
            });
        };
        $dataMediaType = TypeMedia::orderby('created_at')->get();
        $dataOrderMedia = OrderMedia::WhereHas('requestMedia', $searchQueryOrderMedia)->where('status', 1)->orderby('created_at')->paginate($perPage, ['*'], 'orderMedia');
        $dataMediaProcess = Media::WhereHas('book', $searchQuery)->where('status',1)->orderby('created_at')->paginate($perPage, ['*'], 'mediaProcess');
        $dataMediaSuccess = Media::WhereHas('book', $searchQuery)->where('status',2)->orWhere('status',3)->orderby('created_at')->paginate($perPage, ['*'], 'mediaSuccess');
        $active = isset($request->orderMedia) ? '0' : ( isset($request->mediaProcess) ? '1' : (isset($request->mediaSuccess) ? '2' : '0' ));
        $type_book = TypeBook::all();
        return view('media/list', compact('dataMediaType',  'type_book', 'dataOrderMedia','dataMediaProcess','dataMediaSuccess','active','search_data'));
    }
    private function createData($request, $select_type_file,$file_desc){
        $type_media_id = $request->type_media_id;
        $books = Book::find($request->book_id);
        Media::create([
            'media_id' => Media::generateID(),
            'book_id' => $books->book_id,
            'type_media_id' => $type_media_id,
            'number' => $this->generateNumberMedia($type_media_id),
            'amount_end' => $request->amount_end,
            'braille_page' => $request->braille_page,
            'status' => 1,
            'translator' => $request->translator,
            'sound_sys' => $request->sound_sys,
            'source' => $request->source,
            'time_hour' => $request->time_hour,
            'time_minute' => $request->time_minute,
            'file_type_select' => $select_type_file,
            'file_desc' => $file_desc
        ]);
        return true;
    }
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'book_id' => 'required',
            'type_media_id' => 'required',
        ]);
        if ($validator->fails()) {
            Alert::error('เกิดข้อผิดพลาด', 'กรุณากรอกข้อมูลให้ครบถ้วน');
            return redirect()->back();
        }
        if (Media::where('book_id', $request->book_id)->where('type_media_id', $request->type_media_id)->exists()) {
            Alert::error('เกิดข้อผิดพลาด', 'รายการนี้มีแล้ว');
            return redirect()->back();
        }
        $select_type_file = $request->select_type_file;
        $file_desc = '';
        if ($select_type_file == 'text' || $select_type_file == 'textarea') {
            $value_text= ['textarea'=>$request->input_textarea,'text'=>$request->input_text];
            $file_desc = $value_text[$select_type_file];
        } elseif ($select_type_file == 'file') {
            if ($request->hasFile('input_file')) {
                $file = $request->file('input_file');
                $newFileName = Media::generateID().'.'.$file->getClientOriginalExtension();
                $path = public_path('assets/fileMedia');

                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }

                $file->move($path, $newFileName);
                $newFilePath = $path . '/' . $newFileName;
                $file_desc = $newFilePath;
            }
        }
        $this->createData($request, $select_type_file, $file_desc);
        Alert::success('บันทึกสำเร็จ');
        return redirect()->back();
    }
    public function update(Request $request, $id){
        $mediaData = Media::find($id);
        $select_type_file = $request->select_type_file;
        $file_desc = $request->input_text;
        if ($select_type_file == 'text' || $select_type_file == 'textarea') {
            $value_text= ['textarea'=>$request->input_textarea,'text'=>$request->input_text];
            $file_desc = $value_text[$select_type_file];
        } elseif ($select_type_file == 'file') {
            if ($request->hasFile('input_file')) {
                $file = $request->file('input_file');
                $path = public_path('assets/fileMedia');
                $newFileName = $mediaData->media_id.'.'.$file->getClientOriginalExtension();
                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }
                $file->move($path, $newFileName);
                $newFilePath = $path . '/' . $newFileName;
                $file_desc = $newFilePath;
            }else{
                $newFilePath = $mediaData->file_desc;
                if(File::exists($newFilePath)){
                    $file_desc = $mediaData->file_desc;
                }else{
                    $file_desc = '';
                }

            }
        }
        if ($select_type_file != 'file') {
            File::delete($mediaData->file_desc);
        }
        $mediaData->update([
            'amount_end' => $request->amount_end,
            'braille_page' => $request->braille_page,
            'translator' => $request->translator,
            'sound_sys' => $request->sound_sys,
            'time_hour' => $request->time_hour,
            'time_minute' => $request->time_minute,
            'source' => $request->source,
            'file_type_select' => $select_type_file,
            'file_desc' => $file_desc
        ]);
        Alert::success('บันทึกสำเร็จ');
        return redirect()->back();
    }
    public function updateStatus(Request $request,$id){
        $check_date = $request->check_date;
        $dataMedia = Media::find($id);
        $requestMedia = RequestMedia::where('book_id',$dataMedia->book_id)->where('type_media_id',$dataMedia->type_media_id)->get();
        $dataMedia->check_date = $check_date;

        $dataMedia->status = 2;
        foreach($requestMedia as $datalist){
            $request_id = $datalist->request_id;
            RequestMedia::find($request_id)->update([
                'status' => 2
            ]);
            OrderMedia::where('request_id',$request_id)->update([
                'end_date' => $check_date,
                'status' => 3
            ]);
        }
        $dataMedia->save();
        Alert::success('บันทึกสำเร็จ');
        return redirect()->back();
    }
    public function editStatus($id){
        $dataMedia = Media::find($id);
        if(is_null($dataMedia)){
            return response()->json(false);
        }
        if($dataMedia->status == 2){
            $dataMedia->update([
                'status' => 3
            ]);
        }elseif($dataMedia->status == 3){
            $dataMedia->update([
                'status' => 2
            ]);
        }
        return  response()->json(true);
    }
    public function fetchData(Request $request){
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

    public function confirmOrder($id, Request $request){
        $requestMedia = RequestMedia::find($id);
        $book_id = $requestMedia->book_id;
        $type_media_id = $requestMedia->type_media_id;
        Media::create([
            'media_id' => Media::generateID(),
            'book_id' => $book_id,
            'type_media_id' => $type_media_id,
            'number' => $this->generateNumberMedia($type_media_id),
            'status' => 1,
            'file_type_select' => 'textarea',
        ]);
        $dataMedia = RequestMedia::where('book_id', $book_id)->where('type_media_id', $type_media_id)->get();
        foreach ($dataMedia as $datalist) {
            OrderMedia::where('request_id', $datalist->request_id)->where('status', 1)->update([
                'status' => 2
            ]);
        }
        Alert::success('บันทึกสำเร็จ');
        return redirect()->back();

    }
    public function fetchDataBook(Request $request){
        $term = $request->term;
        $books = Book::where('name', 'like', '%' . $term . '%')
            ->select('book_id', 'name')
            ->take(10)->get();
        return response()->json($books);
    }
    public function fetchDataInput(Request $request){
        $type_media_id = $request->type_media_id;
        $books = Book::where('book_id', $request->book_id)->first();
        $typeBook = $books->typeBook->name;
        $number = $this->generateNumberMedia($type_media_id);
        $img = $books->img_book;
        $data = ['number' => $number, 'typeBook' => $typeBook, 'img' => $img];
        return response()->json($data);
    }

    public function fetchDataStatusMedia(Request $request){
        $html = "";
        $dataMedia = Media::find($request->id);
        $selectTypeFile = [''=>'','textarea'=>'ข้อความ','text'=>'google','file'=>'อัปโหลด'];
        $img = $dataMedia->Book->img_book != "" ? 'book/'.$dataMedia->Book->img_book : 'book_not_found.jpg';
        $img = asset('assets/images/'.$img);
        $html.= "
                <div class='row'>
                <div class='col-md-4 '>
                    <div class='text-center'>
                        <img src=".$img." width='85%' >
                    </div>
                </div>
                <div class='col-md-8'>
                    <div class='form-group row'>
                        <div class='col-lg-4'>
                            <label class='control-label'>ทะเบียนสื่อ</label>
                            <input type='text' class='form-control form-control-sm' disabled value='{$dataMedia->number}'>
                        </div>
                        <div class='col-lg-8' >
                            <label class='control-label'>หนังสือ</label>
                            <input type='text' class='form-control form-control-sm' disabled value='{$dataMedia->Book->name}'>
                        </div>
                        <div class='col-lg-4'>
                            <label class='control-label'>หมวดหมู่</label>
                            <input type='text' class='form-control form-control-sm' disabled value='{$dataMedia->Book->TypeBook->name}'>
                        </div>
                        <div class='col-lg-8'>
                            <label class='control-label'>ประเภทสื่อ</label>
                            <input type='text' class='form-control form-control-sm' disabled value='{$dataMedia->TypeMedia->name}'>
                        </div>
                        <div class='col-lg-4'>
                            <label class='control-label'>ระบบเสียง</label>
                            <input type='text' class='form-control form-control-sm' disabled value='{$dataMedia->sound_sys}'>
                        </div>
                        <div class='col-lg-8' style='padding-bottom: calc(var(--bs-gutter-x) * .1) !important;'>
                            <label class='control-label'> เวลา ของไฟล์สื่อ</label>
                            <div class='form-group row' >
                                <div class='col-md-6'>
                                    <div class='input-group input-group-sm '>
                                        <input type='text' class='form-control form-control-sm' disabled value='{$dataMedia->time_hour}'>
                                        <span class='input-group-text'>ชั่วโมง</span>
                                    </div>
                                </div>
                                <div class='col-md-6'>
                                <div class='input-group input-group-sm col-md-6'>
                                    <input type='text' class='form-control form-control-sm' disabled value='{$dataMedia->time_minute}'>
                                    <span class='input-group-text'>นาที</span>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-4'>
                            <label class='control-label'>จำนวนหน้าอักษรเบลล์</label>
                            <input type='text' class='form-control form-control-sm' disabled value='{$dataMedia->braille_page}'>
                        </div>
                        <div class='col-lg-4'>
                            <label class='control-label'>จำนวนเล่มจบ</label>
                            <input type='text' class='form-control form-control-sm' disabled value='{$dataMedia->amount_end}'>
                        </div>
                        <div class='col-lg-4'>
                            <label class='control-label'>แหล่งที่มา</label>
                            <input type='text' class='form-control form-control-sm' disabled value='{$dataMedia->source}'>
                        </div>
                        <div class='col-lg-12'>
                            <label class='control-label'>ผู้ที่แปลสื่อหรือพากย์เสียง</label>
                            <input type='text' class='form-control form-control-sm' disabled value='{$dataMedia->translator}'>
                        </div>
                        <div class='col-lg-12'>
                            <label class='control-label'>เลือกวิธีจัดเก็บไฟล์</label>
                            <input type='text' class='form-control form-control-sm' disabled value='{$selectTypeFile[$dataMedia->file_type_select]}'>
                            <label class='control-label'>ตำแหน่งไฟล์</label>";
        if($dataMedia->file_type_select== 'textarea'){
            $html.="<textarea class='form-control form-control-sm' disabled placeholder='ใส่คำอธิบาย เก็บไว้ที่ไหน' rows='3'>{$dataMedia->file_desc}</textarea>";

        }else if($dataMedia->file_type_select== 'text'){
            $html.="<input type='text' class='form-control form-control-sm' disabled placeholder='ลิงค์ google drive' value='{$dataMedia->file_desc}'>";

        }else if($dataMedia->file_type_select== 'file'){
            $html.="<input type='file' class='form-control form-control-sm' disabled placeholder='อัปโหลดไฟล์'>";
            $html.="<input type='text' class='form-control form-control-sm' disabled value='{$dataMedia->file_desc}'>";

        }

        return response()->json($html);
    }
    public function delete($id){
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
