<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NoteController;
use App\Http\Controllers\AuthController;

// Registration routes
Route::get('/register', [AuthController::class, 'showRegForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Notes routes (protected)
Route::middleware('auth')->group(function () {
	Route::get('/', [NoteController::class, 'index']);
	Route::post('/notes', [NoteController::class, 'store']);
	Route::put('/notes/{note}', [NoteController::class, 'update']);
	Route::delete('/notes/{note}', [NoteController::class, 'destroy']);
});

Route::get('/dashboard', [NoteController::class, 'dashboard']) ->middleware('auth') ->name('dashboard');