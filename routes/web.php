<?php

use App\Http\Livewire\Success;
use App\Http\Livewire\Welcome;
use App\Mail\RespondMail;
use App\Models\Message;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

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

Route::get('/', Welcome::class);
Route::get('/success', Success::class)->name('success');

Route::get('test', function(){

    Mail::to('isnunas@gmail.com')->send(new RespondMail(Message::first()));

});
Route::get('mail', function(){

    return view('mail.answer');

});