<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use File;

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
        $new_name = $this->store_image($request);
        
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

        $post =  Post::find($postId);
        $this->delete_image($post->picture_path);
        $post->delete();
        
        
        return redirect()->route('posts.index');
    }

    public function store_image(Request $req)
    {
        $this->validate($req, [
            'picture'  => 'image|mimes:jpg,png'
           ]);
      
           $image = $req->file('picture');
      
           $new_name = $req->title . '.' . $image->getClientOriginalExtension();
      
           $image->move(public_path('img'), $new_name);  
           return $new_name; 
    }
    public function delete_image($name)
    {
        $file =public_path('img/'.$name);
        $img=File::delete($file);
    }
}