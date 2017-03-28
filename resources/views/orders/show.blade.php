@extends('layouts.app')

@section('content')

<h1>
  <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
  {{ $page->title }}
</h1>

<hr>

<p>
  {!! $page->content !!}
</p>

@endsection
