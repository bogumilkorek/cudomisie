@extends('layouts.app')

@section('content')

<h1>
  <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
  {{ $category->title }}
</h1>

<hr>

<p>
  {!! $category->content !!}
</p>

@endsection
