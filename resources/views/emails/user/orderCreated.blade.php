@component('mail::message')

#Twoje zamówienie zostało złożone. Dziękujemy za zakup!
#Numer zamówienia: {{ $order->id }}.<br />
@if($order->order_status_id == 2)
Wybrano przesyłkę za pobraniem. Proszę przygotować kwotę: **{{ $order->total_cost }}** dla kuriera/listonosza.<br />
@else
Proszę wpłacić kwotę **{{ $order->total_cost }}** na konto:<br />
PKO BP 21 1020 2821 0000 1702 0022 1242<br />
Tadeusz Pyzia<br />
ul. Rzemieślnicza 18, 72-320 Trzebiatów<br />
Tytułem: cudomisie.pl zamówienie nr {{ $order->id }}<br />
@endif

W załączeniu przesyłamy także fakturę do zamówienia.<br />
@component('mail::button', ['url' => url(__('invoice') .'/'.__('invoice') . '-' . $order->uuid . '.pdf')])
Pobierz fakturę
@endcomponent

**Śledzenie statusu zamówienia:<br />
<a href="{{ route('user.orders.show', $order->uuid) }}">{{ route('user.orders.show', $order->uuid) }}**

#Zamówione produkty:
@component('mail::table')
| # | Produkt | Cena | Ilość | Wartość |
| :---: | :---: | :---: | :---: | :---: |
@foreach($order->products as $index => $product)
| {{ ++$index }} | {{ $product->pivot->product_title }} | {{ $product->pivot->product_price }} | {{ $product->pivot->product_quantity }} | {{ number_format($product->pivot->product_quantity * floatval($product->pivot->product_price), 2) . ' ' . __('$') }} |
@endforeach
|  |  | **{{ __('Shipping method') }}:** | {{ $order->shipping_method_name }} | {{ $order->shipping_cost }} |
|  |  |  | **{{ __('Total cost') }}:** | **{{ $order->total_cost }}** |
@endcomponent

#Dane do wysyłki:

**{{ __('Name') }}:**<br />
{{ $order->name }}<br /><br />

**{{ __('Phone') }}:**<br />
{{ $order->phone }}<br /><br />

**{{ __('Address') }}:**<br />
{{ $order->address }}<br /><br />

@if(isset($order->comments))
**{{ __('Comments') }}:**<br />
{{ $order->comments }}<br /><br />
@endif

**{{ __('Data') }}:**<br />
{{ $order->created_at }}<br /><br />

@endcomponent
