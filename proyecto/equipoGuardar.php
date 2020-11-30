<?php
require_once "varios.php";

$conexionBD = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];
$nombre = $_REQUEST["nombre"];
$localidad = $_REQUEST["localidad"];
$anioCreacion = $_REQUEST["anioCreacion"];

$nuevaEntrada = ($id == -1);

if ($nuevaEntrada) {

    $sql = "INSERT INTO equipo (nombre, localidad, anioCreacion) VALUES (?, ?, ?)";
    $parametros = [$nombre, $localidad, $anioCreacion];
} else {

    $sql = "UPDATE equipo SET nombre=?, localidad=?, anioCreacion=? WHERE id=?";
    $parametros = [$nombre, $localidad, $anioCreacion, $id];
}

$sentencia = $conexionBD->prepare($sql);

$sqlConExito = $sentencia->execute($parametros);

$correcto = ($sqlConExito && $sentencia->rowCount() == 1);

$datosNoModificados = ($sqlConExito && $sentencia->rowCount() == 0);

?>

<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

<?php
if ($correcto || $datosNoModificados) { ?>
    <?php if ($nuevaEntrada) { ?>
        <h1>Inserción completada</h1>
        <p>Se ha insertado correctamente el nuevo equipo llamado <?=$nombre?>. Su localidad es <?=$localidad?>.</p>
    <?php } else { ?>
        <h1>Guardado completado</h1>
        <p>Se han guardado correctamente los datos del equipo <?=$nombre?>. Su localidad es <?=$localidad?>.</p>

        <?php if ($datosNoModificados) { ?>
            <p>Los datos no han sido modificados.</p>
        <?php } ?>
    <?php }
    ?>

    <?php
} else {
    ?>

    <?php if ($nuevaEntrada) { ?>
        <h1>Error en la creación.</h1>
        <p>No se ha podido crear el nuevo equipo.</p>
    <?php } else { ?>
        <h1>Error en la modificación.</h1>
        <p>No se han podido guardar los datos del equipo.</p>
    <?php } ?>

    <?php
}
?>

<a href='equipoListado.php'>Volver al listado de equipos.</a>

</body>

</html>