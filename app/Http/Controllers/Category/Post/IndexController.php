<?php

namespace App\Http\Controllers\Category\Post;

use App\Http\Controllers\Controller;
use App\Models\Category;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Category $category)
    {
        $posts = $category->posts()->paginate(6);
        // dd($posts);

        return view('category.post.index', [
            'posts' => $posts,
        ]);
    }
}
