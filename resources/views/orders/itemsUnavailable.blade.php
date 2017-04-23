@extends('layouts.app')

@section('content')

<div class="panel panel-default">
  <div class="panel-body">
    <h1>
      <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
      {{ __('Error') }}!
    </h1>

    <hr>

    <p>
      Items unavailable
    </p>

  </div>
</div>
@endsection
