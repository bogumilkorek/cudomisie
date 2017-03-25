@extends('layouts.app')

@section('content')

<h1>
  <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
  {{ $blog_post->title }}
</h1>

<hr>

<p>
  {!! $blog_post->content !!}
</p>

@endsection
