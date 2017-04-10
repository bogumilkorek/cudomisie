@extends('layouts.app')

@section('content')

<div class="container">

  <h1>
    <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
    {{ __('Order no') }} {{ $order->id }}
  </h1>

  <hr>
  <div class="panel panel-default">
    <div class="panel-body">
      <p>
        <b>{{ __('Status') }}:</b><br />{{ $order->orderStatus->title }}<br /><br />
        <b>{{ __('Products') }}:</b><br />
        @foreach($order->products as $product)
        {{ $product->pivot->product_title }} ({{ $product->pivot->product_price }}) - {{ $product->pivot->product_quantity }} {{ __('pcs.') }}<br />
        @endforeach
        <br />
        <b>{{ __('Shipping method') }}:</b><br />{{ $order->shippingMethod->title }} ({{ $order->shipping_cost }})<br /><br />
        <b>{{ __('Total cost') }}:</b><br />{{ $order->total_cost }}<br /><br />
        <b>{{ __('Name') }}:</b><br />{{ $order->name }}<br /><br />
        <b>{{ __('E-mail') }}:</b><br />{{ $order->email }}<br /><br />
        <b>{{ __('Phone') }}:</b><br />{{ $order->phone }}<br /><br />
        <b>{{ __('Address') }}:</b><br />{{ $order->address }}<br /><br />
        <b>{{ __('Comments') }}:</b><br />
        @if($order->comments)
        {{ $order->comments }}
        @else
        {{ __('Nope') }}
        @endif
        <br /><br />
        <b>{{ __('Date') }}:</b><br />{{ $order->created_at }}<br /><br />
      </p>
    </div>
  </div>

  @endsection
