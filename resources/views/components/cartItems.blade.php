<table class="table table-hover table-bordered table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>{{ __('Product') }}</th>
      <th>{{ __('Price') }}</th>
      <th>{{ __('Quantity') }}</th>
      <th>{{ __('Subtotal') }}</th>
      @if(!empty($deleteButtons))
        <th>{{ __('Delete') }}</th>
      @endif
    </tr>
  </thead>
  <tfoot>
   <tr>
     <td></td>
     <td></td>
     <td></td>
     <td><b>{{ __('Total') }}</b></td>
     <td><b>{{ $total }}</b></td>
     @if(!empty($deleteButtons))
       <td></td>
     @endif
   </tr>
  <tbody>
    @foreach($products as $index => $product)
      <tr>
        <td>{{ ++$index }}</td>
        <td><a href="{{ route('user.products.show', [$product->categories->first(), $product]) }}" target="_blank"><img src="{{ $product->images->first()->thumbnail_url }}" style="width: 150px"> {{ $product->title }}</a></td>
        <td style="vertical-align: middle">{{ $product->price }}</td>
        <td style="vertical-align: middle">
          @if(!empty($input))
            <input type="number" min="1" max="9" name="cart-item-quantity" class="form-control text-center cart-item-quantity"
            style="width: 60px" value="{{ $quantities[$product->slug] }}" data-slug="{{ $product->slug }}">
          @else
            {{ $quantities[$product->slug] }} {{ __('pcs.') }}
          @endif
        </td>
        <td style="vertical-align: middle">{{ floatVal($product->price) * $quantities[$product->slug] . ' ' . __('$') }}</td>
        @if(!empty($deleteButtons))
          <td class="text-center actions" style="vertical-align: middle">
            <a href="#" class="btn btn-dashed cart-remove" data-slug="{{ $product->slug }}">
            <i class="fa fa-trash-o" aria-hidden="true" title="{{ __('Delete') }}"></i>
            </a>
          </td>
        @endif
      </tr>
    @endforeach
  </tbody>
</table>
<br />
