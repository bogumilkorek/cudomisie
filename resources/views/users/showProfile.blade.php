@extends('layouts.app')

@section('content')

  @component('alert', ['errors' => $errors])
  @endcomponent

  <div class="panel panel-default">
    <div class="panel-body">
      <h1>
        @if(Request::session()->has('shopping'))
          {{ __('Fill in your profile to proceed with your order') }}
        @else
          {{ __('Show profile') }}
        @endif
      </h1>

      <hr>
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
          <label for="phone_number">{{ __('Phone') }}:</label>
          <input type="text" pattern="((\+|00)[0-9]{2})?[0-9]{9}" class="form-control"
          name="phone_number" title="{{ __('Phone number must be 9 digits') }}."
          value="{{ old('phone_number',  $user->phone_number) }}" required>
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

        <div class="text-center">
          <button type="submit" class="btn btn-dashed"
          data-loading-text="<i class='fa fa-refresh fa-spin'></i> {{ __('Loading') }}">
          <i class="fa fa-share" aria-hidden="true"></i> {{ __('Save') }}
        </button>
      </div>
    </form>
  </div>
</div>

@endsection
