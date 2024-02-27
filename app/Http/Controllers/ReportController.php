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
        $header = ['media' => 'รายงาน การผลิตสื่อ', 'mediaout' => 'รายงาน การให้บริการสื่อ', 'request_user' => 'รายงาน ผู้มาขอรับสื่อ',
                   'media_summary' => 'รายงาน ผลสรุปการผลิตสื่อ','mediaout_summary'=>'รายงาน ผลสรุปการให้บริการสื่อ'];
        $typeMedia = $type_media_id == 'all' ? 'ทุกประเภท' : TypeMedia::where('type_media_id', $type_media_id)->first()->name;
        $dateReport = Carbon::now()->locale('th')->addYears(543)->isoFormat('D MMMM พ.ศ. Y');
        $dateStartFormat = Carbon::parse($dateStart)->locale('th')->addYears(543)->isoFormat('D/MM/Y');
        $dateEndFormat = Carbon::parse($dateEnd)->locale('th')->addYears(543)->isoFormat('D/MM/Y');

        $height = 841.89;
        if ($typeReport == 'media') {
            if ($type_media_id == 'all') {
                $dataMedia = Media::whereBetween('created_at', [$dateStart, $dateEnd])->orderBy('created_at')->orderBy('number')->get();
            } else {
                $dataMedia = Media::where('type_media_id', $type_media_id)->whereBetween('created_at', [$dateStart, $dateEnd])->orderBy('created_at')->orderBy('number')->get();
            }
            $data = [
                'height' => $height,
                'header' => $header[$typeReport],
                'typeMedia' => $typeMedia,
                'dataMedia' => $dataMedia,
                'dateReport' => $dateReport,
                'dateStart' => $dateStartFormat,
                'dateEnd' => $dateEndFormat
            ];
            $pdf = PDF::loadView('report.reportMedia', $data);
        } else if ($typeReport == 'mediaout') {
            if ($type_media_id == 'all') {
                $dataMedia = Media::orderBy('number')->get();
                $dataRequestMedia = RequestMedia::where('status',4)->orWhere('status',5)->get();
                $dataMediaOut = MediaOut::whereBetween('created_at', [$dateStart, $dateEnd])->orderBy('created_at')->get();
            } else {
                $dataMedia = Media::where('type_media_id', $type_media_id)->get();
                $dataRequestMedia = RequestMedia::where('status',4)->orWhere('status',5)->get();
                $dataMediaOut = MediaOut::whereBetween('created_at', [$dateStart, $dateEnd])->orderBy('created_at')->orderBy('md_out_id')->get();
            }
            $data = [
                'height' => $height,
                'header' => $header[$typeReport],
                'dataMedia' => $dataMedia,
                'dataMediaOut' => $dataMediaOut,
                'dataRequestMedia' => $dataRequestMedia,
                'typeMedia' => $typeMedia,
                'dateReport' => $dateReport,
                'dateStart' => $dateStartFormat,
                'dateEnd' => $dateEndFormat
            ];
            $pdf = PDF::loadView('report.reportMediaOut', $data);
        } else if ($typeReport == 'request_user') {
            $dataRequestMedia = RequestMedia::all();
            $dataRequest_user = RequestUser::whereBetween('created_at', [$dateStart, $dateEnd])->orderBy('f_name')->get();
            $data = [
                'height' => $height,
                'header' => $header[$typeReport],
                'dataRequest_user' => $dataRequest_user,
                'dataRequestMedia' => $dataRequestMedia,
                'dateReport' => $dateReport,
                'dateStart' => $dateStartFormat,
                'dateEnd' => $dateEndFormat
            ];
            $pdf = PDF::loadView('report.reportRequestUser', $data);
        } else if (in_array($typeReport, $chart_type)) {
            $dataHeader = ['media_summary' => 'จำนวนสื่อทั้งหมด','mediaout_summary'=>'จำนวนสื่อที่ให้บริการทั้งหมด'];
            $data = [
                'height' => $height,
                'header' => $header[$typeReport],
                'dataHeader' => $dataHeader[$typeReport],
                'dateReport' => $dateReport,
                'dateStart' => $dateStartFormat,
                'dateEnd' => $dateEndFormat
            ];
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
            $dataMedia = Media::whereBetween('created_at', [$dateStart, $dateEnd])->get();
            $typeMedia = TypeMedia::all();
            foreach ($typeMedia as $typeMediaItem) {
                $data[$typeMediaItem->name] = $dataMedia->where('type_media_id', $typeMediaItem->type_media_id)->count();
            }
        } else if ($typeReport == 'mediaout_summary') {
            $dataMediaOut = MediaOut::whereBetween('created_at', [$dateStart, $dateEnd])->where('status',1)->get();
            $typeMedia = TypeMedia::all();
            foreach ($typeMedia as $typeMediaItem) {
                $dataRequest = RequestMedia::where('type_media_id', $typeMediaItem->type_media_id)->where('status',4)->get();
                $number = 0;
                foreach($dataRequest as $datalist){
                    if($dataMediaOut->where('request_id', $datalist->request_id)->count() > 0){
                        $number++;
                    }
                }
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
