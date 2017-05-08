<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
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

  <meta http-equiv="cache-control" content="private, max-age=0, no-cache">
  <meta http-equiv="pragma" content="no-cache">
  <meta http-equiv="expires" content="0">

</head>
<body>
  @component('alert', ['errors' => $errors])
  @endcomponent

  @include('layouts.partials.nav')

  <div class="alert alert-success alert-dismissable fade in text-center cookie-alert" style="color: #FFF">
    <a href="#" class="close accept-cookie" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
    Używamy plików cookies, aby ułatwić korzystanie z serwisu.
    <a href="{{ route('user.pages.show', str_slug(__('Cookie policy'))) }}">Zapoznaj się z naszą polityką prywatności cookies.</a>
  </div>

  @include('layouts.partials.slider')

  @include('layouts.partials.content')

  @include('layouts.partials.latest')

  @include('layouts.partials.contact')

  @include('layouts.partials.footer')

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="{{ mix('/js/app.js') }}" type="text/javascript"></script>
  @include('sweet::alert')
  @stack('scripts')

</body>
</html>
