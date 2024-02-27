<?php

namespace App\Http\Controllers;

use App\Models\Emp;
use App\Models\Book;
use App\Models\Media;
use App\Models\TypeMedia;
use App\Models\OrderMedia;

use App\Models\RequestUser;
use App\Models\RequestMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class RequestMediaController extends Controller
{
    //
    public function index(Request $request)
    {
        $perPage = 10;
        $page = $request->input('page', 1);

        $dataSelect = TypeMedia::all();
        $requestMediaReady = RequestMedia::where('status', 2)->orderby('created_at')->paginate($perPage, ['*'], 'requestMediaReady');
        $requestMediaSuccess = RequestMedia::where('status', 4)->orderby('created_at')->paginate($perPage, ['*'], 'requestMediaSuccess');
        $active = isset($request->requestMediaReady) ? '0' : (isset($request->requestMediaSuccess) ? '1' : 0);

        return view('request_media.list', compact('dataSelect', 'requestMediaReady', 'requestMediaSuccess', 'active'));
    }
    public function create(Request $request,$bookId,$typeMediaId)
    {
        $validator = Validator::make($request->all(), [
            'f_name' => 'required',
            'l_name' => 'required',
            'tel' => 'required',
            'desc' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message'=>'กรุณากรอกข้อมูลให้ครบถ้วน','status'=>false]);
        }
        $typeMedia = TypeMedia::find($typeMediaId);
        $media = Media::where('book_id',$bookId)->where('type_media_id',$typeMedia->type_media_id)->first();

        $requestUser = RequestUser::where('f_name', $request->f_name)->where('l_name', $request->l_name)->first();
        // $requestMediaStatus3 = RequestMedia::where('book_id',$bookId)->where('type_media_id',$typeMediaId)->where('status',3)->count();
        if (is_null($requestUser)) {
            $requesters_id = RequestUser::generateID();
            RequestUser::create([
                "requesters_id" => $requesters_id,
                "f_name" => $request->f_name,
                "l_name" => $request->l_name,
                "tel" => $request->tel,
            ]);
        } else {
            $requesters_id = $requestUser->requesters_id;
        }
        $data = [
            'request_id' => RequestMedia::generateID(),
            'type_media_id' => $typeMedia->type_media_id,
            'requesters_id' => $requesters_id,
            'book_id' => $bookId,
            'request_date' => Carbon::now()->format('Y-m-d'),
            'desc' => $request->desc,
        ];
        if(!is_null($media)){
            if($media->status == 1){
                $data['status']=3;
                $dataRequestMedia = RequestMedia::where('book_id',$bookId)->where('type_media_id',$typeMediaId)->where('status',3)->count();
                if($dataRequestMedia == 0){
                    $emp_id = Emp::where('emp_id','pd_0000001')->first()->emp_id ;
                }else{
                    $dataRequestMedia = RequestMedia::where('book_id',$bookId)->where('type_media_id',$typeMediaId)->where('status',3)->first();
                    $dataOrder = OrderMedia::where('request_id',$dataRequestMedia->request_id)->first();
                    $emp_id =$dataOrder->emp_id;
                }
                RequestMedia::create($data);
                OrderMedia::create([
                            'order_id' => OrderMedia::generateID(),
                            'emp_id' => $emp_id,
                            'request_id' => $data['request_id'],
                            'order_date' => Carbon::now()->format('Y-m-d'),
                            'status' => 2,
                        ]);
            }else{
                $data['status']=2;
                RequestMedia::create($data);
            }
        }else if(is_null($media)){
            $data['status']=1;
            RequestMedia::create($data);
        }


        return response()->json(['status'=>true]);

    }
    // public function create(Request $request,$id){
    //     $media = Media::find($id);
    //     $requestUser = RequestUser::where('f_name',$request->f_name)->where('l_name',$request->l_name)->first();
    //     if($requestUser->count == 0 ){
    //         $requesters_id = RequestUser::generateID();
    //         RequestUser::create([
    //             "requesters_id" => $requesters_id,
    //             "f_name" => $request->f_name,
    //             "l_name" => $request->l_name,
    //             "tel" => $request->tel,
    //         ]);
    //     }else{
    //         $requesters_id = $requestUser->requesters_id;
    //     }

    //     RequestMedia::create([
    //         'request_id' => RequestMedia::generateID(),
    //         'type_media_id' => $media->type_media_id,
    //         'requesters_id' => $requesters_id,
    //         'book_id' => $media->book_id,
    //         'request_date' => Carbon::now()->format('Y-m-d'),
    //         'status' => 2,
    //         'desc' => $request->desc,
    //     ]);
    //     return response()->json(['status'=>true]);
    // }
    public function delete($id)
    {
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
        $text = [1 => 'สั่งผลิต', 2 => 'พร้อมให้บริการสื่อ', 3 => 'รอผลิต', 4 => 'ให้บริการสื่อเรียบร้อย'];
        foreach ($RequestMedia as $datalist) {
            $date = Carbon::parse($datalist->request_date)->format('d/m/Y');
            $table .= "<tr>
                        <td class='text-center'>{$number}</td>
                        <td>{$datalist->Book->name}</td>
                        <td>{$datalist->TypeMedia->name}</td>
                        <td>{$date}</td>
                        <td>{$datalist->RequestUser->f_name} {$datalist->RequestUser->l_name}</td>
                        <td>{$text[$datalist->status]}</td>
                        <td>";

            // Define button array with corresponding conditions
            $request_id = $datalist->request_id;
            $buttons = [
                1 => "<button type='button' class='btn btn-sm btn-primary' onclick='createModal_order(`" . $request_id . "`)'>สั่งผลิต</button>",
                2 => "<button type='button' class='btn btn-sm btn-success' data-bs-toggle='modal' data-bs-target='#media_out_insert'>ให้บริการสื่อ</button>",
                3 => "<button type='button' class='btn btn-sm btn-secondary' disabled>กำลังดำเนินการ</button>",
                4 => '',
            ];
            $table .=  $buttons[$status];
            if ($datalist->status != 3) {
                $table .= " <button type='button' class='btn btn-sm btn-danger me-1' onclick='deleteshow(`" . $request_id . "`)'><i class='fas fa-trash'></i></button>";
            } else {
                $table .= " <button type='button' class='btn btn-sm btn-info me-1' id='btn_edit' onclick='createModal_order(`" . $request_id . "`)'><i class='fas fa-eye'></i></button>";
            }
            $table .= "</td></tr>";
            $number++;
        }
        return response()->json($table);
    }
}
