<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
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
    return view('admin.pages.auth.login');
})->name('login');

Route::post('/', [AuthController::class, 'login'])->name('admin.login');

Route::prefix('/admin')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
        Route::get('/profile', [AuthController::class, 'profile'])->name('admin.profile');
        Route::get('/edit-profile', [AuthController::class, 'editProfile'])->name('admin.edit-profile');
        Route::put('/update-profile/{id}', [AuthController::class, 'updateProfile'])->name('admin.update-profile');
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::prefix('/users')->group(function () {
            Route::get('/create', [UserController::class, 'create'])->name('admin.users.create')->middleware('permission:admin');
            Route::get('/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit')->middleware('permission:admin');
            Route::post('/', [UserController::class, 'store'])->name('admin.users.store')->middleware('permission:admin');
            Route::post('/import-file', [UserController::class, 'importFile'])->name('admin.users.import-file')->middleware('permission:admin');
            Route::get('/export-file', [UserController::class, 'exportFile'])->name('admin.users.export-file')->middleware('permission:admin');
            Route::get('/download-file', [UserController::class, 'downloadFile'])->name('admin.users.download-file')->middleware('permission:admin');
            Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
            Route::put('/{id}', [UserController::class, 'update'])->name('admin.users.update')->middleware('permission:admin');
            Route::delete('/{id}', [UserController::class, 'destroy'])->name('admin.users.delete')->middleware('permission:admin');
        });
    });
});
