<div class="form-group">
  <label for="title">{{ __('Title') }}</label>
  <input type="text" class="form-control" name="title"
  value="{{ old('title',  isset($product) ? $product->title : null) }}" required autofocus>
</div>

<div class="form-group">
  <label for="categories">{{ __('Categories') }}</label>
  <select name="categories[]" id="categories" multiple required>
    @foreach($categories as $category)
      <option value="{{ $category->id }}"
        @if(old('categories') && in_array($category->id, old('categories'))) selected @endif >
        {{ $category->title }}
      </option>
    @endforeach
  </select>
</div>

<div class="form-group">
  <label for="description">{{ __('Content') }}</label>
  <textarea class="form-control" id="description" name="description">
    {{ old('description',  isset($product) ? $product->description : null) }}
  </textarea>
</div>

<div class="form-group">
  <label for="price">{{ __('Price') }}</label>
  <input type="text" class="form-control" pattern="[0-9]{1,3}\.[0-9]{2} .{1,3}" name="price"
  value="{{ old('price',  isset($product) ? $product->price : null) }}" title="{{ __('Correct form') }}: 99.90 {{  __('$') }}" required>
</div>

<div class="form-group">
  <label for="dimensions">{{ __('Dimensions') }}</label>
  <input type="text" class="form-control" pattern="[0-9]{1,3}x[0-9]{1,3} [a-z]{2}" name="dimensions"
  value="{{ old('dimensions',  isset($product) ? $product->dimensions : null) }}" title="{{ __('Correct form') }}: 25x60 cm" required>
</div>
