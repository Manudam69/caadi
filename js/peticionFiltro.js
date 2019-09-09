$(filtro_busqueda());

function filtro_busqueda(hoja){
    $.ajax({
        url: '../php/busqueda-hoja.php',
        type: 'POST',
        dataType: 'html',
        data: { hojas: hoja}
    })

}