<?php

declare(strict_types=1);

function obtenerPdoConexionBD(): PDO
{
    $servidor = "localhost";
    $bd = "MiniFb";
    $identificador = "root";
    $contrasenna = "";
    $opciones = [
        PDO::ATTR_EMULATE_PREPARES   => false,
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    try {
        $conexion = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $identificador, $contrasenna, $opciones);
    } catch (Exception $e) {
        error_log("Error al conectar: " . $e->getMessage());
        exit('Error al conectar');
    }

    return $conexion;
}

function obtenerUsuario(string $identificador, string $contrasenna): ?array
{
    $conexionBD = obtenerPdoConexionBD();

    $sql = "Select * From usuario where identificador =? AND contrasenna=?";

    $sentencia = $conexionBD->prepare($sql);

    $sentencia->execute([$identificador, $contrasenna]);

    $rs = $sentencia->fetchAll();

    if($sentencia->rowCount()==1){
        return array("id" => $rs[0]["id"], "identificador" => $rs[0]["identificador"], "contrasenna" => $rs[0]["contrasenna"]);
    }else{
        return null;
    }

}

function marcarSesionComoIniciada(array $arrayUsuario)
{
    session_start();
    $_SESSION["id"] = $arrayUsuario["id"];
    $_SESSION["identificador"] = $arrayUsuario["identificador"];
}

function haySesionIniciada(): bool
{
    session_start();

    if(isset($_SESSION["id"])) {
        return true;
    }else{
        return false;
    }
}

function cerrarSesion()
{
    session_start();

    unset($_SESSION["id"]);
    unset($_SESSION["identificador"]);
    session_destroy();
}

function redireccionar(string $url)
{
    header("Location: $url");
    exit;
}

function syso(string $contenido)
{
    file_put_contents('php://stderr', $contenido . "\n");
}