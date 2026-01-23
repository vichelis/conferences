<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/conferences', [ConferenceController::class, 'index'])->name('conferences.index');
Route::get('/conferences/{id}', [ConferenceController::class, 'show'])->name('conferences.show');
Route::post('/conferences/{id}/register', [ConferenceController::class, 'register'])->name('conferences.register');

//employee routes
Route::prefix('employee')->name('employee.')->group(function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('dashboard');
    Route::get('/conferences', [EmployeeController::class, 'conferences'])->name('conferences');
    Route::get('/conferences/{id}', [EmployeeController::class, 'showConference'])->name('conferences.show');
    Route::get('/conferences/{id}/registrations', [EmployeeController::class, 'registrations'])->name('conferences.registrations');
});

//Admin routes
Route::prefix('admin')->name('admin.')->group(function () {

});

//konferencijos(klientai tik ziureti ir registruotis)
Route::get('/conferences', [ConferenceController::class, 'index'])->name('conferences.index');
Route::get('/conferences/{id}', [ConferenceController::class, 'show'])->name('conferences.show');
Route::post('/conferences/{id}/register', [ConferenceController::class, 'register'])->name('conferences.register');

//admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/conferences', [AdminController::class, 'conferences'])->name('admin.conferences');
Route::get('/admin/conferences/create', [AdminController::class, 'createConference'])->name('admin.conferences.create');
Route::post('/admin/conferences', [AdminController::class, 'storeConference'])->name('admin.conferences.store');
Route::get('/admin/conferences/{id}/edit', [AdminController::class, 'editConference'])->name('admin.conferences.edit');
Route::put('/admin/conferences/{id}', [AdminController::class, 'updateConference'])->name('admin.conferences.update');
Route::delete('/admin/conferences/{id}', [AdminController::class, 'destroyConference'])->name('admin.conferences.destroy');
Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
    Route::get('/profile', [RegisterController::class, 'profile'])->name('profile');
    Route::put('/profile', [RegisterController::class, 'updateProfile'])->name('profile.update');
});
