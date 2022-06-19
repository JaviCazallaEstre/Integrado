$(function () {
  $(".comprarProducto").on("click", function (ev) {
    ev.preventDefault();
    mostrarLoading();
    id = sacarID(this);
    $.ajax({
      url: "http://www.almaverde.com:8000/crea/carrito/" + id,
      type: "get",
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

  function mostrarLoading() {
    $.blockUI({
      message: "Añadido al carrito",
      onBlock: function () {},
      css: {
        border: "none",
        padding: "15px",
        backgroundColor: "#000",
        "-webkit-border-radius": "10px",
        "-moz-border-radius": "10px",
        opacity: 0.6,
        color: "#fff",
      },
    });
    setTimeout($.unblockUI, 1000);
  }
  arrayCapacidad = [];
  arrayVariedad = [];
  arrayCampana = [];
  arrayCosecha = [];
  function generarURL(ordenar) {
    $("input:checkbox:checked").each(function () {
      if ($(this).attr("class").split(" ")[2] == "variedad") {
        arrayVariedad.push($(this).attr("id"));
      } else if ($(this).attr("class").split(" ")[2] == "capacidad") {
        arrayCapacidad.push($(this).attr("id"));
      } else if ($(this).attr("class").split(" ")[2] == "campana") {
        arrayCampana.push($(this).attr("id"));
      } else if ($(this).attr("class").split(" ")[2] == "cosecha") {
        arrayCosecha.push($(this).attr("id"));
      }
      arrayCapacidad = Array.from(new Set(arrayCapacidad));
      arrayVariedad = Array.from(new Set(arrayVariedad));
      arrayCampana = Array.from(new Set(arrayCampana));
      arrayCosecha = Array.from(new Set(arrayCosecha));
      filtrosCapacidad = JSON.stringify(arrayCapacidad);
      filtrosCampana = JSON.stringify(arrayCampana);
      filtrosCosecha = JSON.stringify(arrayCosecha);
      filtrosVariedad = JSON.stringify(arrayVariedad);
      url =
        "http://www.almaverde.com/tienda?ordenPrecio=" +
        ordenar +
        "&capacidad=" +
        filtrosCapacidad +
        "&variedad=" +
        filtrosVariedad +
        "&cosecha=" +
        filtrosCosecha +
        "&campana=" +
        filtrosCampana;
      console.log(url);
    });
  }
  $(".filtros").on("change", function () {
    generarURL("");
  });
  $("#ordenaMayor").on("click", function (ev) {
    ev.preventDefault();
    ordenar = "asc";
    generarURL(ordenar);
  });
  $("#ordenaMenor").on("click", function (ev) {
    ev.preventDefault();
    ordenar = "desc";
    generarURL(ordenar);
  });
});
