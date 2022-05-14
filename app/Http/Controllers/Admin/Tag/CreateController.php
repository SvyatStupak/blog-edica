<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return view('admin.tag.create');
    }
}
