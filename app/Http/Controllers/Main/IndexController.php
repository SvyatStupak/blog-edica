<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $posts = Post::paginate(4);
        $randomPosts = Post::get()->random(4);
        $likedPosts = Post::withCount('likedPosts')->orderBy('liked_posts_count', 'DESC')->get()->take(4);
        // dd($likedPosts);

        return view('main.index', [
            'posts' => $posts,
            'randomPosts' => $randomPosts,
            'likedPosts' => $likedPosts
        ]);

    }
}
