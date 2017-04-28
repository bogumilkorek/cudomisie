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
  <label for="cash_on_delivery">{{ __('Cash on delivery') }}</label><br />
  <select name="cash_on_delivery" id="cash_on_delivery" class="selectpicker show-tick">
    <option value="0">
      {{ __('No') }}</option>
      <option value="1" {{ !empty($shipping_method->cash_on_delivery) && $shipping_method->cash_on_delivery == 1 ? 'selected' : '' }}>
        {{ __('Yes') }}</option>
      </select>
    </div>

    <br />

    <div class="form-group">
      <label for="high_capacity">{{ __('High capacity') }}</label><br />
      <select name="high_capacity" id="high_capacity" class="selectpicker show-tick">
        <option value="0">
          {{ __('No') }}</option>
          <option value="1" {{ !empty($shipping_method->high_capacity) && $shipping_method->high_capacity == 1 ? 'selected' : '' }}>
            {{ __('Yes') }}</option>
          </select>
        </div>

        <br />
