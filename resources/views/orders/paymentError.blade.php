@extends('layouts.app')

@section('content')

  <div class="panel panel-default">
    <div class="panel-body">
      <h1>
        {{ __('Error') }}!
      </h1>

      <hr>

      <p>
        <b>{{ __('There was a problem processing your payment') }}.</b><br /><br />
        
        {{ __('Please contact us via phone: :phone, or e-mail: :email', ['phone' => env('SELLER_PHONE'), 'email' => env('MAIL_FROM_ADDRESS')]) }}.<br /><br />
        <b>{{ __('Order number: :id.', ['id' => $id]) }}</b>
      </p>

    </div>
  </div>
@endsection
