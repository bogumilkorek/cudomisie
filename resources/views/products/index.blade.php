@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2>{{ __('Products') }}</h2>
      <hr>
      <div class="row">
        <div class="col-md-4">
          <a href="{{ route('products.create') }}">
            <button class="btn btn-primary">
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
              {{ __('Add new product') }}
            </button>
          </a>
        </div>
      </div>
      <br />
      <table class="table table-bordered table-hover table-striped">
        <thead>
          <tr>
            <th>{{ __('Title') }}</th>
            <th>{{ __('Description') }}</th>
            <th>{{ __('Categories') }}</th>
            <th>{{ __('Price') }}</th>
            <th>{{ __('Dimensions') }}</th>
            <th class="sorting_disabled">{{ __('Edit') }}</th>
            <th class="sorting_disabled">{{ __('Delete') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($products as $product)
          <tr>
            <td>
              <a href="{{ route('user.products.show', [$product->categories->first(), $product]) }}" target="_blank">
                {{ $product->title }}
              </a>
            </td>
            <td>{!! str_limit($product->description, 100) !!}</td>
            <td>
              @foreach($product->categories as $category)
                {{ $category->title }}<br />
              @endforeach
            </td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->dimensions }}</td>
            <td class="text-center actions">
              <a href="{{ route('products.edit', $product) }}" class="btn btn-success btn-icon">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true" title="{{ __('Edit') }}"></span>
              </a>
            </td>
            <td class="text-center actions">
              <form method="post" action="{{ route('products.destroy', $product) }}" style="display: inline-block">
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