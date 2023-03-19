<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
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

Route::middleware('auth')->group(function () {

    Route::get('/', [ProjectController::class, 'index'])->name('project.index');

    Route::get('/project', [ProjectController::class, 'index'])->name('project.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/project', [ProjectController::class, 'index'])->name('project.index');
    Route::get('/project/create', [ProjectController::class, 'create'])->name('project.create');
    Route::post('/projects/store', [ProjectController::class, 'store'])->name('project.store');
    Route::get('/projects/edit/{id}', [ProjectController::class, 'edit'])->name('project.edit') ;
    Route::patch('/projects/update/{id}', [ProjectController::class, 'update'])->name('project.update') ;
    Route::delete('/project/delete/{id}', [ProjectController::class, 'destroy'])->name('project.destroy');
    Route::get('/project/filter', [ProjectController::class, 'filter'])->name('project.filter');

    Route::get('/task', [TaskController::class, 'index'])->name('task.index');
    Route::get('/task/create', [TaskController::class, 'create'])->name('task.create');
    Route::post('/task/store', [TaskController::class, 'store'])->name('task.store');
    Route::get('/task/edit/{id}', [TaskController::class, 'edit'])->name('task.edit') ;
    Route::patch('/task/update/{id}', [TaskController::class, 'update'])->name('task.update') ;
    Route::delete('/task/delete/{id}', [TaskController::class, 'destroy'])->name('task.destroy');
    Route::get('/task/filter', [TaskController::class, 'filter'])->name('task.filter');

});


require __DIR__.'/auth.php';
