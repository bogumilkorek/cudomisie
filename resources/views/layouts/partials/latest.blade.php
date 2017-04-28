<section id="latest">
  @component('components.productGrid', [
    'title' => __('Latest products'),
    'products' => $latestProducts,
    'pagination' => false
  ])
@endcomponent

</section>
