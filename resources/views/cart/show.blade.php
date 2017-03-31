@extends('layouts.app')

@section('content')

<h1>
  <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
  {{ __('Cart') }}
</h1>

<hr>

@foreach($items as $item)
  {{ $item }}<br />
@endforeach

@endsection
