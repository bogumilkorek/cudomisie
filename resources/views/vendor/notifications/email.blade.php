@component('mail::message')
# Witaj,

Otrzymujesz ten e-mail, ponieważ wybrano opcję "Przypomnij hasło".

{{-- Action Button --}}
@if (isset($actionText))
<?php
    switch ($level) {
        case 'success':
            $color = 'green';
            break;
        case 'error':
            $color = 'red';
            break;
        default:
            $color = 'blue';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
Resetuj hasło
@endcomponent
@endif

<!-- Salutation -->
@if (! empty($salutation))
{{ $salutation }}
@else
Pozdrawiamy,<br>{{ config('app.name') }}
@endif

<!-- Subcopy -->
@if (isset($actionText))
@component('mail::subcopy')
Jeżeli nie możesz kliknąć na przycisk "Resetuj hasło", skopiuj poniższy link do przeglądarki: [{{ $actionUrl }}]({{ $actionUrl }})
@endcomponent
@endif
@endcomponent
