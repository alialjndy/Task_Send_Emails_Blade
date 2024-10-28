<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('registerMe',function(){
    return view('register');
})->name('registerMe');

Route::post('register',[AuthController::class,'register'])->name('validate_register');

Route::get('login',function(){
    return view('login');
})->name('login');

Route::post('login',[AuthController::class,'login'])->name('validate_login');


Route::get('home',function(){
    return view('home');
})->name('home');

Route::middleware('auth')->group(function(){

    Route::resource('tasks',TaskController::class);
    Route::get('logout',[AuthController::class,'logout'])->name('logout');
});

