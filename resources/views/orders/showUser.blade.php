@extends('layouts.app')

@section('content')

  <div class="panel panel-default">
    <div class="panel-body">

      <h1>
        {{ __('Order no') }} {{ $order->id }}
      </h1>

      <hr>
      <p>
        <b>{{ __('Status') }}:</b><br />{{ $order->orderStatus->title }}<br /><br />
        <b>{{ __('Products') }}:</b><br />
        @component('components.cartItems', [
          'products' => $order->products,
          'shipment' => ['name' => $order->shipping_method_name, 'price' => $order->shipping_cost],
          'total' => $order->total_cost,
          'simpleView' => true,
        ])
      @endcomponent
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
    </p>

    @if(isset(Auth::user()->id))
      <div class="text-center">
        <a href="{{ route('user.orders.index') }}" class="btn btn-dashed">
          <i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> {{ __('Go back') }}
        </a>
        <a href="{{ route('user.orders.invoice', $order->invoice_url) }}" class="btn btn-dashed">
          <i class="fa fa-file-pdf-o" aria-hidden="true"></i> {{ __('Invoice') }}
        </a>
      </div>
    @endif
  </div>
</div>

@endsection
