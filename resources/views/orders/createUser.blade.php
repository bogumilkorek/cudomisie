@extends('layouts.app')

@section('content')

<div class="panel panel-default">
  <div class="panel-body">

    <h1>
      <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
      {{ __('Place order') }}
    </h1>

    <hr>

    @component('alert', ['errors' => $errors])
    @endcomponent

    @if(Auth::user() || !empty($buy_without_login))

    @component('components.cartItems', [
    'products' => $items['products'],
    'quantities' => $items['quantities'],
    'total' => $items['total'],
    'input' => false
    ])
    @endcomponent

    <form method="POST" action="{{ route('user.orders.store') }}">
      {{ csrf_field() }}

      <div class="form-group">
        <h2><i class="fa fa-truck" aria-hidden="true"></i> {{ __('Select shipping method') }}:</h2>
        <hr>
        @foreach($shipping_methods as $sMethod)
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="shippingMethodName" data-price="{{ $sMethod->price }}" id="shippingMethodName" value="{{ $sMethod->title }}" required>
            {{ $sMethod->title }} ({{ $sMethod->price }})
          </label>
        </div>
        @endforeach
      </div>
      <h4>{{ __('Total') }}: <b id="total">{{ Request::session()->get('cart.total') ?? '' }}</b></h4>
      <br />

      <h2><i class="fa fa-info-circle" aria-hidden="true"></i> {{ __('Fill in shipping data') }}:</h2>
      <hr>
      <div class="form-group">
        <label for="name">{{ __('Name') }}:</label>
        <input type="text" pattern="[^\s]{3,} [^\s]{3,}" class="form-control" name="name"
        value="{{ old('name', Auth::user()->name ?? '') }}" required autofocus>
      </div>

      <div class="form-group">
        <label for="email">{{ __('E-mail') }}:</label>
        <input type="email" class="form-control" name="email"
        value="{{ old('email', Auth::user()->email ?? '') }}" required>
      </div>

      <div class="form-group">
        <label for="phone">{{ __('Phone') }}:</label>
        <input type="text" pattern="((\+|00)[0-9]{2})?[0-9]{9}" class="form-control"
        name="phone" title="{{ __('Phone number must be 9 digits') }}."
        value="{{ old('phone',  Auth::user()->phone ?? '') }}" required>
      </div>

      <div class="form-group">
        <label for="street">{{ __('Street and house number') }}:</label>
        <input type="text" pattern="[^\s]+ [0-9]{1,3}([a-zA-Z])?(\/[0-9]{1,3})?" class="form-control"
        name="street" title="{{ __('Correct form') }}: Rzemieślnicza 18, Rzemieślnicza 18a/3"
        value="{{ old('street',  Auth::user()->street ?? '') }}" required>
      </div>

      <div class="form-group">
        <label for="city">{{ __('Zip code and city') }}:</label>
        <input type="text" pattern="[0-9]{2}-[0-9]{3} [^\s]{3,}" class="form-control"
        name="city" title="{{ __('Correct form') }}: 72-320 Trzebiatów"
        value="{{ old('city', Auth::user()->city ?? '') }}" required>
      </div>

      <div class="form-group">
        <label for="comments">{{ __('Comments') }}:</label>
        <textarea class="form-control" name="comments" rows="5">
          {{ old('comments') }}
        </textarea>
      </div>


      <div class="text-center">

        <button type="submit" class="btn btn-dashed" id="submit"
        data-loading-text="<i class='fa fa-cog fa-spin'></i>
        {{ __('Loading') }}">
        <i class="fa fa-cart-arrow-down" aria-hidden="true"></i> {{ __('Place order') }}
      </button>

      <a href="{{ route('user.products.index') }}" class="btn btn-dashed">
        <i class="fa fa-shopping-bag" aria-hidden="true"></i> {{ __('Continue shopping') }}
      </a>

      <a href="#" class="btn btn-dashed cart-clear">
        <i class="fa fa-times" aria-hidden="true"></i> {{ __('Clear cart') }}
      </a>

    </div>
  </form>
  @else
  <div class="text-center">
    <a href="{{ route('login') }}" class="btn btn-dashed">
      <i class="fa fa-check" aria-hidden="true"></i> {{ __('Login') }}
    </a>

    <a href="{{ route('register') }}" class="btn btn-dashed">
      <i class="fa fa-user" aria-hidden="true"></i> {{ __('Register') }}
    </a>

    <a href="{{ route('user.orders.create') }}?noaccount=1" class="btn btn-dashed">
      <i class="fa fa-cart-arrow-down" aria-hidden="true"></i> {{ __('Buy without creating account') }}
    </a>

    @include('layouts.partials.socialAuth')

  </div>
  @endif

</div>
</div>


@endsection
