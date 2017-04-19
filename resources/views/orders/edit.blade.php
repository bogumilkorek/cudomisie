@extends('layouts.admin')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1>{{ __('Edit order') }}</h1>
      <hr>

      @component('alert', ['errors' => $errors])
      @endcomponent

      <form method="POST" action="{{ route('orders.update', $order) }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div class="form-group">
          <label for="name">{{ __('Name') }}:</label>
          <input type="text" pattern="[^\s]{3,} [^\s]{3,}" class="form-control" name="name"
          value="{{ old('name', $order->name) }}" required autofocus>
        </div>

        <div class="form-group">
          <label for="email">{{ __('E-mail') }}:</label>
          <input type="email" class="form-control" name="email"
          value="{{ old('email', $order->email) }}" required>
        </div>

        <div class="form-group">
          <label for="phone">{{ __('Phone') }}:</label>
          <input type="text" pattern="((\+|00)[0-9]{2})?[0-9]{9}" class="form-control"
          name="phone" title="{{ __('Phone number must be 9 digits') }}."
          value="{{ old('phone',  $order->phone) }}" required>
        </div>

        <div class="form-group">
          <label for="address">{{ __('Addres') }}:</label>
          <input type="text" class="form-control"
          name="address"
          value="{{ old('address',  $order->address) }}" required>
        </div>

        <input type="hidden" name="uuid" value="{{ $order->uuid }}" />

        <button type="submit" class="btn btn-primary"
          data-loading-text="<i class='fa fa-cog fa-spin'></i> {{ __('Loading') }}">
          {{ __('Save') }}
        </button>
        <a href="{{ url()->previous() }}" class="btn btn-default">{{ __('Cancel') }}</a>
      </form>
    </div>
  </div>
</div>
@endsection
