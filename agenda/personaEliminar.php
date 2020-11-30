<?php
	require_once "_varios.php";

	$conexion = obtenerPdoConexionBD();

	$id = (int)$_REQUEST["id"];

	$sql = "DELETE FROM persona WHERE id=?";

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

	<h1>Eliminación completada</h1>
	<p>Se ha eliminado correctamente la persona.</p>

<?php } else if ($noExistia) { ?>

	<h1>Eliminación errónea</h1>
	<p>No existe la persona que se quiere eliminar.</p>

<?php } else { ?>

	<h1>Error en la eliminación</h1>
	<p>No se ha podido eliminar la persona.</p>

<?php } ?>

<a href='personaListado.php'>Volver al listado de personas</a>

</body>

</html>