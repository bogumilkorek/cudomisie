@extends('layouts.app')

@section('content')

<h1>
  <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
  {{ __('Search') }}: {{ $keywords }}
</h1>

<hr>


@endsection
