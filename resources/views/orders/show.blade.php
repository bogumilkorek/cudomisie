@extends('layouts.admin')

@section('content')

  <div class="container">

    <h1>
      {{ __('Order no') }} {{ $order->id }}
    </h1>

    <hr>

    <p>
      <b>{{ __('Products') }}:</b><br />
      @component('components.cartItems', [
        'products' => $order->products,
        'shipment' => ['name' => $order->shipping_method_name, 'price' => $order->shipping_cost],
        'total' => $order->total_cost,
      ])
    @endcomponent
    <b>{{ __('Invoice') }}:</b><br /><a href="{{ route('user.orders.invoice', $order->invoice_url) }}" class="btn btn-primary"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> {{ __('Invoice') }}</a><br /><br />
    <b>{{ __('Status') }}:</b><br />{{ $order->orderStatus->title }}<br /><br />
    <b>{{ __('Name') }}:</b><br />{{ $order->name }}<br /><br />
    <b>{{ __('E-mail') }}:</b><br />{{ $order->email }}<br /><br />
    <b>{{ __('Phone') }}:</b><br />{{ $order->phone_number }}<br /><br />
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
