<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChatController;

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


Route::get('/',[HomeController::class,'index']);

Route::get('/home',[HomeController::class,'redirect'])->middleware('auth','verified');

//appointment
Route::post('/appointment',[HomeController::class,'appointment']);

// Route::get('/home',[AdminController::class,'total_doctors']);


//my appointment
Route::get('/my_appointment',[HomeController::class,'myappointment']);

//about
Route::get('/about',[HomeController::class,'about']);
Route::get('/doctor_info',[HomeController::class,'doctor_info']);
Route::get('/contact',[HomeController::class,'contact']);
Route::post('/contact_us',[HomeController::class,'contact_us']);



//cancel appointment
Route::get('/cancel_appointment/{id}',[HomeController::class,'cancelappointment']);


//doctor panel
Route::get('/doctor_appointment',[AdminController::class,'doctor_appointment']);
Route::get('/doctor_chats',[AdminController::class,'doctor_chats']);
Route::get('/doctor_show_chat/{id}',[AdminController::class,'doctor_show_chat']);
Route::get('/complete_profile',[AdminController::class,'complete_profile']);
Route::post('/complete_doctors_profile',[AdminController::class,'complete_doctors_profile']);

Route::get('/chat_with_doctor/{id}',[AdminController::class,'chat_with_doctor']);

Route::post('/search',[AdminController::class,'search'])->name('search');


Route::get('/contact_messages',[AdminController::class,'contact'])->name('contact_messages');

//doctor panel


//show_appointment
Route::get('/show_appointment',[AdminController::class,'show_appointment']);


//show_doctor
Route::get('/show_doctor',[AdminController::class,'show_doctor']);
Route::get('/update/{id}',[AdminController::class,'update_doctor']);
Route::get('/delete/{id}',[AdminController::class,'delete_doctor']);

//email
Route::get('/email_view/{id}',[AdminController::class,'email_view']);


//email
Route::post('/sendemail/{id}',[AdminController::class,'sendemail']);

Route::get('/approved/{id}',[AdminController::class,'approved']);

Route::get('/cancelled/{id}',[AdminController::class,'cancelled']);

Route::get('/add_doctor',[AdminController::class,'addview']);
Route::post('/upload_doctor',[AdminController::class,'upload_doctor']);
Route::post('/edit_doctor/{id}',[AdminController::class,'edit_doctor']);

//chat
Route::get('/chats',[ChatController::class,'index']);
Route::get('/show_chat/{id}',[ChatController::class,'show_chat']);
Route::post('/send_message',[ChatController::class,'send_message']);

// Route::get('/patient_chat',[ChatController::class,'patient_chat']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

