$('body').ready(function () {
    $('#loginForm').on('submit', function () {
        var datos_enviar = $(this).serialize();
        $.ajax({
            method: 'POST',
            url: 'php/login.php',
            data: datos_enviar,
            beforeSend: function () {
                $("#btn").html("Ingresando...");
            },
            success: function (data) {
                if(data.success){
                    console.log(data.data);
                    switch(data.data){
                        case '0': window.location="inicio.php"; break;
                        case '1': window.location="inicio-admin.php";break;
                        case '2': window.location="inicio-maestro.php";break;
                        case '3': window.location="inicio-asesor.php"; break;
                        default: break;
                    }
                } else {
                    alert("Error: " + data.message);
                    $("#btn").html("Ingresar");
                }
            },
            error: function(data){
                console.log(data);
                alert("Error");
                $("#btn").html("Ingresar");
            }
        });
        return false;
    });
});