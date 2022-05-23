<?php

namespace App\Http\Controllers\Admin\Main;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use App\Models\Post;

class IndexController extends Controller
{
    public function __invoke()
    {
        $data = [
            'categoriesCount' => Category::all()->count(),
            'tagsCount' => Tag::all()->count(),
            'usersCount' => User::all()->count(),
            'postsCount' => Post::all()->count(),
        ];

        return view('admin.main.index', [
            'data' => $data,
        ]);
    }
}
