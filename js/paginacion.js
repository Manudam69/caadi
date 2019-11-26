$(document).ready(function(){
            
    // Esconde todas las tarjetas excepto las primeras 10
    $(".pagina").each(function(index, value) {
        if (Math.floor(index/10) + 1 != 1) {
            $(this).hide();
        }
    });
    
    // Al hacer click en los números
    $(".page-link").click(function(){
        $(".page-link").each(function(index, value){
            $(value).parent().removeClass("active");
        });

        //Hide all cards
        $(".pagina").hide();

        $(this).parent().addClass("active");
        var cardClass = ".pagina-" + $(this).text();
        $(cardClass).show();
    });

});