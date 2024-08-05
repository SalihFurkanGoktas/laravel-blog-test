<?php

use App\Models\Blog;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChirpController;
//use App\Http\Controllers\TestController;

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
});

Route::resource('blog', BlogController::class)
	->middleware(['auth','verified']);

Route::get('/show-blogs', function () {
	return view('blog.show', [
		'blogs' => Blog::with('user')->latest()->get(),
	]); })->name('blog.show');

Route::get('/show-blogs/{blog:heading}', [BlogController::class, 'showSpecific']);

Route::post('/blog-comment', [BlogController::class, 'storeComment'])->name('blog-comment');

Route::resource('chirps', ChirpController::class)
	->only(['index','store', 'edit', 'update'])
	->middleware(['auth','verified']);


require __DIR__.'/auth.php';
