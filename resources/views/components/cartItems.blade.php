<table class="table table-hover table-striped">
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
          <td>
            <a href="#" class="btn btn-danger btn-white cart-remove" data-slug="{{ $product->slug }}">
            <span class="glyphicon glyphicon-trash" aria-hidden="true" title="{{ __('Delete') }}"></span>
            </a>
          </td>
        @endif
      </tr>
    @endforeach
  </tbody>
</table>
<b>{{ __('Total') }}: {{ $total }}</b>
<br /><br />
