@extends('layouts.app')

@section('content')

<h1>
  <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
  {{ $product->title }}
</h1>

<hr>

<p>
  {!! $product->description !!}
</p>

@endsection
