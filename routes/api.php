<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('posts','PostController@index');
Route::get('posts/show/{post}','PostController@show');
Route::get('posts/delete/{post}','PostController@destroy');
Route::post('posts/update/{post}','PostController@update');
Route::post('posts/store','PostController@store');
