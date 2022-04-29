<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// Route::get('/', 'HomeController@index')->name('home');
Route::get('/', 'Admin\Auth\LoginController@login')->name('login');
Route::get('authentication-failed', function () {
    $errors = [];
    array_push($errors, ['code' => 'auth-001', 'message' => 'Unauthenticated.']);
    return response()->json([
        'errors' => $errors,
    ], 401);
})->name('authentication-failed');

