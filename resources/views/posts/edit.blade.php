@extends('layouts.app')

@section('title') Create @endsection

@section('content')
<div class="container">
        <form method="POST" action="/posts/{{$postId}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="put" />
            <input hidden name="id" value="{{$postId}}" type="text" class="form-control" id="exampleFormControlInput1">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input name="title" type="text" class="form-control" id="exampleFormControlInput1">
            </div>
            
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>  
            </div>

            <div class="mb-3">
                <label for="picture">Select a file:</label>
                <input type="file" id="picture" name="picture"> 
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Post Creator</label>
                <select name="post_creator" class="form-control">
                    @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option> 
                    @endforeach
                </select>
            </div>
            
            <button class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
    