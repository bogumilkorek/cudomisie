@extends('layouts.app')

@section('content')

  <div class="panel panel-default">
    <div class="panel-body">

      <h1>
        <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
        {{ __('Place order') }}
      </h1>

      <hr>

      @component('components.cartItems', [
        'products' => $items['products'],
        'quantities' => $items['quantities'],
        'total' => $items['total'],
      ])
    @endcomponent

    <form method="POST" action="{{ route('user.orders.store') }}">
      {{ csrf_field() }}

      @include('orders.form')

      <div class="text-center">

      <button type="submit" class="btn btn-dashed"
      data-loading-text="<i class='fa fa-cog fa-spin'></i>
      {{ __('Loading') }}">
        <i class="fa fa-cart-arrow-down" aria-hidden="true"></i> {{ __('Place order') }}
      </button>

      <a href="{{ route('user.products.index') }}" class="btn btn-dashed">
        <i class="fa fa-shopping-bag" aria-hidden="true"></i> {{ __('Continue shopping') }}
      </a>

      <a href="#" class="btn btn-dashed cart-clear">
        <i class="fa fa-times" aria-hidden="true"></i> {{ __('Clear cart') }}
      </a>

    </div>
  </form>

</div>
</div>


@endsection
