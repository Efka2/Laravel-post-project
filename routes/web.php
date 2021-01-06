<?php

use App\Http\Controllers\AwardsController;
use App\Http\Controllers\Posts\CommentsController;
use App\Http\Controllers\Posts\LikeController;
use App\Http\Controllers\Posts\CommentLikeController;
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

Route::get('/posts', [PostController::class, 'index'])->name('posts')->middleware('auth');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth');
Route::delete('/posts/{post}/delete', [PostController::class, 'destroy'])->name('post.delete')->middleware('auth');
Route::post('/posts/create', [PostController::class, 'store'])->name('posts.store')->middleware('auth');

Route::post('/posts/{post}/like', [LikeController::class, 'store'])->name('posts.like')->middleware('auth');
Route::delete('/posts/{post}/like', [LikeController::class, 'destroy'])->name('posts.unlike')->middleware('auth');

Route::get('/posts/{user:username}', [PostController::class, 'userPosts'])
        ->name('user.posts')
        ->middleware('auth');

Route::get('/posts/{post}/show', [PostController::class, 'show'])
        ->name('posts.view');

Route::post('/posts/{post}/comment', [CommentsController::class, 'store'])
        ->name('posts.comment');

Route::post('/posts/like/{comment}', [CommentLikeController::class, 'store'])->name('comment.like');
Route::delete('/posts/unlike/{comment}', [CommentLikeController::class, 'destroy'])->name('comment.unlike');
Route::delete('/posts/delete/{comment}', [CommentsController::class, 'destroy'])->name('comment.delete');

Route::get('/awards', [AwardsController::class, 'index'])
        ->name('awards')
        ->middleware('auth');

Route::get('/awards/create', [AwardsController::class, 'create'])
        ->name('awards.create')
        ->middleware('auth');

Route::post('/awards/store', [AwardsController::class, 'store'])
        ->name('awards.store')
        ->middleware('auth');

Route::post('/post/{post}/award', [AwardsController::class, 'chooseAward'])
        ->name('award.chooseAward')
        ->middleware('auth');

Route::get('/post/{post}/{award}', [AwardsController::class, 'awardPost'])
        ->name('award.post')
        ->middleware('auth');

Route::get('/dashboard', function () {
        return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/award/{award}', [AwardsController::class, 'buyAward'])
        ->name('award.buy')
        ->middleware('auth');

require __DIR__ . '/auth.php';


Route::get('test', function () {
        return view('test');
});
