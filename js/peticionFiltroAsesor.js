$(filtro_busqueda());

function filtro_busqueda(titulo,tipo,idioma,nivel,id_alumno){
    $.ajax({
        url: 'php/busqueda-hoja-asesor.php',
        type: 'POST',
        dataType: 'html',
        data: { 
            titulo: titulo,
            tipo: tipo,
            idioma: idioma,
            nivel: nivel,
            id_alumno: id_alumno
        }
    })
    .done(function(resultado){
        $("#filtro_resultado").html(resultado);
    });
}
$("#busqueda").on('click',function()
{
    var titulo = $("#titulo").val();
    var tipo = $("#tipo").val();
    var idioma = $("#idioma").val();
    var nivel = $("#nivel").val();
    var id_alumno = $("#id_alumno").val();

    filtro_busqueda(titulo,tipo,idioma,nivel,id_alumno);
});