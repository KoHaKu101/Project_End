<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CopyBookController;
use App\Http\Controllers\CopyBookOutController;
use App\Http\Controllers\EmpController;
use App\Http\Controllers\MediaOutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReceiveBookController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RequestMediaController;
use App\Http\Controllers\RequestUserController;
use App\Http\Controllers\TypeBookController;
use App\Http\Controllers\TypeMediaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SettingPageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [HomeController::class, 'index']);
Route::get('login', [AuthController::class, 'loginForm'])->name('login');
Route::post('loginprocess', [AuthController::class, 'loginprocess'])->name('login.post');


//Production Page หน้าต่างฝ่ายผลิต
Route::middleware(['custom.auth','check.status:1'])->prefix('pd')->group(function () {
    
    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard_pd');
    //เจ้าหน้าที่
    Route::get('emp/list', [EmpController::class, 'index'])->name('emp_list');
    Route::post('emp/create', [EmpController::class, 'create'])->name('emp.create');
    Route::get('emp/fetchData', [EmpController::class, 'fetchData'])->name('emp.fetchData');
    Route::post('emp/update/{id}', [EmpController::class, 'update'])->name('emp.update');
    //สื่อ
    Route::get('media/list', [MediaController::class, 'index'])->name('media_list');
    Route::post('media/create', [MediaController::class, 'create'])->name('media.create');
    Route::get('media/fetchData', [MediaController::class, 'fetchData'])->name('media.fetchData');
    Route::post('media/update/{id}', [MediaController::class, 'update'])->name('media.update');
    Route::get('media/fetchData/Book', [MediaController::class, 'fetchDataBook'])->name('media.fetchData.book');
    Route::get('media/fetchData/BookType', [MediaController::class, 'fetchDataBookType'])->name('media.fetchData.bookType');
    Route::get('media/fetchData/number', [MediaController::class, 'fetchDataNumber'])->name('media.fetchData.number');
    //หนังสือ
    Route::get('book/list', [BookController::class, 'index'])->name('book_list');
    Route::post('book/create', [BookController::class, 'create'])->name('book.create');
    Route::get('book/fetchData', [BookController::class, 'fetchData'])->name('book.fetchData');
    Route::post('book/update/{id}', [BookController::class, 'update'])->name('book.update');
    //ประเภทสื่อ
    Route::get('media/type/list', [TypeMediaController::class, 'index'])->name('media_type_list');
    Route::post('media/type/list/create', [TypeMediaController::class, 'create'])->name('media_type.create');
    Route::get('media/type/list/fetchData', [TypeMediaController::class, 'fetchData'])->name('media_type.fetchData');
    Route::post('media/type/list/update/{id}', [TypeMediaController::class, 'update'])->name('media_type.update');
    //หมวดหมู่หนังสือ
    Route::get('book/type/list', [TypeBookController::class, 'index'])->name('book_type_list');
    Route::get('book/type/list/fetchData', [TypeBookController::class, 'fetchData'])->name('book_type.fetchData');
    Route::post('book/type/list/create', [TypeBookController::class, 'create'])->name('book_type.create');
    Route::post('book/type/list/update/{id}', [TypeBookController::class, 'update'])->name('book_type.update');
    //สำเนาหนังสือ
    Route::get('book/copy/list', [CopyBookController::class, 'index'])->name('book_copy_list');
    Route::post('book/copy/update/{id}/{math}', [CopyBookController::class, 'update'])->name('book_copy.update');
    //จ่ายสำเนาหนังสือ
    Route::get('book/copy/out/list', [CopyBookOutController::class, 'index'])->name('book_copy_out.list');
    Route::post('book/copy/out/create', [CopyBookOutController::class, 'create'])->name('book_copy_out.create');
    Route::get('book/copy/out/fetchData', [CopyBookOutController::class, 'fetchData'])->name('book_copy_out.fetchData');
    Route::post('book/copy/out/update/{id}', [CopyBookOutController::class, 'update'])->name('book_copy_out.update');
    //ตั้งค่าต่างๆ
    Route::get('setting/list', [SettingPageController::class, 'index'])->name('setting.list');
    Route::post('setting/uploadImg', [SettingPageController::class, 'uploadImg'])->name('setting.uploadImg');


    Route::get('report', [ReportController::class, 'index'])->name('report_pd');
    Route::fallback(function () {
        return view('login');
    });
    
});
//Services Page หน้าต่างฝ่ายบริการ
Route::middleware(['custom.auth','check.status:2'])->prefix('ser')->group(function () {
Route::get('dashboard', [HomeController::class,'index'] )->name('dashboard_ser');
//รับหนังสือ
Route::get('receive/list', [ReceiveBookController::class,'index'] )->name('receive.list');
Route::post('receive/create', [ReceiveBookController::class,'create'] )->name('receive.create');
Route::get('receive/fetchData', [ReceiveBookController::class,'fetchData'] )->name('receive.fetchData');
Route::get('receive/delete/{id}', [ReceiveBookController::class,'delete'] )->name('receive.delete');

Route::get('media/fetchData/Book', [MediaController::class, 'fetchDataBook'])->name('media.fetchData.book');



Route::get('requestMedia/list', [RequestMediaController::class,'index'] )->name('requestMedia_list');
Route::get('media/out/list', [MediaOutController::class,'index'] )->name('mediaOut_list');
Route::get('order/list', [OrderController::class,'index'] )->name('order_list');
Route::get('requestUser/list', [RequestUserController::class,'index'] )->name('requestUser_list');
Route::get('report/list', [ReportController::class,'index'] )->name('report_ser');
});


