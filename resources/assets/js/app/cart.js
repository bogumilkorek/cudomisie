class Cart {

  addItem(slug, quantity)
  {
    $.ajax({
      method: "POST",
      url: "/cart/addItem",
      data: { slug: slug, quantity: quantity }
    })
    .done(function(message) {
      let itemCounter = $('#cart-items-counter').val() ? $('#cart-items-counter').val() : 0;
      $('#cart-items-counter').val(++itemCounter);
      let mType = message.type;
      swal({
        title: message.title,
        text: message.content,
        type: message.type ? message.type : "success"
      },
      () => mType != 'error' ? location.reload() : $('.cart-add[data-slug=' + slug + ']').html("<i class='fa fa-shopping-cart'></i>"));
    });
  }

  updateItem(slug, quantity)
  {
    $.ajax({
      method: "POST",
      url: "/cart/updateItem",
      data: { slug: slug, quantity: quantity }
    })
    .done(function(message) {
      swal({
        title: message.title,
        text: message.content,
        type: "success"
      },
      () => location.reload());
    });
  }

  removeItem(slug)
  {
    $.ajax({
      method: "POST",
      url: "/cart/removeItem",
      data: { slug: slug }
    })
    //  $("a[data-slug='" + slug + "']").closest('tr').remove();
    .done(function(message) {
      swal({
        title: message.title,
        text: message.content,
        type: "success"
      },
      () => location.reload());
    });
  }

  clear()
  {
    $.ajax({
      method: "POST",
      url: "/cart/clear"
    })
    .done(function(message) {
      swal({
        title: message.title,
        text: message.content,
        type: "success"
      },
      () => location.reload());
    });
  }

}

// Make sure we have only one instance
export let cart = new Cart();
