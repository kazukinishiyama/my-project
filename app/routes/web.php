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

Route::group(['middleware' => 'auth'], function () {

    // ホーム画面（認証後）
    Route::get('/', function () {
        return view('welcome');
    });

    // スレッド作成と一覧
    Route::get('/thread', [threadController::class, 'index'])->name('thread.create');
    Route::post('/thread', [threadController::class, 'createthread'])->name('create.thread');

    // スレッド詳細・コメント作成（論理削除されたスレッドも管理者なら閲覧可）
    Route::get('/detail/{thread}', [threadController::class, 'threaddetail'])
        ->middleware('can:view,thread')->name('thread.detail');
    Route::post('/creat/comment/{thread}', [commentController::class, 'createComment'])
        ->middleware('can:view,thread')->name('create.comment');

    // スレッド削除
    Route::get('/physical/delete/{thread}', [threadController::class, 'threadphysicaldelete'])
        ->middleware('can:delete,thread')->name('physical_delete.thread');

    Route::get('/logical/delete/{thread}', [threadController::class, 'threadlogicaldelete'])
        ->middleware('can:delete,thread')->name('logical_delete.thread');

    // コメント削除（管理者 or 自分のコメントのみ）
    Route::get('/comment/physical_delete/{thread}/{comment}', [commentController::class, 'physicaldeletecomment'])
        ->middleware('can:delete,comment')->name('physical_delete.comment');

    Route::get('/comment/logical_delete/{thread}/{comment}', [commentController::class, 'logicaldeletecomment'])
        ->middleware('can:delete,comment')->name('logical_delete.comment');

    // いいね
    Route::post('/like_thread', [likeController::class, 'toggleLike'])->name('thred.like');
});

// デフォルトルート（ログイン後の遷移先）
Route::get('/home', 'HomeController@index')->name('home');
