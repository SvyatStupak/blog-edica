<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $posts = Post::paginate(4);
        // dd($posts);

        $randomPosts = Post::get()->random(4);
        $likedPosts = Post::withCount('likedPosts')->orderBy('liked_posts_count', 'DESC')->get()->take(4);


        return view('post.index', [
            'posts' => $posts,
            'randomPosts' => $randomPosts,
            'likedPosts' => $likedPosts
        ]);
    }
}
