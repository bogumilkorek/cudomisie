<div class="form-group">
  <label for="title">{{ __('Title') }}</label>
  <input type="text" class="form-control" name="title"
  value="{{ old('title',  isset($shipping_method) ? $shipping_method->title : null) }}" required autofocus>
</div>
