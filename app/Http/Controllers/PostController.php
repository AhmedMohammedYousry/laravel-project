<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $allPosts = [
            ['title' => 'Learn PHP', 'posted_by'=> 'Ahmed', 'created_at' => '2018-01-20'],
            ['title' => 'Solid Principles', 'posted_by'=> 'Mohamed', 'created_at' => '2018-05-25'],
            ['title' => 'Design Patterns', 'posted_by'=> 'Ali', 'created_at' => '2019-01-02'],
        ];

        return view('posts.index', [
            'allPosts' => $allPosts
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        return redirect()->route('posts.index');
    }

    public function show($postId)
    {
        return view('posts.show');
    }

    public function edit($postId)
    {
        return view('posts.edit');
    }
}