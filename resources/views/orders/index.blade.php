@extends('layouts.admin')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2>{{ __('Orders') }}</h2>
        <hr>
        <table class="table table-bordered table-hover table-striped" id="table">
          <thead>
            <tr>
              <th>#</th>
              <th>{{ __('No.') }}</th>
              <th>{{ __('Products') }}</th>
              <th>{{ __('Status') }}</th>
              <th>{{ __('Shipping method') }}</th>
              <th>{{ __('Total') }}</th>
              <th>{{ __('Comments') }}</th>
              <th class="sorting_disabled">{{ __('Show') }}</th>
              <th class="sorting_disabled">{{ __('Invoice') }}</th>
              <th class="sorting_disabled">{{ __('Edit') }}</th>
              <th class="sorting_disabled">{{ __('Delete') }}</th>
            </tr>
          </thead>
          <tbody>
            @foreach($orders as $index => $order)
              <tr>
                <td>
                  {{ ++$index }}
                </td>
                <td>{{ $order->id }}</td>
                <td width="400">
                  @foreach($order->products as $product)
                    {{ $product->pivot->product_title }} <!--- {{ $product->pivot->product_quantity }} {{ __('pcs.') }}--><br />
                  @endforeach
                </td>
                <td>
                  <select class="selectpicker show-tick">
                    @foreach($order_statuses as $orderStatus)
                      <option value="{{ $orderStatus->id }}" data-order="{{ $order->uuid }}"
                        @if($orderStatus->title == $order->orderStatus->title) selected @endif >
                          {{ $orderStatus->title }}
                        </option>
                      @endforeach

                    </td>
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
                      <a href="{{ route('orders.show', $order) }}" class="btn btn-primary btn-icon">
                        <span class="glyphicon glyphicon-info-sign" aria-hidden="true" title="{{ __('Show') }}"></span>
                      </a>
                    </td>
                    <td class="text-center actions">
                      <a href="{{ route('user.orders.invoice', $order->invoice_url) }}" class="btn btn-primary btn-icon">
                        <span class="glyphicon glyphicon-save-file" aria-hidden="true" title="{{ __('Show') }}"></span>
                      </a>
                    </td>
                    <td class="text-center actions">
                      <a href="{{ route('orders.edit', $order) }}" class="btn btn-success btn-icon">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true" title="{{ __('Edit') }}"></span>
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

    @push('scripts')
      <script>
      $(".selectpicker").selectpicker();
      $('.selectpicker').on('change', function () {
        let $this = $(this);
        $this.attr("disabled", true);
        $('.selectpicker').selectpicker('refresh');
        let uuid = $(this).find('option:selected').data('order');
        let order_status_id =  $(this).find('option:selected').val();
        $.ajax({
          method: "POST",
          url: "orders/" + uuid + "/updateStatus",
          data: { uuid: uuid, order_status_id: order_status_id }
        })
        .done(function() {
          swal('{{ __("Success") }}', '{{ __("Order status updated") }}', 'success');
          $this.removeAttr("disabled");
          $('.selectpicker').selectpicker('refresh');
        });
      });
      </script>
    @endpush

  @endsection
