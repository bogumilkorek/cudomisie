@component('mail::message')

##{{ __('Your order (no :id) has been updated', ['id' => $order->id]) }}.<br /><br />
#{{ __('New status: :status', ['status' => $order->orderStatus->title]) }}.

@endcomponent
