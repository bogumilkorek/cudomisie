@extends('layouts.app')

@section('content')

  <div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default">
      <div class="panel-body">
        <h1>
          <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
          {{ __('Register') }}
        </h1>
        <hr>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
          {{ csrf_field() }}

          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">{{ __('Name') }}:</label>

            <div class="col-md-6">
              <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

              @if ($errors->has('name'))
                <span class="help-block">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-4 control-label">{{ __('E-Mail Address') }}:</label>

            <div class="col-md-6">
              <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

              @if ($errors->has('email'))
                <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="col-md-4 control-label">{{ __('Password') }}:</label>

            <div class="col-md-6">
              <input id="password" type="password" class="form-control" name="password" required>

              @if ($errors->has('password'))
                <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group">
            <label for="password-confirm" class="col-md-4 control-label">{{ __('Confirm Password') }}:</label>

            <div class="col-md-6">
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>
          </div>

          <div class="text-center">

            <button type="submit" class="btn btn-dashed">
              <i class="fa fa-user" aria-hidden="true"></i> {{ __('Register') }}
            </button>

            <br /><br />
            <h1>
              <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
              {{ __('Login with') }}
            </h1>
            <hr>
            <a class="btn btn-circle btn-google" href="{{ url('login/google') }}" title="{{ __('Login with') }} Google">
              <i class="fa fa-google" aria-hidden="true"></i>
            </a>
            <a class="btn btn-circle btn-facebook" href="{{ url('login/facebook') }}" title="{{ __('Login with') }} Facebook">
              <i class="fa fa-facebook" aria-hidden="true"></i>
            </a>
            <a class="btn btn-circle btn-twitter" href="{{ url('login/twitter') }}" title="{{ __('Login with') }} Twitter">
              <i class="fa fa-twitter" aria-hidden="true"></i>
            </a>

          </div>
        </form>
      </div>
    </div>
  </div>


@endsection
