<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function (Request $request) {
    $masa = $request->query('masa');
    if ($masa) {
        cookie()->queue(cookie('masa_qr_' . md5($masa), now()->timestamp, 60 * 24));
    }
    return view('index');
});

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/mutfak', function () {
    return view('mutfak');
});

Route::get('/mikale-giris-x7k92', function () {
    return view('mikale');
});