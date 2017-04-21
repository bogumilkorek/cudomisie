@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2>{{ __('Categories') }}</h2>
      <hr>
      <div class="row">
        <div class="col-md-4">
          <a href="{{ route('categories.create') }}">
            <button class="btn btn-primary">
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
              {{ __('Add new category') }}
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
            <th>{{ __('Parent') }}</th>
            <th>{{ __('Products') }}</th>
            <th>{{ __('Visible') }}</th>
            <th class="sorting_disabled">{{ __('Edit') }}</th>
            <th class="sorting_disabled">{{ __('Delete') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($categories as $index => $category)
          <tr>
            <td>{{ ++$index }}</td>
            <td>
              <a href="{{ route('user.categories.show', $category) }}" target="_blank">
                {{ $category->title }}
              </a>
            </td>
            <td>
              @if(!empty($category->parent))
                {{ $category->parent->title }}
              @else
                {{ __('Nope') }}
              @endif
            </td>
            <td>
              @forelse($category->products as $product)
                {{ $product->title }}<br />
              @empty
                {{ __('Nope') }}
              @endforelse
            </td>
            <td>
              @if($category->deleted_at)
              <span class="label label-danger" style="font-size: 16px">{{ __('No') }}</span>
              @else
              <span class="label label-success" style="font-size: 16px">{{ __('Yes') }}</span>
              @endif
            </td>
            <td class="text-center actions">
              <a href="{{ route('categories.edit', $category) }}" class="btn btn-success btn-icon">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true" title="{{ __('Edit') }}"></span>
              </a>
            </td>
            <td class="text-center actions">
              @if($category->deleted_at)
              <form method="post" action="{{ route('categories.restore', $category) }}" style="display: inline-block">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-warning btn-icon">
                  <span class="glyphicon glyphicon-repeat" aria-hidden="true" title="{{ __('Restore') }}"></span>
                </button>
              </form>
              @else
              <form method="post" action="{{ route('categories.destroy', $category) }}" style="display: inline-block">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-icon btn-delete"
                        data-swal-title="{{ __('Are you sure?') }}"
                        data-swal-confirm="{{ __('Yes') }}"
                        data-swal-cancel="{{ __('Cancel') }}">
                  <span class="glyphicon glyphicon-trash" aria-hidden="true" title="{{ __('Delete') }}"></span>
                </button>
              </form>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
