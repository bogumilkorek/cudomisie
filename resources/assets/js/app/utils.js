let bootstrap = require('bootstrap-sass');
let baguetteBox = require('baguettebox.js');
let jqueryEasing = require('jquery.easing');
let matchHeight = require('jquery-match-height');

import { slider } from './slider';
import { cart } from './cart';

$(() => {
  slider.run('.slider-container', 5000);
  baguetteBox.run('.gallery');
  $('.product-card .match').matchHeight();
});
