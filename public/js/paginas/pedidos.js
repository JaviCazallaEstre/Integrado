$(function () {
  $(".carrito").on("click", function (ev) {
    ev.preventDefault();
    $(location).attr("href", "http://www.almaverde.com:8000/carrito");
  });
  $("#pedidos").DataTable({
    ajax: {
      url: "http://www.almaverde.com:8000/mis/pedidos",
      dataSrc: "compras",
    },
    columns: [
      {
        data: "fecha.date",
        render: $.fn.dataTable.render.moment(
          "YYYY-MM-DD HH:mm:ss.SSSSSS",
          "D/M/YYYY"
        ),
      },
      { data: "compras[<br/>].nombre" },
      {
        data: "coste",
        render: function (data, type, row) {
          precio = parseFloat(data) / 100;
          return precio.toFixed(2) + "€";
        },
      },
    ],
    language: {
      emptyTable: "No has realizado ninguna compra",
    },
  });
});
