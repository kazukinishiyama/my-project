<?php

use App\Comment;
use App\Http\Controllers\commentController;
use App\Http\Controllers\threadController;
use App\Http\Controllers\likeController;
use App\Thread;
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

Auth::routes();

Route::group(['middleware'], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/thread', [threadController::class, 'index'])->name('thread.create');
    Route::post('/thread', [threadController::class, 'createthread'])->name('create.thread');

    Route::group(['middleware' => 'can:view,thread'], function () {
        Route::get('/detail/{thread}', [threadController::class, 'threaddetail'])->name('thread.detail');
        Route::post('/creat/comment/{thread}', [commentController::class, 'createComment'])->name('create.comment');
    });

    Route::group(['midllware' => 'can:delete,thread'], function () {
        Route::get('/physical/delete/{thread}', [threadController::class, 'threadphysicaldelete'])->name('physical_delete.thread');
        Route::get('/logical/delete/{thread}', [threadController::class, 'threadlogicaldelete'])->name('logical_delete.thread');
    });

    Route::group(['middleware' => 'can:delete,comment'], function () {
        Route::get('/comment/physical_delete/{thread}/{comment}', [commentController::class, 'physicaldeletecomment'])->name('physical_delete.comment');
        Route::get('/comment/logical_delete/{thread}/{comment}', [commentController::class, 'logicaldeletecomment'])->name('logical_delete.comment');
    });
    Route::post('/like_thread', [likeController::class, 'toggleLike'])->name('thred.like');
});
