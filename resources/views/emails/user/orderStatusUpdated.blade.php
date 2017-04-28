@component('mail::message')

  ##Twoje zamówienie (nr {{ $order->id }}) zostało zaktualizowane.<br /><br />
  #Nowy status zamówienia: {{ $order->orderStatus->title }}

@endcomponent
