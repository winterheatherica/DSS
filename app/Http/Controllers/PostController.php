<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('posts', ['title' => 'Posts Page', 'posts' => Post::all()]);
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('post', ['title' => "Post {$post['title']} By {$post['author']}", 'post' => $post]);
    }
}
