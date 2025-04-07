<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateData;

class commentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth')->only([
            'createComment',
            'physicaldeletecomment',
            'logicaldeletecomment'
        ]);
    }

    public function createComment(Thread $thread, CreateData $request)
    {
        $comment = new Comment;
        $comment->user_id = Auth::id();
        $comment->thread_id = $thread->id;
        $comment->content = $request->content;
        $comment->save();

        return redirect()->route('thread.detail', ['thread' => $thread]);
    }

    public function physicaldeletecomment(Thread $thread, Comment $comment)
    {
        $comment->delete();
        return redirect()->route('thread.detail', ['thread' => $thread]);
    }

    public function logicaldeletecomment(Thread $thread, Comment $comment)
    {
        $comment->del_flg = 1;
        $comment->save();
        return redirect()->route('thread.detail', ['thread' => $thread]);
    }
}
