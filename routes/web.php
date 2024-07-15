<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\RegistrantController;
use App\Http\Controllers\Default\FileController;
use App\Http\Controllers\Default\GeneralController;
use App\Http\Controllers\Default\ProfileController;
use App\Http\Controllers\Default\RoleController;
use App\Http\Controllers\Default\SettingController;
use App\Http\Controllers\Default\UserController;
use App\Http\Controllers\UploadRegistrantController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('pages.persyaratan');
});

Route::get('files/{file}', [FileController::class, 'show'])->name('file.show');
Route::get('pages/persyaratan', [PageController::class, 'persyaratan'])->name('pages.persyaratan');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [GeneralController::class, 'index'])->name('dashboard');
    Route::get('/maintance', [GeneralController::class, 'maintance'])->name('maintance');

    // User
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::post('/users', [UserController::class, 'store'])->name('user.store');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('user.destroy');

    // Role
    Route::resource('/roles', RoleController::class);

    // Setting
    Route::get('/settings', [SettingController::class, 'index'])->name('setting.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('setting.update');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // #Admin
    Route::post('pages', [PageController::class, 'update'])->name('pages.update');
    Route::get('pages', [PageController::class, 'index'])->name('pages.index');

    Route::delete('upload-daftar-diterima/{id}', [UploadRegistrantController::class, 'destroy'])->name('upload-daftar-diterima.destroy');
    Route::get('upload-daftar-diterima', [UploadRegistrantController::class, 'index'])->name('upload-daftar-diterima');

    Route::get('daftar-diterima', [RegistrantController::class, 'index'])->name('daftar-diterima');
    Route::get('registrants/export', [RegistrantController::class, 'export'])->name('registrants.export');
    Route::resource('registrants', RegistrantController::class);
});

// #Guest
