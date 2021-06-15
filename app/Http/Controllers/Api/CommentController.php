<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function index(Post $post)
    {
        $post->load('user');

        return $post->comments()
            ->with('user')
            ->get();
    }

    public function show(Post $post, Comment $comment)
    {
        $comment->load('user');

        return $comment;
    }
}
