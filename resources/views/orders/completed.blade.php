@extends('layouts.app')

@section('content')

  <div class="panel panel-default">
    <div class="panel-body">
      <h1>
        <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
        {{ __('Success') }}!
      </h1>

      <hr>

      <p>
        <b>{{ __('Your order has been placed') }}</b><br />
        @if($cash_on_delivery == 1)
          {{ __('order.cashOnDelivery', ['total' => $total_cost]) }}<br /><br />
        @else
          {{ __('order.cashUpFront', ['total' => $total_cost, 'id' => $id]) }}<br /><br />
        @endif

        <b>{{ __('Track order status') }}: <a href="{{ route('user.orders.show', $uuid) }}">{{ route('user.orders.show', $uuid) }}</a></b>
      </p>

    </div>
  </div>
@endsection
