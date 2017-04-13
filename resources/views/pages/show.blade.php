@extends('layouts.app')

@section('content')

  <div class="panel panel-default">
    <div class="panel-body">
      <h1>
        <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
        {{ $page->title }}
      </h1>

      <hr>

      <p>
        {!! $page->content !!}
      </p>

    </div>
  </div>

@endsection
