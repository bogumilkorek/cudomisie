@extends('layouts.app')

@section('content')

<div class="panel panel-default">
  <div class="panel-body">
    <h1>
      {{ __('Place order') }}
    </h1>

    <hr>

    @component('alert', ['errors' => $errors])
    @endcomponent

    @if($items['trashed'])
    @component('components.cartItems', [
    'products' => $items['products'],
    'quantities' => $items['quantities'],
    'total' => $items['total'],
    'input' => false,
    'deleteButtons' => true,
    ])
    @endcomponent
    <div class="alert alert-info">
      <strong>{{ __('Alert!') }}</strong>
      {{ __('order.itemUnavailable') }}
    </div>

    @else
    @component('components.cartItems', [
    'products' => $items['products'],
    'quantities' => $items['quantities'],
    'total' => $items['total'],
    'input' => false
    ])
    @endcomponent
    @if(Auth::user() || !empty($buy_without_login))

    <form method="POST" action="{{ route('user.orders.store') }}">
      {{ csrf_field() }}

      <div class="form-group">
        <h2><i class="fa fa-credit-card" aria-hidden="true"></i> {{ __('Select payment method') }}:</h2>
        <hr>
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input online-payment" type="radio" name="paymentMethodName" value="{{ __('Online payment') }}" required>
            {{ __('Online payment') }} - {{ __('provider commission') }}: {{ env('PRZELEWY24_COMMISSION') }}%
          </label>
        </div>
        
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input bank-payment" type="radio" name="paymentMethodName" value="{{ __('Bank transfer') }}" required>
            {{ __('Bank transfer') }}
          </label>
        </div>

        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="paymentMethodName" value="{{ __('Cash on delivery') }}" required>
            {{ __('Cash on delivery') }}
          </label>
        </div>
      </div>


      <div class="form-group">
        <h2><i class="fa fa-truck" aria-hidden="true"></i> {{ __('Select shipping method') }}:</h2>
        <hr>
        @foreach($shipping_methods as $sMethod)
        <div class="form-check @if($sMethod->cash_on_delivery)cash-on-delivery @else pay-in-advance @endif">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="shippingMethodName" data-price="{{ $sMethod->price }}" value="{{ $sMethod->title }}" required @if($previous_data['shippingMethodName'] == $sMethod->title) checked @endif>
            {{ $sMethod->title }} ({{ $sMethod->price }})
          </label>
        </div>
        @endforeach
      </div>
      <h4>{{ __('Total') }}: <b id="total" data-commission="{{ env('PRZELEWY24_COMMISSION') }}">{{ Request::session()->get('cart.total') ?? '' }}</b></h4>
      <br />

      <h2><i class="fa fa-info-circle" aria-hidden="true"></i> {{ __('Fill in shipping data') }}:</h2>
      <hr>
      <div class="form-group">
        <label for="name">{{ __('Name') }}:</label>
        <input type="text" pattern="[^\s]{3,} [^\s]{3,}" class="form-control" name="name"
        value="{{ $previous_data['name'] ?? old('name', Auth::user()->name ?? '') }}" required autofocus>
      </div>

      <div class="form-group">
        <label for="email">{{ __('E-mail') }}:</label>
        <input type="email" class="form-control" name="email"
        value="{{ $previous_data['email'] ?? old('email', Auth::user()->email ?? '') }}" required>
      </div>

      <div class="form-group">
        <label for="phone_number">{{ __('Phone') }}:</label>
        <input type="text" pattern="((\+|00)[0-9]{2})?[0-9]{9}" class="form-control"
        name="phone_number" title="{{ __('Phone number must be 9 digits') }}."
        value="{{ $previous_data['phone_number'] ?? old('phone_number',  Auth::user()->phone_number ?? '') }}" required>
      </div>

      <div class="form-group">
        <label for="street">{{ __('Street and house number') }}:</label>
        <input type="text" pattern="[^\s]+ [0-9]{1,3}([a-zA-Z])?(\/[0-9]{1,3})?" class="form-control"
        name="street" title="{{ __('Correct form') }}: Rzemieślnicza 18, Rzemieślnicza 18a/3"
        value="{{ $previous_data['street'] ?? old('street',  Auth::user()->street ?? '') }}" required>
      </div>

      <div class="form-group">
        <label for="city">{{ __('Zip code and city') }}:</label>
        <input type="text" pattern="[0-9]{2}-[0-9]{3} [^\s]{3,}" class="form-control"
        name="city" title="{{ __('Correct form') }}: 72-320 Trzebiatów"
        value="{{ $previous_data['city'] ?? old('city', Auth::user()->city ?? '') }}" required>
      </div>

      <div class="form-group">
        <label for="comments">{{ __('Comments') }}:</label>
        <textarea class="form-control" name="comments" rows="5">
          {{ $previous_data['comments'] ?? old('comments') }}
        </textarea>
      </div>

      <div class="form-group">
        <div class="checkbox">
          <label><input type="checkbox" name="accept-terms" value="1" required @if($previous_data['accept-terms'] == 1) checked @endif>{{ __('I accept') }} <a href="{{ route('user.pages.show', str_slug(__('Terms of use'))) }}" target="_blank">{{ __('company policy') }}</a></label>
        </div>
      </div>

      <div class="form-group">
        <div class="checkbox">
          <label><input type="checkbox" name="accept-usage" value="1" required @if($previous_data['accept-usage'] == 1) checked @endif>{{ __('I hereby give consent for my personal data to be used by :company.', ['company' => env('SELLER_COMPANY')]) }}<br />
            {{ __('This data will be used under the Personal Data Protection Act as of 29 August 1997, consolidated text: Journal of Laws 2016, item 922 as amended.') }}<br />
            {{ __('This data will be processed for the purposes of the order process and contact with buyer only by :company.', ['company' => env('SELLER_COMPANY')]) }}</label>
          </div>
        </div>

        <br />

        <div class="text-center">

          <button type="submit" class="btn btn-dashed" id="submit"
          data-loading-text="<i class='fa fa-refresh fa-spin'></i>
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
    @endif
  </div>
</div>


@endsection
