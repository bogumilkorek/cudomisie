let bootstrap = require('bootstrap-sass');
let sweetalert = require('sweetalert');
let baguetteBox = require('baguettebox.js');
let jqueryEasing = require('jquery.easing');
let matchHeight = require('jquery-match-height');
let smartmenus = require('smartmenus');
let smartmenusBootstrap = require('smartmenus-bootstrap');

import { slider } from './slider';
import { cart } from './cart';

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$(() => {
  let totalPrice = 0;
  let totalPriceWithProvision = 0;
  let shippingPrice = 0;
  let onlinePayment = false;

  if($('#total').length)
  {
    totalPrice = $('#total').html().split(' ');
    totalPriceWithProvision = parseFloat(totalPrice[0]) * (1 + (parseFloat($('#total').data('commission') / 100)));
  }

  $(document).scrollTop(0);
  slider.run('.slider-container', 5000);
  baguetteBox.run('.gallery, #content p a');
  $('.product-card .match').matchHeight();

  // Show cookie alert if "Cookies accepted" cookie is not set
  if(document.cookie.search("cookies-accepted") == -1)
  $('.cookie-alert').show();

  // Set "Cookies accepted" cookie on button press
  $('.accept-cookie').on('click', function() {
    document.cookie = "cookies-accepted=true";
  });

  // Get loading icon on form submit
  $('form').on('submit', function(e) {
    let $this = $(this);
    let submitButton = $this.find('button[type=submit]');
    submitButton.html(submitButton.data('loading-text')).prop('disabled', 'disabled');
  });

  // Get loading icon on social auth
  $('.social-login, .cart-add').on('click', function(e) {
    let $this = $(this);
    $this.html("<i class='fa fa-refresh fa-spin'></i>").addClass('disabled');
  });

  $(".cart-add").on('click', function(e) {
    e.preventDefault();
    let slug = $(this).data('slug');
    let quantity = $('input[data-slug=' + slug + ']').length ? $('input[data-slug=' + slug + ']').val() : 1;
    $(this).addClass('disabled');
    cart.addItem(slug, quantity);
  });

  $(".cart-remove").on('click', function(e) {
    e.preventDefault();
    cart.removeItem($(this).data('slug'));
  });

  $(".cart-clear").on('click', function(e) {
    e.preventDefault();
    cart.clear();
  });

  $(".cart-item-quantity").on('change keyup', function() {
    cart.updateItem($(this).data('slug'), $(this).val());
  });

  $("input[name=shippingMethodName]").on('change', function() {
    let newTotal = 0;
    shippingPrice = parseFloat($(this).data('price'));
    if(onlinePayment)
    newTotal = totalPriceWithProvision + shippingPrice;
    else
    newTotal = parseFloat(totalPrice[0]) + shippingPrice;
    $('#total').html(newTotal.toFixed(2) + ' ' + totalPrice[1]);
  })

  $("input[name=paymentMethodName]").on('change', function() {
    let newTotal = 0;
    if($(this).hasClass('online-payment'))
    {
      onlinePayment = true;
      if(onlinePayment)
      newTotal = totalPriceWithProvision + shippingPrice;
      else
      newTotal = parseFloat(totalPrice[0]) + shippingPrice;
      $('.cash-on-delivery').hide();
    }
    else
    {
      onlinePayment = false;
      if(onlinePayment)
      newTotal = totalPriceWithProvision + shippingPrice;
      else
      newTotal = parseFloat(totalPrice[0]) + shippingPrice;
      if($(this).hasClass('bank-payment'))
      $('.cash-on-delivery').hide();
      else
      $('.cash-on-delivery').show();
    }
    $('#total').html(newTotal.toFixed(2) + ' ' + totalPrice[1]);
  })

  $("#scroll-top").on('click', function(e) {
    e.preventDefault();
    $('html,body').animate({
      scrollTop: 0
    }, 500);
  });

});
