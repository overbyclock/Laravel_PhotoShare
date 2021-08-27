<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});

/*Auth route */
Auth::routes();

/* Home controller */
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* User controller */
Route::get('/settings', [UserController::class, 'settings'])->name('settings');
Route::post('/user/edit', [UserController::class, 'update'])->name('update');
Route::get('/user/profile/{id}', [UserController::class, 'profile'])->name('profile');
Route::get('/user/avatar/{filename}', [UserController::class, 'getImage'])->name('user.avatar');
Route::get('getUsers/{search?}', [UserController::class, 'getUsers'])->name('user.getUsers');

/* Image controller */
Route::get('image/create', [ImageController::class, 'create'])->name('image.create');
Route::post('image/save', [ImageController::class, 'save'])->name('image.save');
Route::get('image/file/{filename}', [ImageController::class, 'getImage'])->name('image.get');
Route::get('image/detail/{id}', [ImageController::class, 'detail'])->name('image.detail');
Route::get('image/delete/{id}', [ImageController::class, 'delete'])->name('image.delete');
Route::get('image/edit/{id}', [ImageController::class, 'edit'])->name('image.edit');
Route::post('image/update', [ImageController::class, 'update'])->name('image.update');

/* Comment controller */
Route::post('comment/save', [CommentController::class, 'save'])->name('comment.save');
Route::get('comment/delete/{id}', [CommentController::class, 'delete'])->name('comment.delete');

/* Like controller */
Route::get('like/{image_id}', [LikeController::class, 'like'])->name('like');
Route::get('dislike/{image_id}', [LikeController::class, 'dislike'])->name('dislike');
Route::get('viewLikes', [LikeController::class, 'viewLikes'])->name('viewLikes');
