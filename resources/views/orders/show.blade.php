@extends('layouts.admin')

@section('content')

  <div class="container">

    <h1>
      {{ __('Order no') }} {{ $order->id }}
    </h1>

    <hr>

    <p>
      <b>{{ __('Products') }}:</b><br />
      @foreach($order->products as $product)
        {{ $product->title }}<br />
      @endforeach
      <br />
      <b>{{ __('Status') }}:</b><br />{{ $order->orderStatus->title }}<br /><br />
      <b>{{ __('Shipping method') }}:</b><br />{{ $order->shippingMethod->title }} ({{ $order->shipping_cost }})<br /><br />
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

      <a href="{{ url()->previous() }}" class="btn btn-primary">{{ __('Go back') }}</a>
    </p>

  </div>

@endsection
