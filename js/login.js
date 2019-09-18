
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
                    window.location = "inicio.php";
                } else {
                    alert("Error: " + data.message);
                    $("#btn").html("Ingresar");
                }
            },
            error: function (data) {
                console.log("soy el error" + data.message);
            }
        });
        return false;
    });
});