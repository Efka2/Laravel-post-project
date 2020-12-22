<?php

use App\Http\Controllers\Posts\LikeController;
use App\Http\Controllers\Posts\PostController;
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

Route::get('/posts', [PostController::class,'index'])->name('posts')->middleware('auth');
Route::get('/posts/create', [PostController::class,'create'])->name('posts.create')->middleware('auth');
Route::delete('/posts/{post}/delete', [PostController::class,'destroy'])->name('post.delete')->middleware('auth');
Route::post('/posts/create', [PostController::class,'store'])->name('posts.store')->middleware('auth');


Route::post('/posts/{post}/like', [LikeController::class,'store'])->name('post.like')->middleware('auth');
Route::delete('/posts/{post}/unlike', [LikeController::class,'destroy'])->name('post.unlike')->middleware('auth');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
