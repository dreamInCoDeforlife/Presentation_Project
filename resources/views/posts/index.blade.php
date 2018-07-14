@extends('layouts.app')

@section('content')
  <h1>Posts</h1>
  @if(count($posts)>1)
    @foreach($posts as $post)
      <div class="container card">
        <h3><a href="/posts/{{$post->id}}">{{$post->title}}</h3>
        <small>Post Created on {{$post->created_at}} by {{$post->user['name']}}</small>
      </div>
      <br>
    @endforeach
    {{$posts->links()}}
  @else
    <p>No posts found</p>
  @endif
@endsection
