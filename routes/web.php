<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Only for people who are NOT logged in
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Only for people who ARE logged in
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Students
    Route::get('/students', [StudentController::class, 'index'])->middleware('permission:view students')->name('students.index');
    Route::get('/students/create', [StudentController::class, 'create'])->middleware('permission:create students')->name('students.create');
    Route::post('/students', [StudentController::class, 'store'])->middleware('permission:create students')->name('students.store');
    Route::get('/students/{student}', [StudentController::class, 'show'])->middleware('permission:view students')->name('students.show');
    Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->middleware('permission:edit students')->name('students.edit');
    Route::put('/students/{student}', [StudentController::class, 'update'])->middleware('permission:edit students')->name('students.update');
    Route::delete('/students/{student}', [StudentController::class, 'destroy'])->middleware('permission:delete students')->name('students.destroy');

    // Courses (students hold "view courses", lecturers hold "view assigned courses")
    Route::get('/courses', [CourseController::class, 'index'])->middleware('permission:view courses|view assigned courses')->name('courses.index');
    Route::get('/courses/create', [CourseController::class, 'create'])->middleware('permission:create courses')->name('courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->middleware('permission:create courses')->name('courses.store');
    Route::get('/courses/{course}', [CourseController::class, 'show'])->middleware('permission:view courses|view assigned courses')->name('courses.show');
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->middleware('permission:edit courses')->name('courses.edit');
    Route::put('/courses/{course}', [CourseController::class, 'update'])->middleware('permission:edit courses')->name('courses.update');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->middleware('permission:delete courses')->name('courses.destroy');

    // Registrations
    Route::get('/registrations', [RegistrationController::class, 'index'])->middleware('permission:view registrations|view own registrations')->name('registrations.index');
    Route::get('/registrations/create', [RegistrationController::class, 'create'])->middleware('permission:create registrations')->name('registrations.create');
    Route::post('/registrations', [RegistrationController::class, 'store'])->middleware('permission:create registrations')->name('registrations.store');
    Route::delete('/registrations/{registration}', [RegistrationController::class, 'destroy'])->middleware('permission:delete registrations')->name('registrations.destroy');
});