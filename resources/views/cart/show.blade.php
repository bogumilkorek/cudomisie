@extends('layouts.app')

@section('content')

  <h1>
    <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
    {{ __('Cart') }}
  </h1>

  <hr>
  <div class="panel panel-default">
    <div class="panel-body">

      @if($items['products']->isEmpty())
        <h3> {{ __('No data') }}</h3>
        <hr>
        <div class="text-center">
          <a href="{{ route('user.products.index') }}" class="btn btn-white btn-primary">
            <i class="fa fa-shopping-bag" aria-hidden="true"></i> {{ __('Continue shopping') }}
          </a>
        </div>
      @else
        @component('components.cartItems', [
          'products' => $items['products'],
          'quantities' => $items['quantities'],
          'total' => $items['total'],
          'deleteButtons' => true,
        ])
      @endcomponent

      <div class="text-center">
        <a href="{{ route('user.orders.create') }}" class="btn btn-white btn-success">
          <i class="fa fa-cart-arrow-down" aria-hidden="true"></i> {{ __('Place order') }}
        </a>

        <a href="{{ route('user.products.index') }}" class="btn btn-white btn-primary">
          <i class="fa fa-shopping-bag" aria-hidden="true"></i> {{ __('Continue shopping') }}
        </a>

        <a href="#" class="btn btn-white  btn-danger cart-clear">
          <i class="fa fa-times" aria-hidden="true"></i> {{ __('Clear cart') }}
        </a>

      </div>

    @endif

  </div>
</div>

@endsection
