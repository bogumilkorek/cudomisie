let bootstrap = require('bootstrap-sass');
let sweetalert = require('sweetalert');
let baguetteBox = require('baguettebox.js');
let jqueryEasing = require('jquery.easing');
let matchHeight = require('jquery-match-height');

import { slider } from './slider';
import { cart } from './cart';

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(() => {
  $(document).scrollTop(0);
  slider.run('.slider-container', 5000);
  baguetteBox.run('.gallery');
  $('.product-card .match').matchHeight();

  $(".cart-add").on('click', function(e) {
    e.preventDefault();
    cart.addItem($(this).data('slug'));
  });

  $(".cart-remove").on('click', function(e) {
    e.preventDefault();
    cart.removeItem($(this).data('slug'));
  });

  $(".search-toggle").on('click', function(e) {
    e.preventDefault();
    $('.navbar-collapse ul').toggle();
  });

});
