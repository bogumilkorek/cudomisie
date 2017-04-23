@extends('layouts.app')

@section('content')
  <div class="panel panel-default">
    <div class="panel-body">
      <h1>
        <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
        {{ __('Orders') }}
      </h1>
      <hr>

      @if(!$orders->isEmpty())
        <table class="table table-bordered table-hover table-striped">
          <thead>
            <tr>
              <th>{{ __('Id') }}</th>
              <th>{{ __('Products') }}</th>
              <th>{{ __('Status') }}</th>
              <th>{{ __('Shipping method') }}</th>
              <th>{{ __('Total') }}</th>
              <th>{{ __('Comments') }}</th>
              <th>{{ __('Invoice') }}</th>
              <th>{{ __('Show') }}</th>
            </tr>
          </thead>
          <tbody>
            @foreach($orders as $order)
              <tr>
                <td>
                  <a href="{{ route('orders.show', $order) }}" target="_blank">
                    {{ $order->id }}
                  </a>
                </td>
                <td width="400">
                  @foreach($order->products as $product)
                    {{ $product->pivot->product_title }} <!--- {{ $product->pivot->product_quantity }} {{ __('pcs.') }}--><br />
                  @endforeach
                </td>
                <td>{{ $order->orderStatus->title }}</td>
                <td>{{ $order->shipping_method_name }} ({{ $order->shipping_cost }})</td>
                <td>{{ $order->total_cost }}</td>
                <td>
                  @if($order->comments)
                    {{ $order->comments }}
                  @else
                    {{ __('Nope') }}
                  @endif
                </td>
                <td class="text-center actions">
                  <a href="{{ route('user.orders.invoice', $order->invoice_url) }}" class="btn btn-dashed">
                    <i class="fa fa-file-pdf-o" aria-hidden="true" title="{{ __('Show') }}"></i>
                  </a>
                </td>
                <td class="text-center actions">
                  <a href="{{ route('user.orders.show', $order) }}" class="btn btn-dashed">
                    <i class="fa fa-info-circle" aria-hidden="true" title="{{ __('Show') }}"></i>
                  </a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @else
        <h2>{{ __('No data') }}</h2>
      @endif
    </div>
  </div>
@endsection
