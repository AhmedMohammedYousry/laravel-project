@extends('layouts.app')

@section('title') Show @endsection

@section('content')
<div class="card m-3">
    <div class="card-header">
      Post Info
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item"><span class="fw-bold">Title: </span>
        Learn PHP </li>
      <li class="list-group-item"><span class="fw-bold">Description: </span>
        PHP and Laravel Course</li>
    </ul>
  </div>
  <div class="card m-3">
    <div class="card-header">
      Post Creator Info
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item"><span class="fw-bold">Name: </span>
        Ahmed </li>
      <li class="list-group-item"><span class="fw-bold">Email: </span>
        ahmad@gmail.com</li>
      <li class="list-group-item"><span class="fw-bold">Created at: </span>
        2018-01-20</li>
    </ul>
  </div>
@endsection
    