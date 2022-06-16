$(function () {
  $(document).on("click", ".anadeProductoCarrito", function (ev) {
    ev.preventDefault();
    mostrarLoading();
    id = sacarID(this);
    $.ajax({
      url: "http://www.almaverde.com:8000/crea/carrito/" + id,
      type: "get",
      success: function (respuesta) {
        if ((respuesta["code"] = 200)) {
          cargaCarrito();
        }else{
          ocultarLoading();
        }
      },
    });
  });

  $(document).on("click", ".quitaProductoCarrito", function (ev) {
    ev.preventDefault();
    mostrarLoading();
    id = sacarID(this);
    $.ajax({
      url: "http://www.almaverde.com:8000/elimina/carrito/" + id,
      type: "get",
      success: function (respuesta) {
        if ((respuesta["code"] = 200)) {
          cargaCarrito();
        }else{
          ocultarLoading();
        }
      },
    });
  });


  $(document).on("click", ".quitarTodos", function (ev) {
    ev.preventDefault();
    mostrarLoading();
    id = sacarID(this);
    $.ajax({
      url: "http://www.almaverde.com:8000/todos/carrito/" + id,
      type: "get",
      success: function (respuesta) {
        if ((respuesta["code"] = 200)) {
          cargaCarrito();
        }else{
          ocultarLoading();
        }
      },
    });
  });


  function sacarID(elemento) {
    var idCompleto = $(elemento).attr("id");
    return idCompleto.split("_")[1];
  }

  $(".carrito").on("click", function (ev) {
    ev.preventDefault();
    $(location).attr("href", "http://www.almaverde.com:8000/carrito");
  });

  function cargaCarrito() {
    $.getJSON(
      "http://www.almaverde.com:8000/carrito/actualizar",
      function (data) {
        contenido = data.response;
        $(".contenidoCarrito").empty();
        ocultarLoading();
        $(".contenidoCarrito").append(contenido);
      }
    );
  }

  function mostrarLoading() {
    $.blockUI({ message: null });
  }
  function ocultarLoading() {
    setTimeout($.unblockUI, 1);
  }
});
