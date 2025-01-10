<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Livewire\HomePage;
use App\Livewire\Notifications;
use App\Livewire\ShowPost;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');
Route::put('/edit-profile', [UserController::class, 'updateProfile']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/@{username}', [UserController::class, 'profile'])->name('profile');
Route::get('/@{username}/question/{id}', ShowPost::class)->name('post.show');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/edit-profile', [UserController::class, 'showEditProfileForm'])->name('edit-profile');
    Route::put('/@{username}/question/{id}', [PostController::class, 'update'])->name('post.update');
    Route::get('/@{username}/question/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::post('/', [PostController::class, 'store'])->name('posts.store');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/notifications', Notifications::class)->name('notifications');

    Route::group(['middleware' => 'is_admin'], function () {
        Route::delete('/question/{id}', [PostController::class, 'destroy'])->name('post.destroy');
    });
});