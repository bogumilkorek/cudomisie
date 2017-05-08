@component('mail::message')

**{{ __('Job') }}:**<br />
{{ $job }}<br /><br />

**{{ __('Exception') }}:**<br />
{{ $exception }}<br /><br />

**{{ __('Connection') }}:**<br />
{{ $connectionName }}<br /><br />

@endcomponent
