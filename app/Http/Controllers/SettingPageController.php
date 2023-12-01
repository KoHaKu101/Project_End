<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
class SettingPageController extends Controller
{
    //
    public function index(){
       return view('settingPage.list');
    }
    public function uploadImg(Request $request){
        $validator = Validator::make($request->all(),[
            'ImgLogo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the file types and size as needed
        ]);
        if ($validator->fails()) {
            Alert::error('Error', 'ไม่พบไฟล์ที่อัพโหลด หรือไฟล์ไม่ถูกต้อง');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->hasFile('ImgLogo')) {
            $file = $request->file('ImgLogo');
            $newFileName = 'LogoImg.' . $file->getClientOriginalExtension();
            $path = public_path('assets/images/logo');
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            }
            $file->move($path, $newFileName);
            Alert::success('อัพโหลดสำเร็จ');
            return redirect()->back();
        }
        
    }
}
