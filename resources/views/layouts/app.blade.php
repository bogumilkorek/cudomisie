<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="robots" content="index, follow" />
  <title>{{ config('app.name', 'Laravel') }}. {{ __('Official website') }}</title>
  <meta name="robots" content="index, follow" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="theme-color" content="#BCE2F7">
  <meta name="msapplication-navbutton-color" content="#BCE2F7">
  <meta name="apple-mobile-web-app-status-bar-style" content="#BCE2F7">
  <link rel="stylesheet" href="{{ mix('/css/app.css') }}" type="text/css" />
</head>
<body>

  @include('layouts.partials.nav')

  @include('layouts.partials.slider')

  @include('layouts.partials.content')

  @include('layouts.partials.latest')

  @include('layouts.partials.contact')

  @include('layouts.partials.footer')

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="{{ mix('/js/app.js') }}" type="text/javascript"></script>
  @include('sweet::alert')

</body>
</html>
