<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        return Post::with('user')
            ->paginate(20);
    }

    public function show(Post $post)
    {
        $post->load('user');

        return $post;
    }
}
