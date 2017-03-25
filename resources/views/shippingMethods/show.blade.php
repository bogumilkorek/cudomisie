@extends('layouts.app')

@section('content')

<h1>
  <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
  {{ $shippingMethod->title }}
</h1>

<hr>

<p>
  {!! $shippingMethod->content !!}
</p>

@endsection
