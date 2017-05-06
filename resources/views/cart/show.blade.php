@extends('layouts.app')

@section('content')

  <div class="panel panel-default">
    <div class="panel-body">
      <h1>

        {{ __('Cart') }}
      </h1>
      <hr>
      @if(!isset($items['products']) || $items['products']->isEmpty())
        <h3> {{ __('No data') }}</h3>
        <div class="text-center">
          <a href="{{ route('user.products.index') }}" class="btn btn-dashed">
            <i class="fa fa-shopping-bag" aria-hidden="true"></i> {{ __('Continue shopping') }}
          </a>
        </div>
      @else
        @component('components.cartItems', [
          'products' => $items['products'],
          'quantities' => $items['quantities'],
          'total' => $items['total'],
          'deleteButtons' => true,
          'input' => true
        ])
      @endcomponent

      @if($items['trashed'])
        <div class="alert alert-info">
          <strong>{{ __('Alert!') }}</strong>
          {{ __('Some items from your shopping cart were bought and are currently unavailable. Please remove those items from your cart to proceed with your order.') }}
        </div>
      @else
        <div class="text-center">
          <a href="{{ route('user.orders.create') }}" class="btn btn-dashed">
            <i class="fa fa-cart-arrow-down" aria-hidden="true"></i> {{ __('Place order') }}
          </a>

          <a href="{{ route('user.products.index') }}" class="btn btn-dashed">
            <i class="fa fa-shopping-bag" aria-hidden="true"></i> {{ __('Continue shopping') }}
          </a>

          <a href="#" class="btn btn-dashed cart-clear">
            <i class="fa fa-times" aria-hidden="true"></i> {{ __('Clear cart') }}
          </a>
        </div>
      @endif
    @endif

  </div>
</div>

@endsection
