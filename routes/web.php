<?php

use App\Http\Controllers\PostController;
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

// Root
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', function() {
    return view('welcome');
});

// Posts
Route::resource('posts', PostController::class)->where(['post' => '\d+']);
Route::get('user/posts', [PostController::class, 'indexUserPosts'])->name('user.posts.index');

// Google OAUTH
//Route::get('google', function () {
 //   return view('googleAuth');
//});
Route::get('auth/google', [\App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [\App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback'])->name('auth.google.callback');

// Auth
Auth::routes();

