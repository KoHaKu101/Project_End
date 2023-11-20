<?php

namespace App\Http\Controllers;

use App\Models\TypeBook;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TypeBookController extends Controller
{
    //
    public function index(){
        $data = TypeBook::orderby('created_at')->get();
        return view('type_book.list',compact('data'));
    }
    public function create(Request $request){
            $request->validate([
                'name' => 'required|string'
            ]);
            $id =TypeBook::generateID();
            TypeBook::create([
                'type_book_id' => $id,
                'name' => $request->name
            ]);
            Alert::success('บันทึกสำเร็จ');

        return redirect()->back();
    }
    public function fetchData(Request $request){
        $id = $request->input('id');
        $data = TypeBook::find($id);
        return response()->json($data);
    }
    public function update(Request $request,$id){
        $data = TypeBook::find($id);
        $data->name = $request->name;
        $data->save();
        Alert::success('บันทึกสำเร็จ');
        return redirect()->back();
    }
}
