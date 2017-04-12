@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2>{{ __('Orders') }}</h2>
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
                <th class="sorting_disabled">{{ __('Show') }}</th>
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
                      {{ $product->pivot->product_title }} - {{ $product->pivot->product_quantity }} {{ __('pcs.') }}<br />
                    @endforeach
                  </td>
                  <td>{{ $order->orderStatus->title }}</td>
                  <td>{{ $order->shippingMethod->title }} ({{ $order->shipping_cost }})</td>
                  <td>{{ $order->total_cost }}</td>
                  <td>
                    @if($order->comments)
                      {{ $order->comments }}
                    @else
                      {{ __('Nope') }}
                    @endif
                  </td>
                  <td class="text-center actions">
                    <a href="{{ route('orders.show', $order) }}" class="btn btn-success btn-icon">
                      <span class="glyphicon glyphicon-info-sign" aria-hidden="true" title="{{ __('Show') }}"></span>
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
  </div>
@endsection
