@extends('layouts.app')

@section('content')

  <div class="panel panel-default">
    <div class="panel-body">
      <h1>
        <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
        {{ $product->title }}
      </h1>

      <hr>
      <p>
        {!! $product->description !!}
        <br /><br />
        <b>{{ __('Dimensions') }}: {{ $product->dimensions }}</b>
      </p>

      <div class="text-center">

        <div class="gallery">
          @foreach($product->images as $image)
            <a href="{{ $image->url }}">
              <img src="{{ $image->thumbnail_url }}" />
            </a>
          @endforeach
        </div>

        <h3>{{ __('Price')}}: {{ $product->price }}</h3>
        <input type="number" min="1" max="9" class="form-control text-center btn-dashed" value="1" data-slug="{{ $product->slug }}" style="display: inline-block; width: 70px; padding: 24px 5px; font-family: Noto Sans; margin-right: 0px">
        <a href="#" class="btn btn-dashed cart-add" data-slug="{{ $product->slug }}">
          <i class="fa fa-shopping-cart" aria-hidden="true"></i> {{ __('Add to cart') }}
        </a>

      </div>

    </div>
  </div>

@endsection
