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
            $table .=  $buttons[$status];
            if($datalist->status != 3){
                $table .= " <button type='button' class='btn btn-sm btn-danger me-1' onclick='deleteshow(`" . $request_id . "`)'><i class='fas fa-trash'></i></button>";
            }else{
                $table .= " <button type='button' class='btn btn-sm btn-info me-1' id='btn_edit' onclick='createModal_order(`" . $request_id . "`)'><i class='fas fa-eye'></i></button>";
            }
            $table .= "</td></tr>";
            $number++;
        }
        return response()->json($table);
    }


}
