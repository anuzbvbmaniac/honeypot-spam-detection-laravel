<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/comment/create', function () {
    return view('comment.create');
})->middleware(['auth'])->name('comment.create');

Route::post('/comment/store', function (Request $request) {




})->middleware(['auth'])->name('comment.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
