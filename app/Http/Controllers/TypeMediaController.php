<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeMedia;
class TypeMediaController extends Controller
{
    public function index()
    {
        $data = TypeMedia::orderby('created_at')->get();
        return view('type_media.list',compact('data'));
    }
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'desc'=>'required|string'
        ]);
        $id = TypeMedia::generateID();
        TypeMedia::create([
            'type_media_id' => $id,
            'name' => $request->name,
            'desc' => $request->desc

        ]);
        return redirect()->back();
    }
    public function fetchData(Request $request)
    {
        $id = $request->input('id');
        $data = TypeMedia::find($id);
        return response()->json($data);
    }
    public function update(Request $request, $id)
    {
        $data = TypeMedia::find($id);
        $data->name = $request->name;
        $data->desc = $request->desc;
        $data->save();
        return redirect()->back();
    }
}
