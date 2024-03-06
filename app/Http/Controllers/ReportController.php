<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\MediaOut;
use App\Models\TypeMedia;
use App\Models\RequestUser;
use App\Models\RequestMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Decoders\DataUriImageDecoder;
use Intervention\Image\Decoders\Base64ImageDecoder;

class ReportController extends Controller
{
    //
    public function index()
    {
        $dataTypeMedia = TypeMedia::orderby('name')->get();
        return view('report/list', compact('dataTypeMedia'));
    }
    public function reportPdf(Request $request)
    {
        $typeReport = $request->type_report;
        $dateStart = $request->dateStart;
        $dateEnd = $request->dateEnd;
        $type_media_id = $request->type_mediaOut;
        $chart_type = array('media_summary', 'mediaout_summary');
        $header = [
            'media' => 'รายงาน การผลิตสื่อ', 'mediaout' => 'รายงาน การให้บริการสื่อ', 'request_user' => 'รายงาน ผู้มาขอรับสื่อ',
            'media_summary' => 'รายงาน ผลสรุปการผลิตสื่อ', 'mediaout_summary' => 'รายงาน ผลสรุปการให้บริการสื่อ'
        ];
        $dateReport = Carbon::now()->locale('th')->addYears(543)->isoFormat('D MMMM พ.ศ. Y');
        $dateStartFormat = Carbon::parse($dateStart)->locale('th')->addYears(543)->isoFormat('D/MM/Y');
        $dateEndFormat = Carbon::parse($dateEnd)->locale('th')->addYears(543)->isoFormat('D/MM/Y');
        $height = 841.89;
        $data = [
            'height' => $height,
            'header' => $header[$typeReport],
            'dateReport' => $dateReport,
            'dateStart' => $dateStartFormat,
            'dateEnd' => $dateEndFormat
        ];
        if ($typeReport == 'media' || $typeReport == 'mediaout') {
            $data['typeMedia'] = $type_media_id == 'all' ? 'ทุกประเภท' : TypeMedia::where('type_media_id', $type_media_id)->first()->name;
            if ($typeReport == 'media') {
                $type_status = $request->type_status;
                $dataMedia = Media::whereBetween('created_at', [$dateStart, $dateEnd]);
                if ($type_status != 'all') {
                    $dataMedia->where('status', $type_status);
                }
                if ($type_media_id != 'all') {
                    $dataMedia->where('type_media_id', $type_media_id);
                }
                $data['dataMedia'] = $dataMedia->orderBy('created_at')->orderBy('number')->get();
                $pdf = PDF::loadView('report.reportMedia', $data);
            } else {
                $dataRequestMedia = RequestMedia::where('status', 4)->orWhere('status', 5);
                $dataMediaOut = MediaOut::whereBetween('created_at', [$dateStart, $dateEnd]);
                $status = $request->status;
                if ($type_media_id != 'all') {
                    $dataRequestMedia->where('type_media_id', $type_media_id);
                    $dataMediaOut->WhereHas('requestMedia', function ($query) use ($type_media_id) {
                        $query->where('type_media_id', $type_media_id);
                    });
                }

                if ($status != 'all') {
                    $dataMediaOut->where('status', $status);
                }
                $data['dataMedia'] = Media::orderBy('number')->get();
                $data['dataMediaOut'] = $dataMediaOut->orderBy('created_at')->orderBy('md_out_id')->get();
                $data['dataRequestMedia'] = $dataRequestMedia->get();

                $pdf = PDF::loadView('report.reportMediaOut', $data);
            }
        } else if ($typeReport == 'request_user') {
            $dataRequestMedia = RequestMedia::orderBy('book_id');
            $div_request_status = $request->div_request_status;
            if($div_request_status == '1'){
                $dataRequestMedia->where('status',4);
            }else if($div_request_status == '2'){
                $dataRequestMedia->where('status','!=',4)->where('status','!=',5);
            }else if($div_request_status == '3'){
                $dataRequestMedia->where('status',5);
            }
            $dataRequestMedia = $dataRequestMedia->get();
            $requestersId_Array = $dataRequestMedia->pluck('requesters_id')->toArray();
            $dataRequest_user = RequestUser::whereIn('requesters_id',$requestersId_Array)->whereBetween('created_at', [$dateStart, $dateEnd])->orderBy('f_name')->get();
            $data['dataRequest_user'] = $dataRequest_user;
            $data['dataRequestMedia'] = $dataRequestMedia;
            $data['div_request_status'] = $div_request_status;

            $pdf = PDF::loadView('report.reportRequestUser', $data);
        } else if (in_array($typeReport, $chart_type)) {
            $dataHeader = ['media_summary' => 'จำนวนสื่อทั้งหมด', 'mediaout_summary' => 'จำนวนสื่อที่ให้บริการทั้งหมด'];
            if($typeReport == 'media_summary'){
                $addDataHeaderType_status = ['all'=>'','1'=>'ที่กำลังผลิต','2'=>'ที่ผลิตเสร็จ'];
                $dataHeader= $dataHeader[$typeReport].$addDataHeaderType_status[$request->type_status];
            }else{
                $addDataHeaderStatus = ['all'=>'','1'=>'ที่ให้บริการสำเร็จ','2'=>'ที่ยกเลิกรายการ'];
                $dataHeader = $dataHeader[$typeReport].$addDataHeaderStatus[$request->status];
            }
            $data['dataHeader'] = $dataHeader;
            $data['chartData'] = $this->saveChart($request->chartData);
            $pdf = PDF::loadView('report.reportChartMedia', $data);
        }
        $pdf->set_option("isPhpEnabled", true);
        $pdf->set_option("isJavascriptEnabled", true);
        $pdf->setPaper('A4');

        return $pdf->stream();
    }
    public function chart(Request $request)
    {
        $typeReport = $request->type_report;
        $dateStart = $request->startDate;
        $dateEnd = $request->endDate;
        $data = [];
        if ($typeReport == 'media_summary') {
            $dataMedia = Media::whereBetween('created_at', [$dateStart, $dateEnd]);
            $typeMedia = TypeMedia::orderBy('type_media_id')->get();
            $type_status = $request->type_status;
            if($type_status != 'all'){
                $dataMedia->where('status', $type_status);
            }
            $dataMedia = $dataMedia->get();
            foreach ($typeMedia as $typeMediaItem) {
                $data[$typeMediaItem->name] = $dataMedia->where('type_media_id', $typeMediaItem->type_media_id)->count();
            }
        } else if ($typeReport == 'mediaout_summary') {
            $dataMediaOut = MediaOut::whereBetween('created_at', [$dateStart, $dateEnd]);
            $status = $request->status;
            if($status != 'all'){
                $dataMediaOut->where('status', $status);
            }
            $dataMediaOut = $dataMediaOut->get();
            $typeMedia = TypeMedia::all();
            foreach($typeMedia as $typeMediaItem){
                $dataRequest = RequestMedia::where('type_media_id', $typeMediaItem->type_media_id)->get();
                $request_id_Array = $dataRequest->pluck('request_id')->toArray();
                $number = $dataMediaOut->whereIn('request_id',$request_id_Array)->count();
                $data[$typeMediaItem->name] = $number;
            }
        }
        $json_data = ['data' => $data];
        return response()->json($json_data);
    }
    private function saveChart($chartData)
    {
        $manager = new ImageManager(new Driver());
        $image = $manager->read($chartData, [
            DataUriImageDecoder::class,
            Base64ImageDecoder::class,
        ]);
        $timeNow = Carbon::now()->format('His');
        $dateNow = Carbon::now()->format('Y-m-d');

        $file_name = $timeNow . '_chart.png';
        $path = public_path('assets/images/chartData/' . $dateNow);
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
        $newFilePath = $path . '/' . $file_name;
        // file_put_contents($newFilePath, $image);
        $image->save($newFilePath);
        $allFolders = File::directories('assets/images/chartData/');
        $selectPath = "assets/images/chartData\\" . $dateNow;
        foreach ($allFolders as $folder) {
            // Ensure $folder is a directory
            if (File::isDirectory($folder)) {
                if ($folder !== $selectPath) {
                    File::deleteDirectory($folder);
                }
            }
        }
        return 'assets/images/chartData/' . $dateNow . '/' . $file_name;
    }
}
