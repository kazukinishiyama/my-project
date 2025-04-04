<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Thread;

class threadController extends Controller
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

    public function index()
    {
        $threads = new Thread;
        $all = $threads->where('del_flg', 0)->get()->toArray();
        return view('thread', [
            'threads' => $all
        ]);
    }

    public function createthread(Request $request)
    {

        $threads = new Thread;

        $threads->user_id = Auth::id();
        $threads->name = $request->name;

        $threads->save();
        return redirect('/thread');
    }

    public function threaddetail(int $threadId)
    {
        $threads = Thread::find($threadId);
        $comments = Comment::where('thread_id', $threadId)
            ->where('del_flg', 0)
            ->get();
        if (!$comments) {
            $comments = collect([]);
        }
        return view('detail_thread', [
            'threads' => $threads,
            'comments' => $comments
        ]);

    }

    public function threadphysicaldelete(int $threadId)
    {
        $threads = Thread::find($threadId);
        $threads->delete();
        return redirect('/thread');
    }

    public function threadlogicaldelete(int $threadId)
    {
        $threads = Thread::find($threadId);
        $threads->del_flg = 1;
        $threads->save();
        return redirect('/thread');
    }
}
