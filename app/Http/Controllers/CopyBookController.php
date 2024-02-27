<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\CopyBook;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CopyBookController extends Controller
{
    //
    public function index(Request $request)
    {
        $search_data = $request->search_data != '' ? $request->search_data : '';
        $data = CopyBook::whereHas('book', function ($query) use ($search_data) {
                            $query->where('name', 'like', '%' . $search_data . '%');
                        })->orderby('created_at')->paginate(10);
        return view('copy_book/list', compact('data','search_data'));
    }
    public function fetchData(Request $request)
    {
        $id = $request->input('id');
        $data = CopyBook::find($id);
        return response()->json($data);
    }
    public function update(Request $request, $id, $math)
    {
        if ($request->amount == 0) {
            Alert::error('เกิดข้อผิดพลาด', 'กรุณาระบุตัวเลขให้ถูกต้อง');
            return redirect()->back();
        }
        $data = CopyBook::find($id);
        $amount = ($math == 'plus') ? ($data->amount + $request->amount) : ($data->amount - $request->amount);

        if ($amount < 0) {
            Alert::error('เกิดข้อผิดพลาด', 'ไม่สามารถบันทึกได้ เนื่องจากตัวเลขติดลบ');
            return redirect()->back();
        }
        $data->update(['amount' => $amount]);
        Alert::success('บันทึกสำเร็จ');
        return redirect()->back();
    }
}
