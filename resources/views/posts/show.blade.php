@extends('layouts.app')

@section('title') Show @endsection

@section('content')
{{-- @dd($post) --}}
<div class="text-center">
  <img src="{{ asset('img/'.$post->picture_path) }}" width="200" height="200" alt="image">
</div>
<div class="card m-3">
    <div class="card-header">
      Post Info
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item"><span class="fw-bold">Title: </span>
        {{$post->title}} </li>
      <li class="list-group-item"><span class="fw-bold">Description: </span>
        {{$post->description}}</li>
    </ul>
  </div>
  <div class="card m-3">
    <div class="card-header">
      Post Creator Info
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item"><span class="fw-bold">Name: </span>
        {{isset($post->user->name)?$post->user->name:'Not Found'}} </li>
      <li class="list-group-item"><span class="fw-bold">Email: </span>
        {{isset($post->user->email)?$post->user->email:'Not Found'}}</li>
      <li class="list-group-item"><span class="fw-bold">Created at: </span>
        {{isset($post->created_at)?$post->created_at:'Not Found'}} </li>
    </ul>
  </div>

  
@endsection
    