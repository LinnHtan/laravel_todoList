<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;




Route::get('/',[PostController::class,'create'])->name('post#home');

Route::get('create/postPage',[PostController::class,'create'])->name('create#postPage');
Route::post('create/post',[PostController::class,'createPost'])->name('create#post');

Route::get('delete/post/{id}',[PostController::class,'deletePost'])->name('delete#post');

Route::get('update/postPage/{id}',[PostController::class,'updatePostPage'])->name('update#postPage');

Route::get('edit/post/{id}',[PostController::class,'editPost'])->name('edit#post');

Route::post('update/post',[PostController::class,'updatePost'])->name('update#post');














