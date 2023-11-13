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
use App\Http\Controllers\AuthController;



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
Route::middleware('custom.auth')->prefix('pd')->group(function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard_pd');
    Route::get('emp/insert', [EmpController::class, 'insert'])->name('emp_insert')->middleware('auth');
    Route::post('emp/insert', [EmpController::class, 'insert'])->name('emp_insert.post');
    Route::get('media/list', [MediaController::class, 'index'])->name('media_list');
    Route::get('media/insert', [MediaController::class, 'insert'])->name('media_insert');
    Route::get('book/list', [BookController::class, 'index'])->name('book_list');
    Route::get('book/insert', [BookController::class, 'insert'])->name('book_insert');
    Route::get('emp/list', [EmpController::class, 'index'])->name('emp_list');
    Route::get('book/type/list', [TypeBookController::class, 'index'])->name('book_type_list');
    Route::get('book/copy/list', [CopyBookController::class, 'index'])->name('book_copy_list');
    Route::get('book/copy/out/list', [CopyBookOutController::class, 'index'])->name('book_copy_out_list');
    Route::get('media/type/list', [TypeMediaController::class, 'index'])->name('media_type_list');
    Route::get('report', [ReportController::class, 'index'])->name('report_pd');
    Route::fallback(function () {
        return view('login');
    });
});

    


//Services Page หน้าต่างฝ่ายบริการ

// Route::get('ser/dashboard', [HomeController::class,'index'] )->name('dashboard_ser');
// Route::get('ser/receive/list', [ReceiveController::class,'index'] )->name('receive_list');
// Route::get('ser/requestMedia/list', [RequestMediaController::class,'index'] )->name('requestMedia_list');
// Route::get('ser/media/out/list', [MediaOutController::class,'index'] )->name('mediaOut_list');
// Route::get('ser/order/list', [OrderController::class,'index'] )->name('order_list');
// Route::get('ser/requestUser/list', [RequestUserController::class,'index'] )->name('requestUser_list');
// Route::get('ser/report/list', [ReportController::class,'index'] )->name('report_ser');
