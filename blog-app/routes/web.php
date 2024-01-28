<?php

use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentsController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/blog-posts', [BlogPostController::class, 'index'])->name('blog-posts.index');
    Route::get('/new-post', [BlogPostController::class, 'create'])->name('new-post.create');
    Route::post('/new-post', [BlogPostController::class, 'store'])->name('new-post.store');
    Route::get('/edit-post/{id}', [BlogPostController::class, 'edit'])->name('edit-post.edit');
    Route::put('/edit-post/{id}', [BlogPostController::class, 'update'])->name('edit-post.update');
    Route::delete('/delete-post/{id}', [BlogPostController::class, 'delete'])->name('delete-post.delete');
    Route::get('/my-posts', [BlogPostController::class, 'myPosts'])->name('my-posts.myPosts');
    Route::get('/all-posts', [BlogPostController::class, 'allPosts'])->name('all-posts.allPosts');
    Route::post('/add-comment{id}', [CommentsController::class, 'store'])->name('add-comment');
});

require __DIR__ . '/auth.php';
