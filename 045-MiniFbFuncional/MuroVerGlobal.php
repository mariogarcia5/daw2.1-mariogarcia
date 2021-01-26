<?php

    require_once "_Varios.php";

    if (!haySesionRamIniciada() && !intentarCanjearSesionCookie()) {
        redireccionar("SesionInicioFormulario.php");
    }

?>

<html>

    <head>
        <meta charset='UTF-8'>
    </head>

    <body>

        <?php pintarInfoSesion(); ?>

        <h1>Muro global</h1>

        <p>Aquí mostraremos todos los mensajes de todos a todos.</p>

        <a href='MuroVerDe.php'>Ir a mi muro.</a>

    </body>

</html>