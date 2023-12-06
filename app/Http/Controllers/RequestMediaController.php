<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\RequestMedia;
use App\Models\RequestUser;
use App\Models\TypeMedia;
use App\Models\Book;

use Illuminate\Http\Request;
use App\Models\Emp;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
class RequestMediaController extends Controller
{
    //
    public function index()
    {
        $dataSelect = TypeMedia::all();
        $dataRequestMedia = RequestMedia::orderby('created_at')->get();
        return view('request_media.list', compact('dataSelect', 'dataRequestMedia'));
    }
    public function create(Request $request)
    {
        $requesters_id  = RequestUser::generateID();
        $request_id = RequestMedia::generateID();
        $type_media_id = $request->type_media_id;
        $book_id = $request->book_id;
        $emp = Emp::where('username', session()->get('username'))->first();
        $emp_id = $emp->emp_id;
        $Media = Media::where('book_id', $book_id)->where('type_media_id', $type_media_id)->first();
        $status = is_null($Media) ? 1 : 2;
        RequestUser::create([
            'requesters_id' => $requesters_id,
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'tel' => $request->tel,
        ]);
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
        $data = RequestMedia::find($id);
        $requestUser = RequestUser::find($request->f_name);
        $requesters_id = $request->f_name;
        $emp = Emp::where('username', session()->get('username'))->first();
        $emp_id = $emp->emp_id;
        $type_media_id = $request->type_media_id;
        $book_id = $request->book_id;
        $Media = Media::where('book_id', $book_id)->where('type_media_id', $type_media_id)->first();
        $status = is_null($Media) ? 1 : 2;
        if(is_null($requestUser)){
            $requesters_id  = RequestUser::generateID();
            RequestUser::create([
                'requesters_id' => $requesters_id,
                'f_name' => $request->f_name,
                'l_name' => $request->l_name,
                'tel' => $request->tel,
            ]);
        }else{
            $tel = $request->tel;
            $requestUser->update([
                'tel' => $tel
            ]);
        }
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
    public function fetchDataTable($status)
    {
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
                1 => "<button type='button' class='btn btn-sm btn-primary' >สั่งผลิต</button>",
                2 => "<button type='button' class='btn btn-sm btn-success' data-bs-toggle='modal' data-bs-target='#media_out_insert'>จ่ายสื่อ</button>",
                3 => "<button type='button' class='btn btn-sm btn-secondary' data-bs-toggle='modal' data-bs-target='#media_out_insert'>กำลังดำเนินการ</button>",
                4 => '',
            ];

            // Add edit and delete buttons
            $table .= "<button type='button' class='btn btn-sm btn-warning' id='btn_edit' onclick='editModal(`" . $request_id . "`)'><i class='fas fa-edit'></i></button>
                        <button type='button' class='btn btn-sm btn-danger me-1' onclick='deleteshow(`" . $request_id . "`)'><i class='fas fa-trash'></i></button>";

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
        $media = Media::where('book_id', $request->book_id)
            ->where('type_media_id', $request->type_media_id)
            ->first();

        $result = is_null($media) ? 'false' : 'true';

        return response()->json(['result' => $result]);
    }

    public function fetchUser(Request $request)
    {
        $term = $request->term;
        $data = RequestUser::where('f_name', 'like', "%$term%")
            ->select('requesters_id', 'f_name')
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
