<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Catch_;

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
        try {
            $data = $request->validated();
            // dd($data);
            $tagIds = $data['tag_ids'];
            unset($data['tag_ids']);

            $data['main_image'] = Storage::put('/image', $data['main_image']);
            $data['preview_image'] = Storage::put('/image', $data['preview_image']);

            $post = Post::firstOrCreate($data);
            $post->tags()->attach($tagIds);

        } catch (\Exception $exception) {
            abort(404);
        }
        return redirect()->route('admin.post.index');
    }
}
