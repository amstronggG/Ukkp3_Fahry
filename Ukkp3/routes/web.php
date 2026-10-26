<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PengaduanController as AdminPengaduanController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Pengaduan User
    Route::resource('pengaduan', PengaduanController::class)->except(['show', 'edit', 'update']);
});

// ===== ADMIN AREA =====
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Kelola User
        Route::resource('users', UserController::class)->except(['show']);

        // Kelola Pengaduan (Admin)
        Route::get('pengaduan', [AdminPengaduanController::class, 'index'])->name('pengaduan.index');
        Route::patch('pengaduan/{pengaduan}/respon', [AdminPengaduanController::class, 'respon'])->name('pengaduan.respon');
        Route::delete('pengaduan/{pengaduan}', [AdminPengaduanController::class, 'destroy'])->name('pengaduan.destroy');
    });

require __DIR__.'/auth.php';