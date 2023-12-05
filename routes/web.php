<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(App\Http\Controllers\UserServiceController::class)->group(function(){
    Route::post('/register','doRegister');
    Route::post('/login','doLogin');
    Route::get('/register','register');
    Route::get('/login','login');
    Route::get('/logout','logout');
});

Route::controller(App\Http\Controllers\PeminjamanController::class)->group(function(){
    Route::get('/pinjam/{buku_id}', 'pinjam');
    Route::get('peminjaman/confirm/{buku_id}', 'confirmPeminjaman');//admin
});

Route::controller(App\Http\Controllers\BooksController::class)->group(function(){
    Route::post('/tambah', 'tambah');
    Route::get('/update/{buku_id}', 'viewUpdate');
    Route::post('/update/{buku_id}', 'update');
    Route::get('/hapus/{buku_id}', 'hapus');
});

Route::controller(App\Http\Controllers\PageController::class)->group(function(){
    Route::get('/', 'home');
    Route::get('/', 'home')->name('home');
    Route::get('/peminjaman', 'viewPeminjaman')->name('peminjaman');
    Route::get('/peminjaman/user', 'viewPeminjamanUser');
    Route::get('/peminjaman/admin', 'viewPeminjamanAdmin');
});
