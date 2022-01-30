@extends('layouts.app')

@section('title')Index @endsection

@section('content')
<div class="text-center">
  <a href="{{ route('posts.create') }}" class="btn btn-success m-2">Create Post</a>
</div>
<div class="container">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Posted by</th>
        <th scope="col">Created at</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($allPosts as $post)
      
              <tr>
                <th scope="row">{{ $post->id }}</th>
                <td>{{ $post->title }}</td>
                <td>{{ isset($post->user)? $post->user->name : 'Not Found'; }}</td>
               
                
                <td>{{ $post->created_at->format('M d Y') }}</td>
                <td>
                    <a href="/posts/{{$post->id}}" class="btn btn-info">View</a>
                    <a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>  
                    <form onsubmit="toSubmit(e)" style="display:inline" method="post" action="/posts/{{$post->id}}/delete">
                      @csrf
                      <input type="hidden" name="_method" value="DELETE" />
                    <button type="submit" class="deleteButton btn btn-danger" onclick="return confirm('sure?')">Delete</button>

                      </form>
                </td>
              </tr>

              @endforeach
    </tbody>
  </table>
  <div>{{ $allPosts->links('pagination::bootstrap-4') }}</div>

</div>


  <script src="{{asset('js/deleteMsg.js')}}" text="text/javascript"></script>
  @endsection