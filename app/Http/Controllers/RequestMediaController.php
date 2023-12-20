<?php

namespace App\Http\Controllers;

use App\Models\Emp;
use App\Models\Book;
use App\Models\Media;
use App\Models\TypeMedia;
use App\Models\RequestUser;

use App\Models\RequestMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class RequestMediaController extends Controller
{
    //
    public function index()
    {
        $dataSelect = TypeMedia::all();
        $dataRequestMedia = RequestMedia::orderby('created_at')->get();
        return view('request_media.list', compact('dataSelect', 'dataRequestMedia'));
    }
    private function createRequestUser($data){
        RequestUser::create($data);
    }
    private function checkRequestUser($requestUser,$request){
        $l_name = $request->l_name;
        $f_name = $requestUser->f_name;
        $tel = $request->tel;
        $requesters_id  = RequestUser::generateID();
        $dataInsert = [
            'requesters_id' => $requesters_id,
            'f_name' => $f_name,
            'l_name' => $l_name,
            'tel' => $tel,
        ];
        if(is_null($requestUser)){
            //ถ้าไม่พบข้อมู,ให้สร้างใหม่
            $this->createRequestUser($dataInsert);
        }else{
            $data = RequestUser::where('f_name',$requestUser->f_name)->where('l_name', $l_name)->first();
            if (!is_null($data)) {
                $existingUser = $data;
                if($existingUser->tel != $tel ){
                    $requestUser->update([
                        'tel' => $tel
                    ]);
                }
                $requesters_id = $existingUser->requesters_id;
            }else{
                $this->createRequestUser($dataInsert);
            }

            return $requesters_id;
        }
    }
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'f_name' => 'required',
            'l_name' => 'required',
            'tel' => 'required',
            'book_id' => 'required',
        ]);
        if ($validator->fails()) {
            Alert::error('เกิดข้อผิดพลาด', 'กรุณากรอกข้อมูลให้ครบถ้วน');
            return redirect()->back();
        }
        $requestUser = RequestUser::where('requesters_id',$request->f_name)->first();
        $requesters_id = $this->checkRequestUser($requestUser,$request);

        $request_id = RequestMedia::generateID();
        $book_id = $request->book_id;
        $type_media_id = $request->type_media_id;

        $emp = Emp::where('username', session()->get('username'))->first();
        $media = Media::where('book_id', $book_id)->where('type_media_id', $request->type_media_id);

        $emp_id = $emp->emp_id;
        $status = $media->where('status',1)->count() > 0 ? 3 : ($media->where('status',2)->count() > 0 ? 2 : 1);
        RequestMedia::create([
            'request_id' => $request_id,
            'emp_id' => $emp_id,
            'type_media_id' => $type_media_id,
            'requesters_id' => $requesters_id,
            'book_id' => $book_id,
            'request_date' => Carbon::now()->format('Y-m-d'),
            'status' => $status,
        ]);
        Alert::success('บันทึกสำเร็จ');
        return redirect()->back();
    }
    public function update($id,Request $request){
        $validator = Validator::make($request->all(), [
            'f_name' => 'required',
            'l_name' => 'required',
            'tel' => 'required',
            'book_id' => 'required',
        ]);
        if ($validator->fails()) {
            Alert::error('เกิดข้อผิดพลาด', 'กรุณากรอกข้อมูลให้ครบถ้วน');
            return redirect()->back();
        }

        $book_id = $request->book_id;
        $type_media_id = $request->type_media_id;
        $requesters_id = $request->f_name;

        $data = RequestMedia::find($id);
        $requestUser = RequestUser::find($requesters_id);
        $emp = Emp::where('username', session()->get('username'))->first();
        $media = Media::where('book_id', $book_id)->where('type_media_id', $request->type_media_id);

        $emp_id = $emp->emp_id;
        $status = $media->where('status',1)->count() > 0 ? 3 : ($media->where('status',2)->count() > 0 ? 2 : 1);

        $requesters_id = $this->checkRequestUser($requestUser,$request);

        $data->update([
            'emp_id' => $emp_id,
            'type_media_id' => $type_media_id,
            'requesters_id' => $requesters_id,
            'book_id' => $book_id,
            'request_date' => Carbon::now()->format('Y-m-d'),
            'status' => $status,
        ]);

        Alert::success('แก้ไขข้อมูลสำเร็จ');
        return redirect()->back();
    }
    public function delete($id){
        $RequestMedia = RequestMedia::find($id);
        $RequestMedia->delete();
        $check = true;
        return response()->json($check);

    }
    public function fetchDataTable($status){
        $RequestMedia = RequestMedia::where('status', $status)->orderBy('created_at')->get();
        $table = '';
        $number = 1;
        $text = [1 => 'สั่งผลิต', 2 => 'พร้อมจ่ายสื่อ', 3 => 'รอผลิต', 4 => 'จ่ายสื่อเรียบร้อย'];
        foreach ($RequestMedia as $datalist) {

            $date = Carbon::parse($datalist->request_date)->format('d/m/Y');
            $table .= "<tr>
                        <td class='text-center'>{$number}</td>
                        <td>{$datalist->Book->name}</td>
                        <td>{$datalist->TypeMedia->name}</td>
                        <td>{$date}</td>
                        <td>{$datalist->Emp->f_name} {$datalist->Emp->l_name}</td>
                        <td>{$datalist->RequestUser->f_name} {$datalist->RequestUser->l_name}</td>
                        <td>{$text[$datalist->status]}</td>
                        <td>";

            // Define button array with corresponding conditions
            $request_id = $datalist->request_id;
            $buttons = [
                1 => "<button type='button' class='btn btn-sm btn-primary' onclick='createModal_order(`".$request_id."`)'>สั่งผลิต</button>",
                2 => "<button type='button' class='btn btn-sm btn-success' data-bs-toggle='modal' data-bs-target='#media_out_insert'>จ่ายสื่อ</button>",
                3 => "<button type='button' class='btn btn-sm btn-secondary' disabled>กำลังดำเนินการ</button>",
                4 => '',
            ];
            if($datalist->status != 3){
                $table .= " <button type='button' class='btn btn-sm btn-warning' id='btn_edit_$request_id' onclick='editModal_requestMedia(`" . $request_id . "`)'><i class='fas fa-edit'></i></button>
                            <button type='button' class='btn btn-sm btn-danger me-1' onclick='deleteshow(`" . $request_id . "`)'><i class='fas fa-trash'></i></button>";
            }else{
                $table .= " <button type='button' class='btn btn-sm btn-info me-1' id='btn_edit' onclick='createModal_order(`" . $request_id . "`)'><i class='fas fa-eye'></i></button>";
            }
            // Add edit and delete buttons


            // Add conditionally rendered button
            $table .=  $buttons[$status];

            $table .= "</td></tr>";
            $number++;
        }
        return response()->json($table);
    }
    public function fetchDataEdit(Request $request)
    {
        $request_id = $request->id;
        $requestMedia = RequestMedia::where('request_id', $request_id)->first();
        $requestUser = RequestUser::where('requesters_id',$requestMedia->requesters_id)->select('tel','f_name','requesters_id')->first();
        $book = Book::where('book_id',$requestMedia->book_id)->select('name','book_id')->first();
        $emp = Emp::where('emp_id',$requestMedia->emp_id)->select('f_name','l_name')->first();
        $typeMedia = $requestMedia->TypeMedia->type_media_id;
        $data = compact('requestUser', 'emp',  'typeMedia', 'book');

        return response()->json($data);
    }

    public function fetchStatus(Request $request)
    {

        $media = Media::where('book_id', $request->book_id)->where('type_media_id', $request->type_media_id);
        $result = $media->where('status',1)->count() > 0 ? 'กำลังผลิต' : ($media->where('status',2)->count() > 0 ? 'พร้อมจ่าย' : 'สั่งผลิต');
        return response()->json($result);
    }

    public function fetchUser(Request $request)
    {
        $term = $request->term;
        $data = RequestUser::where('f_name', 'like', "%$term%")
            ->select('requesters_id', 'f_name','l_name')
            ->get();

        return response()->json($data);
    }

    public function fetchUserLastName(Request $request)
    {
        $data = RequestUser::where('requesters_id', $request->requesters_id)
            ->select('l_name','tel')
            ->first();

        return response()->json($data);
    }
}
