<?php

use App\Http\Controllers\commentController;
use App\Http\Controllers\threadController;
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
    Route::get('/detail/{id}', [threadController::class, 'threaddetail'])->name('thread.detail');
    Route::get('/physical/delete/{id}', [threadController::class, 'threadphysicaldelete'])->name('physical_delete.thread');
    Route::get('/logical/delete/{id}', [threadController::class, 'threadlogicaldelete'])->name('logical_delete.thread');
    Route::post('/creat/comment/{id}', [commentController::class, 'createComment'])->name('create.comment');
    Route::get('/comment/physical_delete/{thread_id}/{comment_id}', [CommentController::class, 'physicalDelete'])->name('physical_delete.comment');
    Route::get('/comment/logical_delete/{thread_id}/{comment_id}', [CommentController::class, 'logicalDelete'])->name('logical_delete.comment');


});
