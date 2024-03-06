<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Media;
use App\Models\TypeMedia;
use App\Models\RequestMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        if (session()->get('Logged') != 'true') {
            return redirect()->route('login');
        }

        Carbon::setLocale('th');
        $monthNumberMedia = [];
        $monthNumberRequestMedia = [];
        for($i = 1; $i <= 12; $i++){
            $specificDate = Carbon::now()->month($i);
            $monthNumberMedia[$specificDate->monthName] = Media::whereMonth('created_at',$i)->count();
            $monthNumberRequestMedia[$specificDate->monthName] = RequestMedia::whereMonth('created_at',$i)->count();
        }

        $dataTypeMedia = TypeMedia::orderBy('name')->get();
        $dataMedia = Media::whereMonth('created_at',Carbon::now()->month)->get();
        $dataRequestMedia = RequestMedia::whereMonth('created_at',Carbon::now()->month)->get();
        return view('dashboard_pd',compact('monthNumberMedia','monthNumberRequestMedia','dataTypeMedia','dataMedia','dataRequestMedia'));
    }
    public function searchBook(Request $request)
    {
        $search = $request->search;
        Session::put('search', $search);
        $dataBook = null;
        if (isset($search)) {
            $dataBook = Book::where('name', 'like', '%' . $search . '%')->get();
        }
        return view('searchBook', compact('search', 'dataBook'));
    }
    public function searchBookDetail(Request $request, $id)
    {
        $search = Session::get('search');
        $dataBook = Book::find($id);
        $dataMedia = Media::where('book_id', $id)->get();
        $dataTypeMedia = TypeMedia::all();
        return view('searchBookDetail', compact('dataBook', 'dataMedia', 'search', 'dataTypeMedia'));
    }
    public function showBookDetail(Request $request, $id)
    {
        $dataTypeMedia = TypeMedia::find($request->typeMedia);
        $dataBook = Book::find($id);
        $dataMedia = Media::where('book_id', $id)->where('type_media_id', $dataTypeMedia->type_media_id)->first();
        $bookFields = [];
        // $dataMedia = Media::find($id);
        $modalHeader = '';
        $tableBody = '';
        $modalHeader .= "<h5 class='modal-title'>รายละเอียดสื่อ{$dataTypeMedia->name} ของหนังสือ {$dataBook->name}  </h5>";
        // $modalHeader.= "<h5 class='modal-title'>รายละเอียดสื่อ{$dataMedia->TypeMedia->name} ของหนังสือ {$dataMedia->Book->name}  </h5>";
        if (is_null($dataMedia) || $dataMedia->status != 2) {
            $tableBody = 'ไม่มีข้อมูล ส่งคำขอเพื่อสั่งผลิตสื่อ';
        } else {
            $dataFields = [
                'ระบบเสียง' => $dataMedia->sound_sys,
                'เวลา ของไฟล์สื่อ' => $dataMedia->time_hour,
                'time_minute' => $dataMedia->time_minute,
                'จำนวนหน้าอักษรเบลล์' => $dataMedia->braille_page,
                'จำนวนเล่มจบ' => $dataMedia->amount_end,
                'แหล่งที่มา' => $dataMedia->source,
                'ผู้ที่แปลสื่อหรือพากย์เสียง' => $dataMedia->translator,
            ];
            foreach ($dataFields as $dataText => $dataValue) {
                if (!empty($dataValue)) {
                    $bookFields[$dataText] = $dataValue;
                }
            }

            foreach ($bookFields as $label => $value) {
                if (!empty($value)) {

                    if ($label == 'จำนวนหน้าอักษรเบลล์') {
                        $value .= ' หน้า';
                    }
                    if ($label == 'จำนวนเล่มจบ') {
                        $value .= ' เล่ม';
                    }
                    if ($label === 'เวลา ของไฟล์สื่อ' && !empty($bookFields['time_minute'])) {
                        $value .= ' ชั่วโมง ' . $bookFields['time_minute'] . ' นาที';
                    }
                    if ($label != 'time_minute') {
                        $tableBody .= "<tr><td width='25%'>$label</td><td>: $value</td></tr>";
                    }
                }
            }
        }

        if($dataMedia->media_file_check == 1){
            $path = $dataMedia->file_desc;
            $newPath = str_replace("D:\\Project_End\\Project_End\\public\\assets/", "", $path);
            $audioPath = asset('assets/'.$newPath);
            $tableBody.="<br><audio controls>
                <source src='{$audioPath}' type='audio/mpeg'>
            </audio>";
        }

        return response()->json(['status' => true, 'modalHeader' => $modalHeader, 'tableBody' => $tableBody]);
    }
    public function fetchNotification()
    {
        $data = RequestMedia::where('status','!=',3)->where('status','!=',4)->where('status','!=',5)->orderBy('created_at', 'DESC')->take(3)->get();
        $html = '';
        $url = [1=>route('order.list'),2=>route('mediaOut.list'),3=>route('order.list')];
        $status_lable = [1=>'สั่งผลิต',2=>'ให้บริการ',3=>'กำลังผลิต'];
        foreach ($data as $datalist) {
            $html .= "<div class='row' style='margin-bottom: -0.5rem!important;'>
                        <div class='col-md-8'>
                            <p style='padding-left: 0.3cm;'>{$datalist->book->name}</p>
                            <p style='padding-left: 0.3cm;'>{$datalist->TypeMedia->name}</p>
                        </div>
                        <div class='col-md-4 text-end'>
                            <a href='{$url[$datalist->status]}' class='btn btn-danger btn-sm' style='margin-right: 0.3cm;'>{$status_lable[$datalist->status]}</a>
                        </div>
                    </div>
                    <hr style='margin:0.5rem 0'>";
        }
        return response()->json($html);
    }
    public function fetchNotificationNumber()
    {
        $data = RequestMedia::where('status','!=',3)->where('status','!=',4)->where('status','!=',5)->orderBy('created_at', 'DESC')->count();
        return response()->json($data);
    }
}
