@extends('layouts.app')

@section('content')

  <h1>
    {{ $shippingMethod->title }}
  </h1>

  <hr>

  <p>
    {!! $shippingMethod->content !!}
  </p>

@endsection
