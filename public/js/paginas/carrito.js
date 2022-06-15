$(function(){
    var precios = JSON.parse('{{ precios | json_encode | raw }}');
    alert(precios);
    
    $(".carrito").on("click",function(ev){
        ev.preventDefault();
        $(location).attr('href',"http://www.almaverde.com:8000/carrito");
      })
});
