@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2>{{ __('Shipping methods') }}</h2>
      <hr>
      <div class="row">
        <div class="col-md-4">
          <a href="{{ route('shippingMethods.create') }}">
            <button class="btn btn-primary">
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
              {{ __('Add new shipping method') }}
            </button>
          </a>
        </div>
      </div>
      <br />
      <table class="table table-bordered table-hover table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>{{ __('Title') }}</th>
            <th>{{ __('Price') }}</th>
            <th>{{ __('Cash on delivery') }}</th>
            <th>{{ __('High capacity') }}</th>
            <th class="sorting_disabled">{{ __('Edit') }}</th>
            <th class="sorting_disabled">{{ __('Delete') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($shipping_methods as $index => $shippingMethod)
          <tr>
            <td>{{ ++$index }}</td>
            <td>
                {{ $shippingMethod->title }}
            </td>
            <td>
                {{ $shippingMethod->price }}
            </td>
            <td>
                @if($shippingMethod->cash_on_delivery)
                  <span class="label label-success" style="font-size: 16px">{{ __('Yes') }}</span>
                @else
                  <span class="label label-danger" style="font-size: 16px">{{ __('No') }}</span>
                @endif
            </td>
            <td>
                @if($shippingMethod->high_capacity)
                  <span class="label label-success" style="font-size: 16px">{{ __('Yes') }}</span>
                @else
                  <span class="label label-danger" style="font-size: 16px">{{ __('No') }}</span>
                @endif
            </td>
            <td class="text-center actions">
              <a href="{{ route('shippingMethods.edit', $shippingMethod) }}" class="btn btn-success btn-icon">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true" title="{{ __('Edit') }}"></span>
              </a>
            </td>
            <td class="text-center actions">
              <form method="post" action="{{ route('shippingMethods.destroy', $shippingMethod) }}" style="display: inline-block">
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
@endsection
