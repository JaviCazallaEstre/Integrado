$(function () {
  $(".comprarProducto").on("click", function (ev) {
    ev.preventDefault();
    id = sacarID(this);
    $.ajax({
        url: "http://www.almaverde.com:8000/crea/carrito/"+id,
        type: 'get'
    });
  });

  function sacarID(elemento) {
    var idCompleto = $(elemento).attr("id");
    return idCompleto.split("_")[1];
  }


$(".carrito").on("click",function(ev){
  ev.preventDefault();
  $(location).attr('href',"http://www.almaverde.com:8000/carrito");
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
      }
    );
    $(".js-modal1'").addClass("show-modal1");
  }
  $(".js-hide-modal1").on("click", function () {
    $(".modalAceite").empty();
    $(".js-modal1").removeClass("show-modal1");
  });
});
