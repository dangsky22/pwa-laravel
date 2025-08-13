<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/offline', function () {
    return view('offline');
})->name('offline');
