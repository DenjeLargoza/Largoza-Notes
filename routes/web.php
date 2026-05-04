<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NoteController;
use App\Http\Controllers\AuthController;

// Registration routes
Route::get('/register', [AuthController::class, 'showRegForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Auth routes

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Notes routes (protected)
Route::middleware('auth')->group(function () {
	Route::get('/notes', [NoteController::class, 'index']); // Show notes index (form + list)
	Route::post('/notes/generate', [NoteController::class, 'generate']); // Handle AI generation
	Route::post('/notes', [NoteController::class, 'store']); // Save note
	Route::put('/notes/{note}', [NoteController::class, 'update']);
	Route::delete('/notes/{note}', [NoteController::class, 'destroy']);
	Route::get('/', [NoteController::class, 'index']); // Home redirects to notes index
});

Route::get('/dashboard', [NoteController::class, 'dashboard']) ->middleware('auth') ->name('dashboard');