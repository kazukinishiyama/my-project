<?php

namespace App\Http\Controllers;

use App\Comment;
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


    public function createComment(int $threadId, CreateData $request)
    {

        $comments = new Comment;

        $comments->user_id = Auth::id();
        $comments->thread_id = $threadId;
        $comments->content = $request->content;

        $comments->save();
        return redirect()->route('thread.detail', ['id' => $threadId]);
    }

    public function physicaldeletecomment(int $thread_id, int $comment_id)
    {
        $comments = Comment::find($comment_id);
        $comments->delete();
        return redirect()->route('thread.detail', ['id' => $thread_id]);
    }

    public function logicaldeletecomment(int $thread_id, int $comment_id)
    {
        $comments = Comment::find($CommentId);
        $comments->del_flg = 1;
        $comments->save();
        return redirect()->route('thread.detail', ['id' => $thread_id]);
    }
}
