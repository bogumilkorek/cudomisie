@extends('layouts.app')

@section('content')

  <h1>
    <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
    {{ __('Cart') }}
  </h1>

  <hr>

  @forelse($products as $product)
    {{ $product->title  }} - {{ $quantities[$product->slug] }} {{ __('pcs.') }}<br />
  @empty
    <h3> {{ __('No data') }} </h3>
  @endforelse

@endsection
