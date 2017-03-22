@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2>{{ __('Pages') }}</h2>
      <hr>
      <div class="row">
        <div class="col-md-4">
          <a href="{{ route('pages.create') }}">
            <button class="btn btn-primary">
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
              {{ __('Add new page') }}
            </button>
          </a>
        </div>
      </div>
      <br />
      <table class="table table-bordered table-hover table-striped">
        <thead>
          <tr>
            <th>{{ __('Title') }}</th>
            <th>{{ __('Content') }}</th>
            <th class="sorting_disabled">{{ __('Edit') }}</th>
            <th class="sorting_disabled">{{ __('Delete') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($pages as $page)
          <tr>
            <td>
              <a href="{{ route('user.pages.show', $page) }}" target="_blank">{{ $page->title }}</a>
            </td>
            <td>{!! str_limit($page->content, 100) !!}</td>
            <td class="text-center actions">
              <a href="{{ route('pages.edit', $page) }}" class="btn btn-success btn-icon">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true" title="{{ __('Edit') }}"></span>
              </a>
            </td>
            <td class="text-center actions">
              <form method="post" action="{{ route('pages.destroy', $page) }}" style="display: inline-block">
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
