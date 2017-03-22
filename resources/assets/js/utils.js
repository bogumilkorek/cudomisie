let bootstrap = require('bootstrap-sass');
let baguetteBox = require('baguettebox.js');
let jqueryEasing = require('jquery.easing');


$(() => {
  runSlider(5000);
  baguetteBox.run('.gallery');
});


$(window).on('load', () => {
  $('#status').fadeOut();
  $('#preloader').delay(350).fadeOut('slow');
  $('body').delay(350).css({
    'overflow': 'visible'
  });
});


// Set slider height on load and resize
$(window).on('load resize', () => {
  $('.slider-container').height($('.slider-container img:eq(1)').height());
});


function runSlider(duration) {
  $(".slider-container div:gt(1)").hide();
  setInterval(() => {
    $('.slider-container > div:eq(1)')
    .fadeOut(700)
    .next()
    .fadeIn(700)
    .end()
    .appendTo('.slider-container');
  }, duration);
}
