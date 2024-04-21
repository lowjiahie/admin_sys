<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminschoolController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('adminblade/adminlogin');
});
Route::get('/adminregisterpage',[adminschoolController::class,'adminregisterpage']);
Route::post('/registernewAdmin',[adminschoolController::class,'registernewAdmin'])->name('registernewAdmin');
Route::get('/adminmainpage',[adminschoolController::class,'adminmainpage']);
Route::get('/adminloginpage',[adminschoolController::class,'adminloginpage']);
Route::post('/adminloginfunction',[adminschoolController::class,'adminloginfunction'])->name('adminloginfunction');

Route::get('/productmanagement',[ProductController::class,'productmanagement'])->name('productmanagement');
Route::get('/addproductpage',[ProductController::class,'addproductpage']);
Route::post('/addproduct',[ProductController::class,'addproduct'])->name('addproduct');
Route::get('/getproduct/{allproduct}',[ProductController::class,'getproduct']);
Route::post('/updateproduct',[ProductController::class,'updateproduct'])->name('updateproduct');
Route::get('/deleteproduct/{allproduct}',[ProductController::class,'deleteproduct']);
