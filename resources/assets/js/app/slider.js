class Slider {

  run(container, duration) {
    $(container).height($(container + ' img:eq(1)').height());
    $(container + ' div:gt(1)').hide();
    setInterval(() => {
      $(container + ' > div:eq(1)')
      .fadeOut(700)
      .next()
      .fadeIn(700)
      .end()
      .appendTo(container);
    }, duration);

    // Set container height on window resize
    $(window).on('resize', () => {
      $(container).height($(container + ' img:eq(1)').height());
    });
  }

}

export let slider = new Slider();
