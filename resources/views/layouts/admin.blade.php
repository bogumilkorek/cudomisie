<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}. {{ __('Official website') }}</title>

  <!-- Styles -->
  <link href="{{ mix('css/admin/app.css') }}" rel="stylesheet">
  <script>
  window.Laravel = {!! json_encode([
    'csrfToken' => csrf_token(),
  ]) !!};
  </script>
</head>
<body>
  <div id="app">
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">

          <!-- Collapsed Hamburger -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <!-- Branding Image -->
          <a class="navbar-brand" href="{{ route('dashboard') }}">
            {{ config('app.name', 'Laravel') }} - {{ __('Admin panel') }}
          </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
          <!-- Left Side Of Navbar -->
          <ul class="nav navbar-nav">
            &nbsp;
          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="nav navbar-nav navbar-right">
            <!-- Authentication Links -->
            @if (Auth::guest())
            <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
            @else
            <li><a href="{{ route('pages.index') }}">{{ __('Pages') }}</a></li>
            <li><a href="{{ route('blogPosts.index') }}">{{ __('Blog posts') }}</a></li>
            <li><a href="{{ route('products.index') }}">{{ __('Products') }}</a></li>
            <li><a href="{{ route('categories.index') }}">{{ __('Categories') }}</a></li>
            <li><a href="{{ route('orders.index') }}">{{ __('Orders') }}</a></li>
            <li><a href="{{ route('shippingMethods.index') }}">{{ __('Shipping methods') }}</a></li>
            <li><a href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>
          </li>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>
          @endif
        </ul>
      </div>
    </div>
  </nav>

  @yield('content')
</div>
<script src="{{ mix('js/admin/app.js') }}"></script>
@include('sweet::alert')


@stack('scripts')

</body>
</html>
