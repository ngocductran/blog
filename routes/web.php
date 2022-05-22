<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;
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
Route::get('/test', function () {
    return view('home.test');
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'getLogin'])->name('login');
    Route::post('/login',[AdminController::class, 'postLogin'])->name('admin.login.post');

    Route::get('/register', [AdminController::class, 'getRegister'])->name('register');
    Route::post('/register',[AdminController::class, 'postRegister'])->name('admin.register.post');

    Route::get('/logout', [AdminController::class, 'getLogout'])->name('logout');

    Route::get('/index', [AdminController::class, 'index'])->name('dashboard')->middleware('admin.login');


    Route::middleware(['admin.login'])->prefix('profile')->group(function () {
        Route::get('/', [AdminController::class, 'getProfile'])->name('profile');
        Route::post('/', [AdminController::class, 'postProfileUpdate'])->name('profile.update');
        Route::post('/change-password',[AdminController::class, 'changePasswordPost'])->name('changePasswordPost');
        Route::get('/change-password',[AdminController::class, 'showChangePasswordGet'])->name('changePasswordGet');

    });

    Route::middleware(['admin.login'])->prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'listCategory'])->name('admin.list.category');

        Route::get('/create', [CategoryController::class, 'getCreateCategory'])->name('admin.create.category.get');
        Route::post('/create', [CategoryController::class, 'postCreateCategory'])->name('admin.create.category.post');


        Route::get('/edit/{id}', [CategoryController::class, 'getEditCategory'])->name('admin.edit.category');
        Route::post('/edit/{id}', [CategoryController::class, 'postEditCategory'])->name('admin.edit.category.post');


        Route::get('/delete/{id}', [CategoryController::class, 'getDeleteCategory'])->name('admin.delete.category');
    });

    Route::middleware(['admin.login'])->prefix('post')->group(function () {
        Route::get('/', [PostController::class, 'listPost'])->name('admin.list.post');

        Route::get('/create', [PostController::class, 'getCreatePost'])->name('admin.create.post.get');
        Route::post('/create', [PostController::class, 'postCreatePost'])->name('admin.create.post');

        Route::get('/edit/{id}', [PostController::class, 'getEditPost'])->name('admin.edit.post.get');
        Route::post('/edit/{id}', [PostController::class, 'postEditPost'])->name('admin.edit.post.post');

        Route::get('/delete/{id}', [PostController::class, 'getDeletePost'])->name('admin.delete.post');
    });
});

Route::get('/', [HomeController::class, 'getHome'])->name('home');
Route::get('{category}/{post}', [HomeController::class, 'showComment'])->name('post.show');

Route::post('/comment', [CommentController::class, 'createComment'])->name('comment.create');

