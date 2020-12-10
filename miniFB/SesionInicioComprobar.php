<?php

    require_once "_Varios.php";

    $identificador = $_REQUEST["identificador"];
    $contrasenna = $_REQUEST["contrasenna"];

    $arrayUsuario = obtenerUsuario($identificador, $contrasenna);

    if ($arrayUsuario["condicion"]) {
        marcarSesionComoIniciada($arrayUsuario);
        redireccionar("ContenidoPrivado1.php");
    } else {
        redireccionar("SesionInicioMostrarFormulario.php");
    }