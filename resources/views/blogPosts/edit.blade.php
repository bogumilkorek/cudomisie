@extends('layouts.admin')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1>{{ __('Edit blog post') }}</h1>
      <hr>

      @component('alert', ['errors' => $errors])
      @endcomponent

      <form method="POST" action="{{ route('blogPosts.update', $blog_post) }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        @include('blogPosts.form')

        <input type="hidden" name="id" value="{{ $blog_post->id }}" />

        <button type="submit" class="btn btn-primary"
          data-loading-text="<i class='fa fa-cog fa-spin'></i> {{ __('Loading') }}">
          {{ __('Save') }}
        </button>
        <a href="{{ url()->previous() }}" class="btn btn-default">{{ __('Cancel') }}</a>
      </form>

    </div>
  </div>

  @include('layouts.partials.admin.dropzone')

</div>

@include('layouts.partials.admin.wysiwyg')

@endsection
