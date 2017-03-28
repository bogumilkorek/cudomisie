<section id="latest">

  @component('components.itemGrid', [
  'title' => __('Latest products'),
  'type' => 'products',
  'items' => $latestProducts
  ])
  @endcomponent

</section>
