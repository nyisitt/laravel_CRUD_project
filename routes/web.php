<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::redirect('/','create');
Route::get('create',[PostController::class,'create'])->name('create');
Route::post('post/create',[PostController::class,'dataInput'])->name('post#data');
// first delete
 Route::get('post/delete/{id}',[PostController::class,'postDelete'])->name('post#delete');
// second delete
Route::delete('post/delete/{id}',[PostController::class,'postDelete'])->name('post#delete');
// update section
Route::get('post/update/{id}',[PostController::class,'postUpdate'])->name('post#update');
Route::get("post/edit/{id}",[PostController::class,"postEdit"])->name('post#edit');
Route::post('post/update',[PostController::class,"postRealupdate"])->name('post#real');
