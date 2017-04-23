<div class="form-group">
  <label for="title">{{ __('Title') }}</label>
  <input type="text" class="form-control" name="title"
  value="{{ old('title',  isset($product) ? $product->title : null) }}" required autofocus>
</div>

<div class="form-group">
  <label for="categories">{{ __('Categories') }}</label>
  <br />
  <select name="categories[]" id="categories" class="selectpicker" data-width="fit" title="{{ __('Nope') }}" multiple required>
    @foreach($categories as $category)
      <optgroup label="{{ $category->title }}">
      @foreach($category->children as $child)
      <option value="{{ $child->id }}"
        @if(old('categories') && in_array($child->id, old('categories'))) selected @endif >
        {{ $child->title }}
      </option>
    @endforeach
    </optgroup>
    @endforeach
  </select>
</div>

<div class="form-group">
  <label for="description">{{ __('Content') }}</label>
  <textarea class="form-control editor" id="description" name="description">
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
  <input type="text" class="form-control" name="dimensions"
  value="{{ old('dimensions',  isset($product) ? $product->dimensions : null) }}" required>
</div>

<div class="form-group">
  <label for="shipping_methods">{{ __('Shipping methods') }}</label>
  <br />
  <select name="shipping_methods[]" id="shipping_methods" class="selectpicker-shipping" data-width="fit" title="{{ __('Nope') }}" multiple required>
    @foreach($shipping_methods as $sMethod)
        <option value="{{ $sMethod->id }}"
        @if(old('shipping_methods'))
          @if(in_array($sMethod->id, old('shipping_methods')))
          selected
          @endif
          @else
          selected
        @endif >
        {{ $sMethod->title }}
      </option>
    @endforeach
  </select>
</div>
<br />
