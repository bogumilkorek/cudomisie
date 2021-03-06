@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-body">
            <h1>
              
              {{ __('Login') }}
            </h1>
            <hr>
            <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
              {{ csrf_field() }}

              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">{{ __('E-Mail Address') }}:</label>

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
                  {{ __('Password') }}:
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

              <div class="text-center">
                <button type="submit" class="btn btn-dashed"
                data-loading-text="<i class='fa fa-refresh fa-spin'></i>
                {{ __('Loading') }}">
                <i class="fa fa-check" aria-hidden="true"></i> {{ __('Login') }}
              </button>
              <a class="btn btn-dashed" href="{{ route('password.request') }}">
                <i class="fa fa-times" aria-hidden="true"></i> {{ __('Forgot Your Password?') }}
              </a>

              @include('layouts.partials.socialAuth')

              <br /><br />
              <h1>
                
                {{ __('Register') }}
              </h1>
              <hr>
              <a class="btn btn-dashed" href="{{ route('register') }}">
                <i class="fa fa-user" aria-hidden="true"></i> {{ __('Register') }}
              </a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
