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
      swal({
        title: message.title,
        text: message.content,
        type: "success"
      },
      () => location.reload());
    });
  }

  updateItem(slug, quantity)
  {
    $.ajax({
      method: "PUT",
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
      method: "DELETE",
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
      method: "DELETE",
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
