@extends('layouts.app')

@section('content')

  <h1>
    <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
    {{ $product->title }}
  </h1>

  <hr>

  <div class="panel panel-default">
    <div class="panel-body">
      <p>
        {!! $product->description !!}
        <br /><br />
        <b>{{ __('Dimensions') }}: {{ $product->dimensions }}</b>
        <h3>{{ __('Price')}}: {{ $product->price }}</h3>
      </p>

      <div class="text-center">

        <div class="gallery">
          @foreach($product->images as $image)
            <a href="{{ $image->url }}">
              <img src="{{ $image->thumbnail_url }}" />
            </a>
          @endforeach
        </div>

        <a href="#" class="btn btn-dashed cart-add" data-slug="{{ $product->slug }}">
          <i class="fa fa-shopping-cart" aria-hidden="true"></i> {{ __('Add to cart') }}
        </a>

      </div>

    </div>
  </div>

@endsection
