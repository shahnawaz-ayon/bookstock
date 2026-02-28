<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

// This one line handles index, create, store, show, edit, update, destroy
Route::resource('books', BookController::class);

Route::get('/', function () {
    return view('welcome');
});

// Author Routes
Route::get('/authors/create', [BookController::class, 'createAuthor'])->name('authors.create');
Route::post('/authors', [BookController::class, 'storeAuthor'])->name('authors.store');

// Category Routes
Route::get('/categories/create', [BookController::class, 'createCategory'])->name('categories.create');
Route::post('/categories', [BookController::class, 'storeCategory'])->name('categories.store');


Route::get('/phpinfo', function () {
    phpinfo();
});

Route::get('/phpinfo-test', function () {
    phpinfo();
});