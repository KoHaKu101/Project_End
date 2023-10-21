<?php
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CopyBookController;
use App\Http\Controllers\EmpController;
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
Route::get('/media/list', [MediaController::class,'index'] )->name('media_list');
Route::get('/media/insert', [MediaController::class,'insert'] )->name('media_insert');

Route::get('/book/list', [BookController::class,'index'] )->name('book_list');
Route::get('/book/insert', [BookController::class,'insert'] )->name('book_insert');

Route::get('/emp/list', [EmpController::class,'index'] )->name('emp_list');
Route::get('/emp/insert', [EmpController::class,'insert'] )->name('emp_insert');

Route::get('/book/type/list', [TypeBookController::class,'index'] )->name('book_type_list');
Route::get('/book/copy/list', [CopyBookController::class,'index'] )->name('book_copy_list');
Route::get('/media/type/list', [TypeMediaController::class,'index'] )->name('media_type_list');




