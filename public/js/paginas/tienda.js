$(function () {
  carrito = [];
  $(".comprarProducto").on("click", function (ev) {
    ev.preventDefault();
    id = sacarID(this);
    anadirAlCarrito(id);
  });

  function sacarID(elemento) {
    var idCompleto = $(elemento).attr("id");
    return idCompleto.split("_")[1];
  }

  function anadirAlCarrito(id) {
    carrito.push(id);
  }

  $('.carrito').on("click",function (ev) {
    ev.preventDefault()
    carrito=JSON.stringify(carrito);
    $.ajax({
        url: "http://www.almaverde.com:8000/carrito/",
        type: "get",
        data: carrito,
    });
  })

  $(".verDetalles").on("click", function (ev) {
    ev.preventDefault();
    id = sacarID(this);
    mostrarDetalles(id);
  });

  function mostrarDetalles(id) {
    $.getJSON(
      "http://www.almaverde.com:8000/tienda/producto/" + id,
      function (data) {
        modal = data.response;
        $(".js-modal1").append(modal);
        $(".descripcion").text(
          $(".descripcion")
            .text()
            .replace("<div>", "")
            .replace("</div>", "")
            .replaceAll("\t", "")
        );
        var formatter = new Intl.NumberFormat("es-ES", {
          style: "currency",
          currency: "EUR",
        });
        precio = $(".precioModal").text();
        precioFormateado = formatter.format(precio);
        $(".precioModal").text(precioFormateado);
      }
    );
    $(".js-modal1'").addClass("show-modal1");
  }
  $(".js-hide-modal1").on("click", function () {
    $(".modalAceite").empty();
    $(".js-modal1").removeClass("show-modal1");
  });
});
