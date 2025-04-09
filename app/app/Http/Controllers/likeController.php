<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Support\Facades\Log;
use App\Like;
use Illuminate\Http\Request;



class likeController extends Controller
{
    //
    public function toggleLike(Request $request)
    {
        $userId = auth()->id();
        $productId = $request->input('thread_id');

        logger('-----------test-----------------');
        logger($productId);
        logger('-----------test-----------------');

        logger('-----------test-----------------');
        logger($request->input('like_thread'));
        logger('-----------test-----------------');

        if ($request->input('like_thread') == 0) {
            Like::create([
                'thread_id' => $productId,
                'user_id' => $userId,
            ]);
        } elseif ($request->input('like_thread') == 1) {
            Like::where('thread_id', $productId)
                ->where('user_id', $userId)
                ->delete();
        }

        return response()->json([
            'status' => 'success',
            'liked' => !$request->input('like_thread')
        ]);

        // return $request->input('like_thread');
    }

}
