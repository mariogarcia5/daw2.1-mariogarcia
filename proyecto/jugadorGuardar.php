<?php
require_once "varios.php";

$conexion = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];
$nombre = $_REQUEST["nombre"];
$apellidos = $_REQUEST["apellido"];
$posicion = $_REQUEST["posicion"];
$equipo = (int)$_REQUEST["equipo"];

$nuevaEntrada = ($id == -1);

if ($nuevaEntrada) {

    $sql = "INSERT INTO jugador (nombre, apellido, posicion, idEquipo) VALUES (?, ?, ?, ?)";
    $parametros = [$nombre, $apellidos, $posicion, $equipo];
} else {

    $sql = "UPDATE jugador SET nombre=?, apellido=?, posicion=?, idEquipo=? WHERE id=?";
    $parametros = [$nombre, $apellidos, $posicion, $equipo, $id];
}

$sentencia = $conexion->prepare($sql);

$sqlConExito = $sentencia->execute($parametros);

$numFilasAfectadas = $sentencia->rowCount();
$unaFilaAfectada = ($numFilasAfectadas == 1);
$ningunaFilaAfectada = ($numFilasAfectadas == 0);

$correcto = ($sqlConExito && $unaFilaAfectada);

$datosNoModificados = ($sqlConExito && $ningunaFilaAfectada);
?>

<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

<?php

if ($correcto || $datosNoModificados) { ?>

    <?php if ($id == -1) { ?>
        <h1>Operación completada</h1>
        <p>Se ha añadido correctamente el nuevo jugador. Su nombre es: <?php echo $nombre; ?>.</p>
    <?php } else { ?>
        <h1>Guardado correcto</h1>
        <p>Se han guardado correctamente los datos del jugador <?php echo $nombre; ?>.</p>

        <?php if ($datosNoModificados) { ?>
            <p>No se ha cambiado nada, los datos del jugador se mantienen.</p>
        <?php } ?>
    <?php }
    ?>

    <?php
} else {
    ?>

    <h1>Error al modificar los datos.</h1>
    <p>No se han podido guardar los datos del jugador.</p>

    <?php
}
?>

<a href='jugadorListado.php'>Volver al listado de jugadores.</a>

</body>

</html>
