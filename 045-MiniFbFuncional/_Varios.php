<?php

declare(strict_types=1);
session_start();

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

function obtenerUsuarioPorContrasenna(string $identificador, string $contrasenna): ?array
{
    $conexion = obtenerPdoConexionBD();

    $sql = "SELECT * FROM Usuario WHERE identificador=? AND BINARY contrasenna=?";
    $select = $conexion->prepare($sql);
    $select->execute([$identificador, $contrasenna]);
    $rs = $select->fetchAll();

    return $select->rowCount()==1 ? $rs[0] : null;
}

function obtenerUsuarioPorCodigoCookie(string $identificador, string $codigoCookie): ?array
{
    $conexion = obtenerPdoConexionBD();

    $sql = "SELECT * FROM Usuario WHERE identificador=? AND BINARY codigoCookie=?";
    $select = $conexion->prepare($sql);
    $select->execute([$identificador, $codigoCookie]);
    $rs = $select->fetchAll();

    return $select->rowCount()==1 ? $rs[0] : null;
}

function actualizarCodigoCookieEnBD(?string $codigoCookie)
{
    $conexion = obtenerPdoConexionBD();
    $sql = "UPDATE Usuario SET codigoCookie=? WHERE id=?";
    $sentencia = $conexion->prepare($sql);
    $sentencia->execute([$codigoCookie, $_SESSION["id"]]);

}

function establecerSesionRam(array $arrayUsuario)
{
    $_SESSION["id"] = $arrayUsuario["id"];

    $_SESSION["identificador"] = $arrayUsuario["identificador"];
    $_SESSION["tipoUsuario"] = $arrayUsuario["tipoUsuario"];
    $_SESSION["nombre"] = $arrayUsuario["nombre"];
    $_SESSION["apellidos"] = $arrayUsuario["apellidos"];
}

function haySesionRamIniciada(): bool
{
    return isset($_SESSION["id"]);
}

function borrarCookies()
{
    setcookie("identificador", "", time() - 3600);
    setcookie("codigoCookie", "", time() - 3600);
}

function generarCadenaAleatoria(int $longitud): string
{
    for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != $longitud; $x = rand(0,$z), $s .= $a[$x], $i++);
    return $s;
}

function intentarCanjearSesionCookie(): bool
{
    if (isset($_COOKIE["identificador"]) && isset($_COOKIE["codigoCookie"])) {
        $arrayUsuario = obtenerUsuarioPorCodigoCookie($_COOKIE["identificador"], $_COOKIE["codigoCookie"]);

        if ($arrayUsuario) {
            establecerSesionRam($arrayUsuario);
            establecerSesionCookie($arrayUsuario);
            return true;
        } else {
            borrarCookies();
            return false;
        }
    } else {
        borrarCookies();
        return false;
    }
}

function pintarInfoSesion() {
    if (haySesionRamIniciada()) {
        echo "<span>Sesión iniciada por <a href='UsuarioPerfilVer.php'>$_SESSION[identificador]</a> ($_SESSION[nombre] $_SESSION[apellidos]) <a href='SesionCerrar.php'>Cerrar sesión</a></span>";
    } else {
        echo "<a href='SesionInicioFormulario.php'>Iniciar sesión</a>";
    }
}

function establecerSesionCookie(array $arrayUsuario)
{
    $codigoCookie = generarCadenaAleatoria(32);

    actualizarCodigoCookieEnBD($codigoCookie);

    setcookie("identificador", $arrayUsuario["identificador"], time() + 600);
    setcookie("codigoCookie", $codigoCookie, time() + 600);
}

function destruirSesionRamYCookie()
{
    session_destroy();
    actualizarCodigoCookieEnBD(Null);
    borrarCookies();
    unset($_SESSION);
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