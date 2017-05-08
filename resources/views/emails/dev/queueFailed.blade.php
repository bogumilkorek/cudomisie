@component('mail::message')

  **{{ __('Connection name') }}:**<br />
  {{ $connectionName }}<br /><br />

  **{{ __('Job') }}:**<br />
  {{ $job }}<br /><br />

  **{{ __('Exeption') }}:**<br />
  {{ $exeption }}<br /><br />

@endcomponent
