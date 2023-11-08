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
use App\Http\Controllers\ReceiveController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RequestMediaController;
use App\Http\Controllers\RequestUserController;
use App\Http\Controllers\TypeBookController;
use App\Http\Controllers\TypeMediaController;


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
Route::get('/', [HomeController::class,'index'] );

//Production Page หน้าต่างฝ่ายผลิต
Route::get('pd/dashboard', [HomeController::class,'index'] )->name('dashboard_pd');

Route::get('pd/media/list', [MediaController::class,'index'] )->name('media_list');
Route::get('pd/media/insert', [MediaController::class,'insert'] )->name('media_insert');

Route::get('pd/book/list', [BookController::class,'index'] )->name('book_list');
Route::get('pd/book/insert', [BookController::class,'insert'] )->name('book_insert');

Route::get('pd/emp/list', [EmpController::class,'index'] )->name('emp_list');
Route::get('pd/emp/insert', [EmpController::class,'insert'] )->name('emp_insert');

Route::get('pd/book/type/list', [TypeBookController::class,'index'] )->name('book_type_list');
Route::get('pd/book/copy/list', [CopyBookController::class,'index'] )->name('book_copy_list');
Route::get('pd/book/copy/out/list', [CopyBookOutController::class,'index'] )->name('book_copy_out_list');
Route::get('pd/media/type/list', [TypeMediaController::class,'index'] )->name('media_type_list');

Route::get('pd/report', [ReportController::class,'index'] )->name('report_pd');

//Services Page หน้าต่างฝ่ายบริการ

Route::get('ser/dashboard', [HomeController::class,'index'] )->name('dashboard_ser');
Route::get('ser/receive/list', [ReceiveController::class,'index'] )->name('receive_list');
Route::get('ser/requestMedia/list', [RequestMediaController::class,'index'] )->name('requestMedia_list');
Route::get('ser/media/out/list', [MediaOutController::class,'index'] )->name('mediaOut_list');
Route::get('ser/order/list', [OrderController::class,'index'] )->name('order_list');
Route::get('ser/requestUser/list', [RequestUserController::class,'index'] )->name('requestUser_list');
Route::get('ser/report/list', [ReportController::class,'index'] )->name('report_ser');










