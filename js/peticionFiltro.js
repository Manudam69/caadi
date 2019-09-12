$(filtro_busqueda());

function filtro_busqueda(titulo,tipo,idioma){
    $.ajax({
        url: 'php/busqueda-hoja.php',
        type: 'POST',
        dataType: 'html',
        data: { 
            titulo: titulo,
            tipo: tipo,
            idioma: idioma
        }
    })
    .done(function(resultado){
        $("#filtro_resultado").html(resultado);
    })
}
$(document).on('click','#busqueda',function()
{
    var titulo = document.getElementsByName("titulo")[0].value;
    var tipo = document.getElementsByName("tipo")[0].value;
    var idioma = document.getElementsByName("idioma")[0].value;

    filtro_busqueda(titulo,tipo,idioma);
});