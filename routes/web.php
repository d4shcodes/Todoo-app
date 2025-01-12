<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;
use App\Models\Todo;
use App\Models\User;


//Group routes with common prefixes and middleware
Route::middleware('alreadyLoggedIn')->group(function () {
    Route::get('/', function () {
        return view('welcome', [
            'todo_task' => Todo::all(),
            'user' => User::all()
        ]);
    })->name('welcome');

    Route::get('welcome', function () {
        return view('welcome', [
            'todo_task' => Todo::all(),
            'user' => User::all()
        ]);
    })->name('welcome');
});

// Authenticated user routes
Route::middleware('isLoggedIn')->group(function () {
    Route::get('dashboard', [TodoController::class, 'dashboard'])->name('dashboard');
    Route::post('logout', [TodoController::class, 'logout'])->name('logout');
});

// Task-related routes
Route::controller(TodoController::class)->group(function () {
    Route::post('add_task', 'add_task')->name('add_task');
    Route::put('update_task/{id}/{type}', 'update_task')->name('update_task');
    Route::delete('delete_task/{id}', 'delete_task')->name('delete_task');
    // User authentication
    Route::post('user_auth', 'user_auth')->name('user_auth');
});

