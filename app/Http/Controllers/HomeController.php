<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;

class HomeController extends Controller
{
    public function getHome(){
        $categorys = Category::where('status','1')->get();
        $posts = Post::where('status','1')->take(5)->orderBy('id','desc')->get();
        $posts_sline = Post::where('status','1')->take(4)->orderBy('id','desc')->get();

        $posts_paginate = Post::orderBy('id','desc')->paginate(8);
        return view('home.index', ['categorys' => $categorys, 'posts' => $posts, 'posts_sline' => $posts_sline, 'posts_paginate' => $posts_paginate]);
    }

    public function show($category, $post){
        $post = Post::where('slug', $post)->firstOrFail();
        return view('home.layout.main', ['post' => $post]);
    }

    public function showComment($category, $post)
    {
        $posts = Post::where('slug', $post)->firstOrFail();
        return response()->json([
            'posts'=>$posts,
        ]);
    }
}
