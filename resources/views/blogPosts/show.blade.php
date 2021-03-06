@extends('layouts.app')

@section('content')
<div class="panel panel-default">
  <div class="panel-body">
    <h1>
      {{ $blog_post->title }}
    </h1>
    <hr>
    {!! $blog_post->content !!}
    <div class="text-center">
      <div class="gallery">
        @foreach($blog_post->images as $image)
        <a href="{{ $image->full_url }}">
          <img src="{{ $image->thumbnail_url }}" />
        </a>
        @endforeach
      </div>
    </div>
  </div>
</div>

@endsection
