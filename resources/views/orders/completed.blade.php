@extends('layouts.app')

@section('content')

<div class="panel panel-default">
  <div class="panel-body">
    <h1>
      <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
      {{ __('Success') }}!
    </h1>

    <hr>

    <p>
      <b>Twoje zamówienie zostało złożone. Dziękujemy za zakup!</b><br />
      Proszę wpłacić kwotę: {{ $total_cost }} na nr konta:<br />
      PKO BP 21 1020 2821 0000 1702 0022 1242<br />
      Tadeusz Pyzia<br />
      ul. Rzemieślnicza 18, 72-320 Trzebiatów<br />
      Tytułem: cudomisie.pl zamówienie nr {{ $id }}<br /><br />
      <b>Śledzenie statusu zamówienia: <a href="{{ route('user.orders.show', $uuid) }}">{{ route('user.orders.show', $uuid) }}</a></b>
    </p>

  </div>
</div>
@endsection
