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

Route::get('/', [PostController::class, 'showPage'])->name('showPage');
Route::post('/', [PostController::class, 'createPost'])->name('postCreate');
Route::get('/delete/{id}', [PostController::class, 'deletePost'])->name('postDelete');
Route::get('/more/{id}', [PostController::class, 'showMore'])->name('showMore');
Route::get('/edit/{id}', [PostController::class, 'editPost'])->name('postEdit');
Route::post('/update/{id}', [PostController::class, 'updatePost'])->name('postUpdate');
Route::get('delImg/{id}', [PostController::class, 'deleteImg'])->name('delImg');
