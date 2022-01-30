<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
class PostController extends Controller
{
    public function index()
    {
        $allPosts = Post::paginate(2);
        return view('posts.index', [
            'allPosts' => $allPosts
        ]);
    }

    public function create()
    {
        $users = User::all();
        return view('posts.create',[
            'users' => $users
        ]);
    }

    public function store()
    {
        $data = request()->all();
        Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['post_creator']
        ]);
        return redirect()->route('posts.index');
    }

    public function show($postId)
    {
        
        $post = Post::
        where('id', '=', $postId)
        ->first();
        return view('posts.show',[
            'post' => $post
        ]);
    }

    public function edit($postId)
    {
        $users = User::all();
        return view('posts.edit',[
            'postId' => $postId,
            'users' => $users
        ]);
    }
    public function update()
    {
        $data = request()->all();
        
        Post::where('id',$data['id'])->update(['title' => $data['title'],
        'description' => $data['description'],
    ]);
        return redirect()->route('posts.index');
    }

    public function destroy($postId)
    {
        
        $post = Post::where('id', $postId)->firstorfail()->delete();
        return redirect()->route('posts.index');
    }
}