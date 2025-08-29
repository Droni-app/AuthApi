<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialAuthController;

Route::middleware(['auth'])->get('/', function () {
  return view('home');
});

// Rutas para autenticación social
Route::get('/auth/{provider}', [SocialAuthController::class, 'redirect'])->name('auth.provider');
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback'])->name('auth.provider.callback');
