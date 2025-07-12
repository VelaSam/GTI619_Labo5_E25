<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($post)
    {
        $posts = [
            'my-first-post' => 'My First Post',
            'my-second-post' => 'My Second Post',
            'my-third-post' => 'My Third Post',
        ];

        if (!array_key_exists($post, $posts)) {
            abort(404);
        }
        return view('post', [
            'post' => $posts[$post]
        ]);
    }
}
