<div class="form-group">
  <label for="title">{{ __('Title') }}</label>
  <input type="text" class="form-control" name="title"
  value="{{ old('title',  isset($blog_post) ? $blog_post->title : null) }}" required autofocus>
</div>

<div class="form-group">
  <label for="content">{{ __('Content') }}</label>
  <textarea class="form-control editor" id="content" name="content">
    {{ old('content',  isset($blog_post) ? $blog_post->content : null) }}
  </textarea>
</div>
