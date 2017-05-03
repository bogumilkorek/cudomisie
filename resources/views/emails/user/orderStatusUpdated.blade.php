@component('mail::message')

  {{ __('order.statusUpdated', ['id' => $order->id, 'status' => $order->orderStatus->title]) }}
  
@endcomponent
