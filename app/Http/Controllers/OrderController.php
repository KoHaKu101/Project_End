<?php

namespace App\Http\Controllers;

use App\Models\Emp;
use App\Models\TypeMedia;
use App\Models\OrderMedia;
use App\Models\RequestMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    //
    public function index()
    {
        $dataSelect = TypeMedia::all();
        return view('order.list', compact('dataSelect'));
    }
    public function create($id)
    {
        $requestMedia = RequestMedia::find($id);
        $emp = Emp::where('username', session()->get('username'))->first();
        $loop_data = RequestMedia::where('book_id',$requestMedia->book_id)->where('type_media_id',$requestMedia->type_media_id)->where('status',1)->get();
        if($loop_data->count() > 0){
            foreach($loop_data as $datalist){
                $request_id = $datalist->request_id ;
                OrderMedia::create([
                    'order_id' => OrderMedia::generateID(),
                    'emp_id' => $emp->emp_id,
                    'request_id' => $request_id,
                    'order_date' => Carbon::now()->format('Y-m-d'),
                    'status' => 1,
                ]);
                RequestMedia::where('request_id',$request_id)->update(['status' => 3]);

            }
            Alert::success('บันทึกสำเร็จ');
            return redirect()->back();
        }
        Alert::error('ไม่พบข้อมูล');
        return redirect()->back();

    }
    public function fetchRequestMedia(Request $request){

        $RequestMedia = RequestMedia::where('request_id', $request->id)->first();
        $text = [1 => 'สั่งผลิต', 2 => 'พร้อมจ่ายสื่อ', 3 => 'รอผลิต', 4 => 'จ่ายสื่อเรียบร้อย'];
        $url = route('order.create', $request->id);
        $status = $RequestMedia->status;
        $html = "<form action='{$url}' method='POST' id='form_order'>
                    " . csrf_field() . "
                    <div class='row'>
                        <div class='col-lg-12'>
                            <label>ชื่อหนังสือ</label>
                            <input type='text' class='form-control' value='{$RequestMedia->book->name}'disabled>
                        </div>
                        <div class='col-lg-8'>
                            <label>ประเภทสื่อ</label>
                            <input type='text' class='form-control' value='{$RequestMedia->TypeMedia->name}' disabled>
                        </div>
                        <div class='col-lg-4'>
                            <label>สถานะ</label>
                            <input type='text' class='form-control' value='{$text[$status]}' disabled>
                        </div>
                        <div class='col-lg-6'>
                            <label>ชื่อ</label>
                            <input type='text' class='form-control' value='{$RequestMedia->RequestUser->f_name}' disabled>
                        </div>
                        <div class='col-lg-6'>
                            <label>นามสกุล</label>
                            <input type='text' class='form-control' value='{$RequestMedia->RequestUser->l_name}' disabled>
                        </div>
                        <div class='col-lg-12'>
                            <label>เบอร์โทรศัพท์</label>
                            <input type='text' class='form-control' value='{$RequestMedia->RequestUser->tel}' disabled>
                        </div>
                        <div class='col-lg-12'>
                            <label>เจ้าหน้าที่ </label>
                            <input type='text' class='form-control' value='{$RequestMedia->emp->f_name} {$RequestMedia->emp->l_name}' disabled>
                        </div>
                    </div>
                </form>";
        $data = ['html' => $html, 'status' => $status];
        return response()->json($data);
    }
    public function tableData(Request $request)
    {
        $html = '';
        $status = $request->status;
        $data = OrderMedia::where('status', $status)->orderBy('created_at')->get();
        foreach ($data as $index => $datalist) {
            $fullName = $datalist->RequestMedia->emp->f_name . ' ' . $datalist->RequestMedia->emp->l_name;
            $date = Carbon::parse($datalist->order_date)->format('d/m/Y');
            $html .= "<tr>
                    <td class='text-center'>" . ($index + 1) . "</td>
                    <td>{$datalist->RequestMedia->Book->name}</td>
                    <td>{$datalist->RequestMedia->TypeMedia->name}</td>
                    <td>{$date}</td>
                    <td>{$fullName}</td>
                    <td>
                    <button type='button' class='btn btn-sm btn-info me-1' id='btn_edit' onclick='createModal_order(`{$datalist->request_id}`)'><i class='fas fa-eye'></i></button>
                    </td>
                </tr>";
        }
        return response()->json($html);
    }
}
