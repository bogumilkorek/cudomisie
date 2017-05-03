@component('mail::message')
  {{ __('order.placed', ['id' => $order->id]) }}<br />
  @if($order->order_status_id == 2)
    {{ __('order.cashOnDelivery', ['total' => $order->total_cost]) }}<br />
  @else
    {{ __('order.cashUpFront', ['total' => $order->total_cost, 'id' => $order->id]) }}<br />
  @endif

  {{ __('We are sending the invoice as an attachment as well').<br />
  @component('mail::button', ['url' => url(__('invoice') .'/'.__('invoice') . '-' . $order->uuid . '.pdf')])
    {{ __('Download your invoice') }}
  @endcomponent

  **{{ __('Track order status') }}:<br />
  <a href="{{ route('user.orders.show', $order->uuid) }}">{{ route('user.orders.show', $order->uuid) }}**

    # {{ __('Ordered products') }}:
    @component('mail::table')
      | # | {{ __('Product') }} | {{ __('Price') }} |
      | :--- | :--- | ---: |
      @foreach($order->products as $index => $product)
        | {{ ++$index }} | {{ $product->pivot->product_title }} | {{ $product->pivot->product_price }}
      @endforeach
      |   | {{ __('Shipping method') }}: {{ $order->shipping_method_name }} | {{ $order->shipping_cost }} |
      |   | **{{ __('Total cost') }}:** | **{{ $order->total_cost }}** |
    @endcomponent

    #{{ __('Shipping data') }}:

    **{{ __('Name') }}:**<br />
    {{ $order->name }}<br /><br />

    **{{ __('Phone') }}:**<br />
    {{ $order->phone_number }}<br /><br />

    **{{ __('Address') }}:**<br />
    {{ $order->address }}<br /><br />

    @if(isset($order->comments))
      **{{ __('Comments') }}:**<br />
      {{ $order->comments }}<br /><br />
    @endif

    **{{ __('Data') }}:**<br />
    {{ $order->created_at }}<br /><br />

  @endcomponent
