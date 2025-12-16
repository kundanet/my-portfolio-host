<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\ProjectController;

/*
|--------------------------------------------------------------------------
| Public Frontend Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [FrontController::class, 'home'])->name('home');
Route::get('/about', [FrontController::class, 'about'])->name('about');
Route::get('/skills', [FrontController::class, 'skills'])->name('skills');
Route::get('/projects', [FrontController::class, 'projects'])->name('projects');
Route::get('/contact', [FrontController::class, 'contact'])->name('contact');

// Contact form submit
Route::post('/contact', [MessageController::class, 'send'])
    ->name('contact.send');

/*
|--------------------------------------------------------------------------
| Admin Routes (Protected)
|--------------------------------------------------------------------------
| URL prefix  : /admin/...
| Route names : admin.*
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // ================= DASHBOARD =================
        Route::get('/', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // 🔴 REQUIRED for Dashboard v6 / v7 (live stats)
        Route::get('/dashboard/stats', [AdminDashboardController::class, 'stats'])
            ->name('dashboard.stats');

        // ================= SKILLS =================
        Route::resource('skills', SkillController::class);

        // ================= PROJECTS =================
        Route::resource('projects', ProjectController::class);

        // ================= MESSAGES =================
        Route::get('/messages', [MessageController::class, 'index'])
            ->name('messages.index');

        Route::get('/messages/{id}', [MessageController::class, 'show'])
            ->name('messages.show');

        Route::delete('/messages/{id}', [MessageController::class, 'destroy'])
            ->name('messages.destroy');
    });

/*
|--------------------------------------------------------------------------
| User Profile (Protected)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Auth Routes (Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
