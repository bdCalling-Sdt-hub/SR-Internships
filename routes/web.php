<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\ChatController;
use App\Http\Controllers\Backend\DashboardController;


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::group(["prefix"=> "/admin"], function () {

    Route::get('login',[AuthController::class,'login'])->name('admin.login');
    Route::post('authenticate',[AuthController::class,'authenticate'])->name('admin.authenticate');
    Route::get('logout',[AuthController::class,'logout'])->name('admin.logout');
    Route::get('dashboard',[DashboardController::class,'dashobard'])->name('dashboard');


    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/messages/send', [ChatController::class, 'sendMessage'])->name('messages.send');
    Route::get('/messages/user/{id}', [ChatController::class, 'sendMessageUser'])->name('messages.send.user');




// });


