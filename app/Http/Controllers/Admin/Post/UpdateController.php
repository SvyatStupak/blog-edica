<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UpdateRequest $request, Post $post)
    {
        $data = $request->validated();
            // dd($data);
        $tagIds = $data['tag_ids'];
        unset($data['tag_ids']);

        $data['main_image'] = Storage::disk('public')->put('/images', $data['main_image']);
        $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
        $post->update($data);
        $post->tags()->sync($tagIds);

        return view('admin.post.show', [
            'post' => $post,
        ]);
    }
}
