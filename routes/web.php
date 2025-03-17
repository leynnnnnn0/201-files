<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {
    Route::redirect('/', '/dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::controller(ProfileController::class)
        ->name('profiles.')
        ->prefix('profiles')
        ->group(function () {
            Route::put('/update-information/{user}', 'updateInformation')->name('update-information');

            Route::put('/update-password/{user}', 'updatePassword')->name('update-password');
        });

    Route::name('archives.')->prefix('archives')->group(function () {
        // Route::controller(UserController::class)->group(function () {
        //     Route::get('/users', 'archive')->name('users');
        //     Route::post('/users/restore/{user}', 'restore')->name('users-restore');
        // });

        Route::controller(EmployeeController::class)->group(function () {
            Route::get('/employees', 'archive')->name('employees');
            Route::post('/employees/restore/{employee}', 'restore')->name('employees-restore');
        });

        Route::controller(DocumentController::class)->group(function () {
            Route::get('/documents', 'archive')->name('documents');
            Route::post('/documents/restore/{employee}', 'restore')->name('documents-restore');
            Route::delete('/documents/force-delete/{id}', 'forceDelete')->name('documents-delete');
        });
    });



    // Route::resource('users', UserController::class);
    Route::resource('profiles', ProfileController::class);
    Route::resource('designations', DesignationController::class);
    Route::resource('positions', PositionController::class);

    Route::post('employees/update/{employee}', [EmployeeController::class, 'update'])->name('update');
    Route::resource('employees', EmployeeController::class);
    Route::resource('documents', DocumentController::class);

    Route::post('/documents/store-documents', [DocumentController::class, 'storeDocuments'])->name('documents.store-documents');

    Route::post('/documents/upload-documents', [DocumentController::class, 'uploadDocument'])->name('documents.upload-documents');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
