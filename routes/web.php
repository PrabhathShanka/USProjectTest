<?php

use App\Http\Controllers\Admin\AssignmentController;
use App\Http\Controllers\Admin\PromotionCodeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

Route::get('/', function () {
    return view('home');
});


// Route::get('/', function () {
//     return view('landingPage.index'); // no need for .blade.php
// });
// Dashboard
// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// })->name('admin.dashboard');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Routes Group
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    Route::prefix('/assignments')->middleware(['auth'])->name('assignments.')->group(function () {
        Route::get('/', [AssignmentController::class, 'index'])->name('index');
        Route::post('/store', [AssignmentController::class, 'store'])->name('store');
        Route::get('/show/{id}', [AssignmentController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [AssignmentController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [AssignmentController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [AssignmentController::class, 'destroy'])->name('destroy');
        Route::get('/filter', [AssignmentController::class, 'fetchAssignments'])->name('filter');
    });

    Route::prefix('/promotions-code')->middleware(['auth'])->name('promotions-code.')->group(function () {
        Route::get('/', [PromotionCodeController::class, 'index'])->name('index');
        Route::get('/fetchAllPromoCodes', [PromotionCodeController::class, 'fetchAllPromoCodes'])->name('fetchAllPromoCodes');
        Route::post('/store', [PromotionCodeController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PromotionCodeController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [PromotionCodeController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [PromotionCodeController::class, 'destroy'])->name('destroy');

        Route::get('/check', [PromotionCodeController::class, 'check'])->name('check');
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::get('/dashboard', function () {
    //     return view('admin.dashboard');
    // })->name('admin.dashboard');
});

require __DIR__ . '/auth.php';
