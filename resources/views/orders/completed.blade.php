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
        <b>{{ __('Your order has been placed') }}</b><br /><br />
        @if($cash_on_delivery == 1)
          {{ __('You have selected cash on delivery option. Please prepare: :total for your courier/postman', ['total' => $total_cost]) }}.<br /><br />
        @else
          {{ __('Please pay :total on the following account number', ['total' => $total_cost]) }}:<br />
          {{ env('SELLER_BANK_NAME') }} {{ env('SELLER_BANK_ACCOUNT') }}<br />
          {{ env('SELLER_NAME') }}<br />
          {{ env('SELLER_ADDRESS') }}, {{ env('SELLER_CITY') }}<br /><br />
          {{ __('Payment title: cudomisie.pl order no :id', ['id' => $id]) }}<br />
        @endif

        <b>{{ __('Track order status') }}: <a href="{{ route('user.orders.show', $uuid) }}">{{ route('user.orders.show', $uuid) }}</a></b>
      </p>

    </div>
  </div>
@endsection
