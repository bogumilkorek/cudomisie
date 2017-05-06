@extends('layouts.app')

@section('content')

  <div class="panel panel-default">
    <div class="panel-body">
      <h1>
        {{ __('Success') }}!
      </h1>

      <hr>

      <p>
        <b>{{ __('Your order has been placed successfully!') }}</b><br /><br />
        @if($status == __('Online payment'))
        {{ __('Your payment is being verified. After verification, you will be notified and the supplier will begin to process your order.') }}<br /><br />
        @elseif($status == __('Bank transfer'))
          {{ __('Please pay :total on the following account number', ['total' => $total_cost]) }}:<br />
          {{ env('SELLER_BANK_NAME') }} {{ env('SELLER_BANK_ACCOUNT') }}<br />
          {{ env('SELLER_NAME') }}<br />
          {{ env('SELLER_ADDRESS') }}, {{ env('SELLER_CITY') }}<br />
          {{ __('Payment title: cudomisie.pl order no :id', ['id' => $id]) }}<br /><br />
          @else
            {{ __('You have selected cash on delivery option. Please prepare: :total for your courier/postman', ['total' => $total_cost]) }}.<br /><br />
        @endif

        <b>{{ __('Track order status') }}: <a href="{{ route('user.orders.show', $uuid) }}">{{ route('user.orders.show', $uuid) }}</a></b>
      </p>

    </div>
  </div>
@endsection
