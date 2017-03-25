class Slider {

  run(container, duration) {
    $(container + ' div:gt(1)').hide();
    setInterval(() => {
      $(container + ' > div:eq(1)')
      .fadeOut(700)
      .next()
      .fadeIn(700)
      .end()
      .appendTo(container);
    }, duration);

    // Set container height on load and resize
    $(window).on('load resize', () => {
      $(container).height($(container + ' img:eq(1)').height());
    });
  }

}

export let slider = new Slider();
