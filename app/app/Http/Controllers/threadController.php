<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Thread;
use App\Http\Requests\CreateData;

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

    public function createthread(CreateData $request)
    {

        $threads = new Thread;

        $threads->user_id = Auth::id();
        $threads->name = $request->name;

        $threads->save();
        return redirect('/thread');
    }

    public function threaddetail(Thread $thread)
    {
        $comments = Comment::where('thread_id', $thread->id)
            ->where('del_flg', 0)
            ->get();

        return view('detail_thread', [
            'threads' => $thread,
            'comments' => $comments,
        ]);
    }

    public function threadphysicaldelete(Thread $thread)
    {
        $thread->delete();
        return redirect('/thread');
    }

    public function threadlogicaldelete(Thread $thread)
    {
        $thread->del_flg = 1;
        $thread->save();
        return redirect('/thread');
    }
}
