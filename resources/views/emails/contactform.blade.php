@component('mail::message')

  **{{ __('Name') }}:**<br />
  {{ $name }}<br /><br />

  **{{ __('E-mail') }}:**<br />
  {{ $email }}<br /><br />

  **{{ __('Phone') }}:**<br />
  {{ $phone }}<br /><br />

  **{{ __('Content') }}:**<br />
  {{ $content }}
  
@endcomponent
