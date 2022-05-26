<?php

namespace App\Http\Controllers\Post\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\Comment\StoreRequest;
use App\Models\Comment;
use App\Models\Post;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Post $post, StoreRequest $request)
    {
        // $data = $request->validated();
        // $data['user_id'] = auth()->user()->id;
        // $data['post_id'] = $post->id;
        // // dd($data);
        $comment = new Comment;
        $comment->message = $request->message;
        $comment->user_id = auth()->user()->id;
        $comment->post_id = $post->id;
        $comment->save();
        // Comment::create($data);

        return redirect()->route('post.show', $post->id);
    }
}
