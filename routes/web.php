<?php

use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\DashboardController;


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

Route::get('/', [PostController::class, 'index'])->name('index');
Route::get('/posts', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/edit/{id}', [PostController::class, 'update'])->name('posts.update');
Route::post('/like/{postId}', [LikeController::class, 'like'])->name('like');


Route::get('like/{postid}', [LikeController::class, 'like'])->name('like');

Route::get('user/{name}', [UserController::class, 'profile'])->name('profile');
Route::put('user/{user}', [UserController::class, 'update'])->name('profile.update');

Route::get('/contact', [ContactController::class, 'showContactForm'])->name('contact');
Route::post('/contact', [ContactController::class, 'sendContactForm'])->name('contact.send');
Route::get('/faq', [FAQController::class, 'index'])->name('faq');
Route::post('/faq', [FAQController::class, 'store'])->name('faq.store');





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//admin
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::put('/promote/{user}', [UserController::class, 'promote'])->name('promote');
Route::put('/remove-admin/{user}', [UserController::class, 'removeAdmin'])->name('remove.admin');
