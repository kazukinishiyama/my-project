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

    public function index(Request $request)
    {
        $query = Thread::withCount('likes');

        // いいね済みフィルタ
        if ($request->filled('liked_only') && Auth::check()) {
            $likedIds = Auth::user()->likes()->pluck('thread_id')->toArray();
            $query->whereIn('id', $likedIds);
        }

        // 自分の投稿のみフィルタ
        if ($request->filled('own_only') && Auth::check()) {
            $query->where('user_id', Auth::id());
        }

        // ソート処理
        if ($request->sort === 'latest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($request->sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } elseif ($request->sort === 'likes') {
            $query->orderBy('likes_count', 'desc');
        }

        $threads = $query->get();

        return view('thread', [
            'threads' => $threads,
            'request' => $request, // 必要なら渡す
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
