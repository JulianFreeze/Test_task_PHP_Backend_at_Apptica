<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\MainController@index');
Route::get('/refresh', 'App\Http\Controllers\MainController@refresh');