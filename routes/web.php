<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('/index',[HomeController::class,"index"]);
Route::get('/redirects',[HomeController::class,"redirects"]);
Route::post('/addcart/{id}',[HomeController::class,"addCard"]);
Route::get('/showcard/{id}',[HomeController::class,"showCard"]);
Route::get('/remove/{id}',[HomeController::class,"remove"]);
Route::post('/orderconfirm',[HomeController::class,"orderConfirm"]);







//user
Route::get('/users',[AdminController::class,"userList"]);
Route::post('/deleteuser',[AdminController::class,"deleteUser"]);

//food
Route::get('/foodmenu',[AdminController::class,"foodMenu"]);
Route::post('/foodupload',[AdminController::class,"foodUpload"]);
Route::post('/updatefood',[AdminController::class,"updateFood"]);
Route::post('/deletefoodmenu',[AdminController::class,"deleteFoodMenu"]);

//Reservation 
Route::post('/reservation',[AdminController::class,"reservation"]);
Route::get('/reservationlist',[AdminController::class,"reservationList"]);

//chefs
Route::get('/chefs',[AdminController::class,"chefs"]);
Route::post('/uploadchefs',[AdminController::class,"uploadChefs"]);
Route::post('/updatechefs',[AdminController::class,"updateChefs"]);
Route::post('/deletechefs',[AdminController::class,"deleteChefs"]);

//order List
Route::get('/orders',[AdminController::class,"order"]);
Route::get('/search',[AdminController::class,"search"]);





Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
