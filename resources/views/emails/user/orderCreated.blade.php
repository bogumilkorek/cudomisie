@component('mail::message')

@component('mail::table')
  | # | Produkt | Ilość | Cena |
  | - | ------- | ----- | ---- |

  @foreach($order->products as $index => $product)
    | {{ ++$index }} | {{ $product->pivot->product_title }} | {{ $product->pivot->product_quantity }} | {{ $product->pivot->product_price }} |
  @endforeach

@endcomponent

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

@endcomponent
