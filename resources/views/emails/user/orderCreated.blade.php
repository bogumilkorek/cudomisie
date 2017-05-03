@component('mail::message')
  #{{ __('Your order has been placed successfully!') }}
  #{{ __('Order number: :id.', ['id' => $order->id]) }}

  @if($order->order_status_id == 2)
    {{ __('You have selected cash on delivery option. Please prepare: :total for your courier/postman', ['total' => $order->total_cost]) }}.<br />
  @else
    {{ __('Please pay :total on the following account number', ['total' => $order->total_cost]) }}:<br />
    {{ env('SELLER_BANK_NAME') }} {{ env('SELLER_BANK_ACCOUNT') }}<br />
    {{ env('SELLER_NAME') }}<br />
    {{ env('SELLER_ADDRESS') }}, {{ env('SELLER_CITY') }}<br /><br />
    {{ __('Payment title: cudomisie.pl order no :id', ['id' => $order->id]) }}<br />
  @endif

  {{ __('We are sending your invoice as an attachment as well').<br />
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
