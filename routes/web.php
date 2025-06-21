<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ZooController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::post('/cage', [ZooController::class, 'store'])->name('zoo.store');
    Route::get('/cage/create', [ZooController::class, 'create'])->name('zoo.create');

    Route::post('/animals', [AnimalController::class, 'store'])->name('animals.store');
    Route::get('/animals/create', [AnimalController::class, 'create'])->name('animals.create');

    Route::get('/animals/{id}/edit', [AnimalController::class, 'edit'])->name('animals.edit');
    Route::get('/cage/{id}/edit', [ZooController::class, 'edit'])->name('zoo.edit');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/animals', [AnimalController::class, 'index'])->name('animals.index');
Route::get('/animals/{id}', [AnimalController::class, 'show'])->name('animals.show');
Route::put('/animals/{id}', [AnimalController::class, 'update'])->name('animals.update');

Route::get('/', [ZooController::class, 'index'])->name('zoo.index');
Route::get('/cage/{id}', [ZooController::class, 'show'])->name('zoo.show');
Route::put('/cage/{id}', [ZooController::class, 'update'])->name('zoo.update');

require __DIR__.'/auth.php';
