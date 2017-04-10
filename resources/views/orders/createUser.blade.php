@extends('layouts.app')

@section('content')

<h1>
  <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
  {{ __('Place order') }}
</h1>

<hr>

<div class="panel panel-default">
  <div class="panel-body">

    @component('components.cartItems', [
      'products' => $items['products'],
      'quantities' => $items['quantities'],
      'total' => $items['total'],
    ])
    @endcomponent

    <form method="POST" action="{{ route('user.orders.store') }}">
      {{ csrf_field() }}

      @include('orders.form')

      <button type="submit" class="btn btn-primary"
        data-loading-text="<i class='fa fa-cog fa-spin'></i>
        {{ __('Loading') }}">{{ __('Save') }}
      </button>
      <a href="{{ url()->previous() }}" class="btn btn-default">{{ __('Cancel') }}</a>
    </form>

</div>
</div>


@endsection
