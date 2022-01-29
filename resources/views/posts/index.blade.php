@extends('layouts.app')

@section('title')Index @endsection

@section('content')
<div class="text-center">
  <a href="{{ route('posts.create') }}" class="btn btn-success m-2">Create Post</a>
</div>
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
                <th scope="row">1</th>
                <td>{{ $post['title'] }}</td>
                <td>{{ $post['posted_by'] }}</td>
                <td>{{ $post['created_at'] }}</td>
                <td>
                    <a href="/posts/1" class="btn btn-info">View</a>
                    <a href="/posts/1/edit" class="btn btn-primary">Edit</a>
                    <a href="#" class="btn btn-danger">Delete</a>
                </td>
              </tr>

              @endforeach
    </tbody>
  </table>
  @endsection