@extends('layouts.app')

@section('content')


  <div class="panel panel-default">
    <div class="panel-body">

      <h1>
        <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
        {{ $blog_post->title }}
      </h1>

      <hr>

      <p>
        {!! $blog_post->content !!}
      </p>

      <div class="text-center">

        <div class="gallery">
          @foreach($blog_post->images as $image)
            <a href="{{ $image->url }}">
              <img src="{{ $image->thumbnail_url }}" />
            </a>
          @endforeach
        </div>

      </div>

    </div>
  </div>

@endsection
