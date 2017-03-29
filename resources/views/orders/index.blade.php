@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2>{{ __('Orders') }}</h2>
      <hr>
      <!-- <div class="row">
        <div class="col-md-4">
          <a href="{{ route('orders.create') }}">
            <button class="btn btn-primary">
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
              {{ __('Add new order') }}
            </button>
          </a>
        </div>
      </div>
      <br /> -->
      <table class="table table-bordered table-hover table-striped">
        <thead>
          <tr>
            <th>{{ __('Id') }}</th>
            <th>{{ __('Products') }}</th>
            <th>{{ __('Status') }}</th>
            <th>{{ __('Shipping method') }}</th>
            <th>{{ __('Total cost') }}</th>
            <th>{{ __('Comments') }}</th>
            <th>{{ __('Date') }}</th>
            <th class="sorting_disabled">{{ __('Show') }}</th>
            <th class="sorting_disabled">{{ __('Delete') }}</th>
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
            <td>
              @foreach($order->products as $product)
                {{ $product->title }}<br />
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
            <td width="135">{{ $order->created_at }}</td>
            <td class="text-center actions">
              <a href="{{ route('orders.show', $order) }}" class="btn btn-success btn-icon">
                <span class="glyphicon glyphicon-info-sign" aria-hidden="true" title="{{ __('Show') }}"></span>
              </a>
            </td>
            <td class="text-center actions">
              <form method="post" action="{{ route('orders.destroy', $order) }}" style="display: inline-block">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-icon btn-delete"
                        data-swal-title="{{ __('Are you sure?') }}"
                        data-swal-confirm="{{ __('Yes') }}"
                        data-swal-cancel="{{ __('Cancel') }}">
                  <span class="glyphicon glyphicon-trash" aria-hidden="true" title="{{ __('Delete') }}"></span>
                </button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
