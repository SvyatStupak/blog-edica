<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        $data['main_image'] = Storage::put('/image', $data['main_image']);
        $data['preview_image'] = Storage::put('/image', $data['preview_image']);

        Post::firstOrCreate($data);
        // dd($data);

        return redirect()->route('admin.post.index');
    }
}
