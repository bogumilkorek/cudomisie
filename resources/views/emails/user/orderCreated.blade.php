@component('mail::message')

#Twoje zamówienie zostało złożone. Dziękujemy za zakup! Numer zamówienia: {{ $order->id }}.

Proszę wpłacić kwotę **{{ $order->total_cost }}** na konto:<br />
PKO BP 21 1020 2821 0000 1702 0022 1242<br />
Tadeusz Pyzia<br />
ul. Rzemieślnicza 18, 72-320 Trzebiatów<br />
Tytułem: cudomisie.pl zamówienie nr {{ $order->id }}<br /><br />

**Śledzenie statusu zamówienia: <a href="{{ route('user.orders.show', $order->uuid) }}">{{ route('user.orders.show', $order->uuid) }}**

#Zamówione produkty:
@component('mail::table')
| # | Produkt | Cena | Ilość | Wartość |
| :---: | :---: | :---: | :---: | :---: |
@foreach($order->products as $index => $product)
| {{ ++$index }} | {{ $product->pivot->product_title }} | {{ $product->pivot->product_price }} | {{ $product->pivot->product_quantity }} | {{ $product->pivot->product_quantity * floatval($product->pivot->product_price) . ' ' . __('$') }} |
@endforeach
|  |  | **{{ __('Shipping method') }}:** | {{ $order->shippingMethod->title }} | {{ $order->shippingMethod->price }} |
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
