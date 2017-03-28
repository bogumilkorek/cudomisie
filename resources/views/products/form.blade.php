<div class="form-group">
  <label for="title">{{ __('Title') }}</label>
  <input type="text" class="form-control" name="title"
  value="{{ old('title',  isset($product) ? $product->title : null) }}" required autofocus>
</div>

<div class="form-group">
  <label for="description">{{ __('Content') }}</label>
  <textarea class="form-control" id="description" name="description">
    {{ old('description',  isset($product) ? $product->description : null) }}
  </textarea>
</div>

<div class="form-group">
  <label for="price">{{ __('Price') }}</label>
  <input type="text" class="form-control" pattern="[0-9]{1-3}\.[0-9]{2}" name="price"
  value="{{ old('price',  isset($product) ? $product->price : null) }}" title="{{ __('Correct form') }}: 99.90" required>
</div>

<div class="form-group">
  <label for="dimensions">{{ __('Dimensions') }}</label>
  <input type="text" class="form-control" pattern="[0-9]{1,3}x[0-9]{1,3}" name="dimensions"
  value="{{ old('dimensions',  isset($product) ? $product->dimensions : null) }}" title="{{ __('Correct form') }}: 25x60" required>
</div>
