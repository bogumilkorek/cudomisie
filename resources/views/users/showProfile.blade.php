@extends('layouts.app')

@section('content')

  <h1>
    <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
    {{ __('Show profile') }}
  </h1>

  <hr>
  <div class="panel panel-default">
    <div class="panel-body">
      <form method="POST" action="{{ route('user.profile.update', $user) }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div class="form-group">
          <label for="name">{{ __('Name') }}:</label>
          <input type="text" pattern="[^\s]{3,} [^\s]{3,}" class="form-control" name="name"
          value="{{ old('name',  $user->name) }}" required autofocus>
        </div>

        <div class="form-group">
          <label for="email">{{ __('E-mail') }}:</label>
          <input type="email" class="form-control" name="email"
          value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="form-group">
          <label for="phone">{{ __('Phone') }}:</label>
          <input type="text" pattern="((\+|00)[0-9]{2})?[0-9]{9}" class="form-control"
          name="phone" title="{{ __('Phone number must be 9 digits') }}."
          value="{{ old('phone',  $user->phone) }}" required>
        </div>

        <div class="form-group">
          <label for="street">{{ __('Street and house number') }}:</label>
          <input type="text" pattern="[^\s]+ [0-9]{1,3}([a-zA-Z])?(\/[0-9]{1,3})?" class="form-control"
          name="street" title="{{ __('Correct form') }}: Rzemieślnicza 18, Rzemieślnicza 18a/3"
          value="{{ old('street', $user->street) }}" required>
        </div>

        <div class="form-group">
          <label for="city">{{ __('Zip code and city') }}:</label>
          <input type="text" pattern="[0-9]{2}-[0-9]{3} [^\s]{3,}" class="form-control"
          name="city" title="{{ __('Correct form') }}: 72-320 Trzebiatów"
          value="{{ old('city', $user->city) }}" required>
        </div>


        <button type="submit" class="btn btn-primary"
        data-loading-text="<i class='fa fa-cog fa-spin'></i> {{ __('Loading') }}">
        {{ __('Save') }}
      </button>
    </form>
  </div>
</div>

@endsection
