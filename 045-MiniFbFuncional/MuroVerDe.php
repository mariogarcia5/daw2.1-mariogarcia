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

        <h1>Muro de ______</h1>

        <p>/Aquí mostraremos los mensajes que hayan sido publicados para el usuario indicado como parámetro.
            Si no indican nada, veo los mensajes dirigidos a mí.
            Si indican otra cosa, veo los mensajes dirigidos a ese usuario.</p>

        <a href='Index.php'>Ir al Contenido Público 1</a>

        <a href='MuroVerGlobal.php'>Ir al Contenido Privado 1</a>

    </body>

</html>