@extends('layouts.app')

@section('content')

  <h1>
    <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
    {{ __('Cart') }}
  </h1>

  <hr>
  <div class="panel panel-default">
     <div class="panel-body">
       @if($products->isEmpty())
         <h3> {{ __('No data') }}</h3>
         <hr>
         <div class="text-center">
           <a href="{{ route('user.products.index') }}" class="btn btn-white btn-primary">
             <i class="fa fa-shopping-bag" aria-hidden="true"></i> {{ __('Continue shopping') }}
           </a>
         </div>
       @else
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
      @foreach($products as $product)
        <tr>
          <td>{{ $product->title }}</td>
          <td>{{ $quantities[$product->slug] }} {{ __('pcs.') }}</td>
          <td>{{ $product->price }}</td>
          <td class="text-center"><a href="#" class="btn btn-danger btn-white cart-remove" data-slug="{{ $product->slug }}">
            <span class="glyphicon glyphicon-trash" aria-hidden="true" title="{{ __('Delete') }}"></span>
          </a></td>
        </tr>
    @endforeach
    </tbody>
  </table>
      <b>{{ __('Total') }}: {{ $total }} {{ __('$') }}</b>
      <br /><br />
      <div class="text-center">
      <a href="{{ route('user.orders.create') }}" class="btn btn-white btn-success">
        <i class="fa fa-cart-arrow-down" aria-hidden="true"></i> {{ __('Place order') }}
      </a>

      <a href="{{ route('user.products.index') }}" class="btn btn-white btn-primary">
        <i class="fa fa-shopping-bag" aria-hidden="true"></i> {{ __('Continue shopping') }}
      </a>

      <a href="#" class="btn btn-white  btn-danger cart-clear">
        <i class="fa fa-times" aria-hidden="true"></i> {{ __('Clear cart') }}
      </a>

    </div>
    </div>
  @endif
  </div>

@endsection
