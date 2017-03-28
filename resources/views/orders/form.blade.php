<div class="form-group">
  <label for="title">{{ __('Title') }}</label>
  <input type="text" class="form-control" name="title"
  value="{{ old('title',  isset($page) ? $page->title : null) }}" required autofocus>
</div>

<div class="form-group">
  <label for="content">{{ __('Content') }}</label>
  <textarea class="form-control" id="content" name="content">
    {{ old('content',  isset($page) ? $page->content : null) }}
  </textarea>
</div>
