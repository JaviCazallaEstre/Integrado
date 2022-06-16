$(function(){
    $(".carrito").on("click", function (ev) {
        ev.preventDefault();
        $(location).attr("href", "http://www.almaverde.com:8000/carrito");
      });
});