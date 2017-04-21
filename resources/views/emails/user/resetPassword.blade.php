@component('mail::message')
# Witaj,

Otrzymujesz ten e-mail, ponieważ wybrano opcję "Przypomnij hasło".

@component('mail::button', ['url' => $url])
Resetuj hasło
@endcomponent

Pozdrawiamy,<br>{{ config('app.name') }}

@component('mail::subcopy')
Jeżeli nie możesz kliknąć na przycisk "Resetuj hasło", skopiuj poniższy link do przeglądarki: [{{ $url }}]({{ $url }})
@endcomponent

@endcomponent
