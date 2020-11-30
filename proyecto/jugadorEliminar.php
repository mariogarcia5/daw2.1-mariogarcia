<?php
require_once "varios.php";

$conexion = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];

$sql = "DELETE FROM jugador WHERE id=?";

$sentencia = $conexion->prepare($sql);

$sqlConExito = $sentencia->execute([$id]);

$unaFilaAfectada = ($sentencia->rowCount() == 1);
$ningunaFilaAfectada = ($sentencia->rowCount() == 0);

$correcto = ($sqlConExito && $unaFilaAfectada);

$noExistia = ($sqlConExito && $ningunaFilaAfectada);
?>

<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

<?php if ($correcto) { ?>

    <h1>Eliminado.</h1>
    <p>Se ha eliminado correctamente el jugador.</p>

<?php } else if ($noExistia) { ?>

    <h1>Eliminación fallida.</h1>
    <p>No existe el jugador que quieres eliminar.</p>

<?php } else { ?>

    <h1>Error al eliminar.</h1>
    <p>No se ha podido eliminar el jugador.</p>

<?php } ?>

<a href='jugadorListado.php'>Volver al listado de jugadores.</a>

</body>

</html>