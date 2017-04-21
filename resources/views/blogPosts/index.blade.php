@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2>{{ __('Blog posts') }}</h2>
      <hr>
      <div class="row">
        <div class="col-md-4">
          <a href="{{ route('blogPosts.create') }}">
            <button class="btn btn-primary">
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
              {{ __('Add new blog post') }}
            </button>
          </a>
        </div>
      </div>
      <br />
      <table class="table table-bordered table-hover table-striped" id="table">
        <thead>
          <tr>
            <th>#</th>
            <th>{{ __('Title') }}</th>
            <th>{{ __('Content') }}</th>
            <th class="sorting_disabled">{{ __('Edit') }}</th>
            <th class="sorting_disabled">{{ __('Delete') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($blog_posts as $index => $blogPost)
          <tr>
            <td>{{ ++$index }}</td>
            <td>
              <a href="{{ route('user.blogPosts.show', $blogPost) }}" target="_blank">
                {{ $blogPost->title }}
              </a>
            </td>
            <td>{!! str_limit($blogPost->content, 100) !!}</td>
            <td class="text-center actions">
              <a href="{{ route('blogPosts.edit', $blogPost) }}" class="btn btn-success btn-icon">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true" title="{{ __('Edit') }}"></span>
              </a>
            </td>
            <td class="text-center actions">
              <form method="post" action="{{ route('blogPosts.destroy', $blogPost) }}" style="display: inline-block">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-icon btn-delete"
                        data-swal-title="{{ __('Are you sure?') }}"
                        data-swal-confirm="{{ __('Yes') }}"
                        data-swal-cancel="{{ __('Cancel') }}">
                  <span class="glyphicon glyphicon-trash" aria-hidden="true" title="{{ __('Delete') }}"></span>
                </button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
