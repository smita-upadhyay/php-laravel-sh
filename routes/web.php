<?php

use App\Http\Controllers\BooksController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/books',[BooksController::class, 'index'])->name('book.view');
Route::get('/books/form',function(){
    return view('books');
});
Route::post('/books/create',[BooksController::class,'store'])->name('book.create');
Route::get('/books/delete/{id}',[BooksController::class,'delete'])->name('book.delete');
Route::get('books/update',[BooksController::class,'edit'])->name('book.edit');