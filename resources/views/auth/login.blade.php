@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">
            {{ __('Login') }}
          </div>
          <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
              {{ csrf_field() }}

              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                  <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                  @if ($errors->has('email'))
                    <span class="help-block">
                      <strong>{{ $errors->first('email') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">
                  {{ __('Password') }}
                </label>

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
                <div class="col-md-6 col-md-offset-4">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                      {{ __('Remember Me') }}
                    </label>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                  <button type="submit" class="btn btn-primary">
                      <i class="fa fa-check" aria-hidden="true"></i> {{ __('Login') }}
                  </button>

                  <a class="btn btn-danger btn-white" href="{{ route('password.request') }}">
                      <i class="fa fa-times" aria-hidden="true"></i> {{ __('Forgot Your Password?') }}
                  </a>
                </div>
              </div>

              <hr />

              <div class="text-center">
                  <a class="btn btn-primary btn-white btn-google" href="{{ url('login/google') }}">
                    <i class="fa fa-google" aria-hidden="true"></i> {{ __('Login with') }} Google
                  </a>
                  <a class="btn btn-primary btn-white btn-facebook" href="{{ url('login/facebook') }}">
                    <i class="fa fa-facebook" aria-hidden="true"></i> {{ __('Login with') }} Facebook
                  </a>
                  <a class="btn btn-primary btn-white btn-twitter" href="{{ url('login/twitter') }}">
                    <i class="fa fa-twitter" aria-hidden="true"></i> {{ __('Login with') }} Twitter
                  </a>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
