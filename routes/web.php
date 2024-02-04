<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SubTaskController;



Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/task/create', [TaskController::class, 'create'])->name('task.create');
Route::get('/task/{task}/edit', [TaskController::class, 'edit'])->name('task.edit');
Route::patch('/task/{task}', [TaskController::class, 'update'])->name('task.update');
Route::delete('/task/{task}', [TaskController::class, 'delete'])->name('task.delete');
Route::get('/task/{task}', [TaskController::class, 'view'])->name('task.view');
Route::post('/task/create', [TaskController::class, 'store'])->name('task.store');
Route::post('/task/search', [TaskController::class, 'search'])->name('task.search');

Route::get('/subtask/{task}/create', [SubTaskController::class, 'create'])->name('subtask.create');
Route::post('/subtask/create', [SubTaskController::class, 'store'])->name('subtask.store');
Route::delete('/subtask/{task}', [SubTaskController::class, 'delete'])->name('subtask.delete');
