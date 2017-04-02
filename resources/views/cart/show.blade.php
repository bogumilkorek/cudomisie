@extends('layouts.app')

@section('content')

  <h1>
    <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
    {{ __('Cart') }}
  </h1>

  <hr>
  <div class="panel panel-default">
     <div class="panel-body">
       <table class="table table-bordered table-hover table-striped">
         <thead>
           <tr>
             <th>{{ __('Title') }}</th>
             <th>{{ __('Quantity') }}</th>
             <th>{{ __('Price') }}</th>
             <th class="sorting_disabled">{{ __('Delete') }}</th>
           </tr>
         </thead>
         <tbody>
      @forelse($products as $product)
      <tr>
        <td>{{ $product->title }}</td>
        <td>{{ $quantities[$product->slug] }} {{ __('pcs.') }}</td>
        <td>{{ $product->price }}</td>
        <td><a href="#" class="btn btn-danger btn-icon cart-remove" data-slug="{{ $product->slug }}">
          <span class="glyphicon glyphicon-trash" aria-hidden="true" title="{{ __('Delete') }}"></span>
        </a></td>
      </tr>
      @empty
        <h3> {{ __('No data') }} </h3>
      @endforelse
    </tbody>
  </table>
      <b>{{ __('Total') }}: {{ $total }} {{ __('$') }}</b>
    </div>
  </div>

@endsection
