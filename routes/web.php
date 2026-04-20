<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\PrestamoController; 

Route::resource('libros', LibroController::class)->middleware('auth');

//  PRESTAMOS
    Route::middleware('auth')->group(function () {
    Route::get('/prestamos/nuevo', [PrestamoController::class, 'create'])->name('prestamos.create');
    Route::post('/prestamos', [PrestamoController::class, 'store'])->name('prestamos.store');
    Route::post('/prestamos/{id}/devolver', [PrestamoController::class, 'devolver'])->name('prestamos.devolver');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/prestamos/{id}/devolver', [App\Http\Controllers\PrestamoController::class, 'devolver'])->name('prestamos.devolver');
});

// Ruta para formulario
Route::get('/login', function () {
    return view('login');
})->name('login');

// Ruta para los datos
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Ruta del dashboard
Route::get('/dashboard', function () {
    return redirect()->route('libros.index');
})->middleware('auth');

Route::get('/', function () {
    return redirect()->route('libros.index');
})->middleware('auth');