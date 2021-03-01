<?php
	require_once "_com/Varios.php";

	$conexion = obtenerPdoConexionBD();

	$id = (int)$_REQUEST["id"];

	$sql = "DELETE FROM Persona WHERE id=?";

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

	<h1>Eliminación imposible</h1>
	<p>No existe la persona que se pretende eliminar (¿ha manipulado Vd. el parámetro id?).</p>

<?php } else { ?>

	<h1>Error en la eliminación</h1>
	<p>No se ha podido eliminar la persona o la persona no existía.</p>

<?php } ?>

<a href='PersonaListado.php'>Volver al listado de personas.</a>

</body>

</html>