<div class="form-group">
  <label for="title">{{ __('Title') }}</label>
  <input type="text" class="form-control" name="title"
  value="{{ old('title',  isset($shipping_method) ? $shipping_method->title : null) }}" required autofocus>
</div>

<div class="form-group">
  <label for="price">{{ __('Price') }}</label>
  <input type="text" class="form-control" pattern="[0-9]{1,3}\.[0-9]{2} .{1,3}" name="price"
  value="{{ old('price',  isset($shipping_method) ? $shipping_method->price : null) }}" title="{{ __('Correct form') }}: 99.90 {{  __('$') }}" required>
</div>
<div class="form-group">
  <label for="price">{{ __('Cash on delivery') }}</label>
  <input type="text" class="form-control" pattern="[0-9]{1,3}\.[0-9]{2} .{1,3}" name="cash_on_delivery"
  value="{{ old('cash_on_delivery',  isset($shipping_method) ? $shipping_method->cash_on_delivery : null) }}" title="{{ __('Correct form') }}: 99.90 {{  __('$') }}" required>
</div>
