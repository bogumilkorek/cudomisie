<div class="form-group">
  <label for="title">{{ __('Title') }}</label>
  <input type="text" class="form-control" name="title"
  value="{{ old('title',  isset($category) ? $category->title : null) }}" required autofocus>
</div>

<div class="form-group">
  <label for="parent_id">{{ __('Parent') }}</label>
  <select name="parent_id" id="parent_id">
    <option value="">{{ __('Nope') }}</option>
    @foreach($children as $child)
      <option value="{{ $child->id }}"
        @if(!empty($category->parent->id) && $category->parent->id == $child->id) selected @endif >
        {{ $child->title }}
      </option>
    @endforeach
  </select>
</div>
