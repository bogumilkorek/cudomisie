@component('mail::message')
  # {{ __('Hello') }},

  {{ __('You are receiving this email because we received a password reset request for your account.') }}

  @component('mail::button', ['url' => $url])
    {{ __('Reset password') }}
  @endcomponent

  {{ __('Regards') }},<br>{{ config('app.name') }}

  @component('mail::subcopy')
    {{ __("If you’re having trouble clicking the 'Reset password' button, copy and paste the URL below into your web browser") }}: [{{ $url }}]({{ $url }})
  @endcomponent

@endcomponent
