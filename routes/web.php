<?php

use App\Http\Controllers\PostController;
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

Route::get('/', App\Livewire\Post\Index::class)->name('posts.index');
Route::get('/create', App\Livewire\Post\Create::class)->name('posts.create');
Route::get('/edit/{id}', App\Livewire\Post\Edit::class)->name('post.edit');
