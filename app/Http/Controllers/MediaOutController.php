<?php

namespace App\Http\Controllers;

use App\Models\Emp;
use App\Models\Book;
use App\Models\MediaOut;
use App\Models\RequestUser;
use App\Models\RequestMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class MediaOutController extends Controller
{
    //
    public function index(Request $request)
    {
        $perPage = 10; // จำนวนรายการต่อหน้า
        $page = $request->input('page', 1);
        $search_data = $request->search_data != '' ? $request->search_data : '';

        $requestMediaProcess = RequestMedia::WhereHas('book', function ($query) use ($search_data) {
                                            $query->where('name', 'like', '%' . $search_data . '%');
                                            })->where('status', '2')->paginate($perPage, ['*'], 'requestMediaProcess');
        $requestMediaSuccess = MediaOut::WhereHas('requestMedia', function ($query) use ($search_data) {
            $query->whereHas('book', function ($query) use ($search_data) {
                $query->where('name', 'like', '%' . $search_data . '%');
            });
        })->where('status', '1')->paginate($perPage, ['*'], 'requestMediaSuccess');
        $active = isset($request->requestMediaProcess) ? '0' : (isset($request->requestMediaSuccess) ? '1' : '0');
        return view('media_out.list', compact('requestMediaProcess', 'requestMediaSuccess', 'active', 'search_data'));
    }
    public function create(Request $request, $id)
    {
        $emp_id = session()->get('emp');
        MediaOut::create([
            'md_out_id' => MediaOut::generateID(),
            'request_id' => $id,
            'emp_id' => $emp_id,
            'md_out_date' => $request->md_out_date,
            'status' => 1,
        ]);
        RequestMedia::find($id)->update([
            'status' => '4',
            'emp_id' => $emp_id,
            'media_out_date' => $request->md_out_date
        ]);
        Alert::success('บันทึกสำเร็จ');
        return redirect()->back();
    }
    public function cancel(Request $request, $id)
    {

        $mediaOut = MediaOut::find($id);
        if ($mediaOut->count() > 0) {
            RequestMedia::find($mediaOut->request_id)->update([
                'status' => '2',
                'media_out_date' => null
            ]);
            $mediaOut->update([
                'status' => 2,
                'desc' => $request->desc,
            ]);
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false]);
    }
    public function cancelRequest(Request $request, $id)
    {
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
    public function fetchData(Request $request)
    {
        $requestMedia = RequestMedia::find($request->id);
        $requestUser = RequestUser::find($requestMedia->requesters_id);
        if ($requestMedia->status == 2) {
            $emp = Session::get('emp');
            $dataEmp = Emp::find($emp);
            $emp = $dataEmp->f_name . " " . $dataEmp->l_name;
        } else {
            $emp = $requestMedia->Emp->f_name . " " . $requestMedia->Emp->l_name;
        }
        $book_name = $requestMedia->Book->name;
        $type_media = $requestMedia->TypeMedia->name;
        $status = $requestMedia->count() == 0 ? false : true;
        $data = [
            'requestMedia' => $requestMedia,
            'requestUser' => $requestUser,
            'book_name' => $book_name,
            'emp' => $emp,
            'type_media' => $type_media,
            'status' => $status,
        ];
        return response()->json($data);
    }
}
