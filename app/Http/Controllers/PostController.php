<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;

class PostController extends Controller
{
    public function index()
    {
        $allPosts = Post::paginate(5);
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

    public function store(StorePostRequest $request)
    {
        
        $data = request()->all();
        $this->validate($request, [
            'picture'  => 'image|mimes:jpg,png'
           ]);
      
           $image = $request->file('picture');
      
           $new_name = $data['title'] . '.' . $image->getClientOriginalExtension();
      
           $image->move(public_path('img'), $new_name);
        Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['post_creator'],
            'picture_path' => $new_name
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
    public function update(UpdatePostRequest $request)
    {
        $data = request()->all();
        $post = Post::find($data['id']);
    $post->slug = null;
    $post->update(['title' => $data['title'],'description' => $data['description'],
    'user_id' => $data['post_creator']
]);
        return redirect()->route('posts.index');
    }

    public function destroy($postId)
    {
        
        $post = Post::where('id', $postId)->firstorfail()->delete();
        return redirect()->route('posts.index');
    }
}