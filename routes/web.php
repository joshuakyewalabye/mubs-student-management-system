<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('students', StudentController::class); //this one line creates 7 routes of the student controller class
Route::resource('courses', CourseController::class);

Route::resource('registrations', RegistrationController::class);



// Only for people who are NOT logged in
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Logging out requires being logged in
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');