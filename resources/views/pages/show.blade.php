@extends('layouts.app')

@section('content')

  <div class="panel panel-default">
    <div class="panel-body">
      <h1>
        <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
        {{ $page->title }}
      </h1>

      <hr>

      <p>
        {!! $page->content !!}
      </p>

      <div class="text-center">

        <div class="gallery">
          @foreach($page->images as $image)
            <a href="{{ $image->full_url }}">
              <img src="{{ $image->thumbnail_url }}" />
            </a>
          @endforeach
        </div>

      </div>

    </div>
  </div>

@endsection
