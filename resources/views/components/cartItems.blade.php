<table class="table table-hover table-bordered table-striped">
  <thead>
    <tr>
      <th>{{ __('Title') }}</th>
      <th>{{ __('Quantity') }}</th>
      <th>{{ __('Price') }}</th>
      @if(!empty($deleteButtons))
        <th>{{ __('Delete') }}</th>
      @endif
    </tr>
  </thead>
  <tbody>
    @foreach($products as $product)
      <tr>
        <td>{{ $product->title }}</td>
        <td>{{ $quantities[$product->slug] }} {{ __('pcs.') }}</td>
        <td>{{ $product->price }}</td>
        @if(!empty($deleteButtons))
          <td class="text-center actions">
            <a href="#" class="btn btn-dashed cart-remove" data-slug="{{ $product->slug }}">
            <i class="fa fa-trash-o" aria-hidden="true" title="{{ __('Delete') }}"></i>
            </a>
          </td>
        @endif
      </tr>
    @endforeach
  </tbody>
</table>
<b>{{ __('Total') }}: {{ $total }}</b>
<br /><br />
