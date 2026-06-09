<?php

use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

// landing page
Route::get('/', function () {
    return view('welcome');
});

// login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// layout
Route::get('/layout', function() {
    return view('layout');
})->middleware('auth')->name('layout');

// dashboard
Route::get('/dashboard', [ReservasiController::class, 'index'])->name('dashboard');

// reservasi
Route::get('/reservasi/create', [ReservasiController::class, 'create'])->name('reservasi.create');
Route::post('/reservasi/store', [ReservasiController::class, 'store'])
    ->name('reservasi.store')
    ->middleware('auth');

// Riwayat Reservasi
Route::get('/reservasi/riwayat', [ReservasiController::class, 'riwayat'])->name('reservasi.riwayat');

// Batalkan reservasi
Route::delete('/reservasi/{id}/batal', [ReservasiController::class, 'batal'])->name('reservasi.batal');


// logout
Route::get('/logout', function(){
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

Route::get('/cek-jam', function() {
    return Carbon::now(); 
});

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

Route::post('/admin/reservasi/{id}/update', [AdminController::class, 'updateStatus'])->name('admin.reservasi.update');

Route::patch('/reservasi/{id}/approve', [AdminController::class, 'approve'])->name('reservasi.approve');
Route::patch('/reservasi/{id}/reject', [AdminController::class, 'reject'])->name('reservasi.reject');

Route::resource('rooms', RoomController::class)->middleware('auth');

// require __DIR__.'/auth.php';
