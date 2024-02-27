<?php

namespace App\Http\Controllers;

use App\Models\Emp;
use App\Models\Book;
use App\Models\TypeBook;
use App\Models\TypeMedia;
use App\Models\OrderMedia;
use App\Models\RequestMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    //
    public function index(Request $request)
    {
        $perPage = 10;
        $page = $request->input('page', 1);
        $search_data = $request->search_data != '' ? $request->search_data : '';
        $dataSelect = TypeMedia::all();
        $searchQuery = function ($query) use ($search_data) {
            $query->whereHas('book', function ($query) use ($search_data) {
                $query->where('name', 'like', '%' . $search_data . '%');
            });
        };

        $dataRequestMedia = RequestMedia::WhereHas('book', function ($query) use ($search_data) {
            $query->where('name', 'like', '%' . $search_data . '%');
        })->where('status', 1)->paginate($perPage, ['*'], 'RequestMedia');

        $dataOrderProcessWait = OrderMedia::WhereHas('requestMedia', $searchQuery)->where('status', 1)->paginate($perPage, ['*'], 'OrderProcessWait');
        $dataOrderProcess = OrderMedia::WhereHas('requestMedia', $searchQuery)->where('status', 2)->paginate($perPage, ['*'], 'OrderProcess');
        $dataOrderSuccess = OrderMedia::WhereHas('requestMedia', $searchQuery)->where('status', 3)->paginate($perPage, ['*'], 'OrderSuccess');

        $active = isset($request->RequestMedia)  ? '0' : (isset($request->OrderProcessWait) ? '1' : (isset($request->OrderProcess) ? '2' : (isset($request->OrderSuccess) ? '3' : '0')));

        return view('order.list', compact('dataSelect', 'dataRequestMedia', 'dataOrderProcessWait', 'dataOrderProcess', 'dataOrderSuccess', 'active', 'search_data'));
    }
    public function create($id)
    {
        $requestMedia = RequestMedia::select('book_id', 'type_media_id')->where('request_id', $id)->first();
        $emp = session()->get('emp');
        $loop_data = RequestMedia::where('book_id', $requestMedia->book_id)->where('type_media_id', $requestMedia->type_media_id)->where('status', 1)->get();
        if ($loop_data->count() > 0) {
            foreach ($loop_data as $datalist) {
                $request_id = $datalist->request_id;
                OrderMedia::create([
                    'order_id' => OrderMedia::generateID(),
                    'emp_id' => $emp,
                    'request_id' => $request_id,
                    'order_date' => Carbon::now()->format('Y-m-d'),
                    'status' => 1,
                ]);
                RequestMedia::where('request_id', $request_id)->update(['status' => 3]);
            }
            Alert::success('บันทึกสำเร็จ');
            return redirect()->back();
        }
        Alert::error('ไม่พบข้อมูล');
        return redirect()->back();
    }
    public function fetchRequestMedia(Request $request)
    {
        $dataRequestMedia = RequestMedia::find($request->id);
        $dataBook = Book::find($dataRequestMedia->book_id);
        $data = ['book' => $dataBook, 'TypeMedia' => TypeMedia::find($dataRequestMedia->type_media_id), 'typeBook' => TypeBook::find($dataBook->type_book_id)];
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
    public function cancelRequestMedia(Request $request,$id){
        $requestMedia = RequestMedia::find($id);
        if ($requestMedia->count() > 0) {
            $requestMedia->update([
                'status' => '5',
                'cancel_desc' => $request->desc,
                'media_out_date' => null
            ]);
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false]);
    }
}
