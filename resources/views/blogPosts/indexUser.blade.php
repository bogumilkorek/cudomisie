@extends('layouts.app')

@section('content')

  @component('components.postGrid', [
  'posts' => $blog_posts
  ])
  @endcomponent

@endsection
