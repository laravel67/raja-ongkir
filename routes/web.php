<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/api/province/{id}/cities', [HomeController::class, 'getCities'])->name('getCities');
Route::post('/api/cities', [HomeController::class, 'getSearchCities'])->name('getSearchCities');
Route::post('/store', [HomeController::class, 'store'])->name('store');