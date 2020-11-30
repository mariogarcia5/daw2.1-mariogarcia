<?php
	require_once "_varios.php";

	$conexion = obtenerPdoConexionBD();

	$id = (int)$_REQUEST["id"];
	$nombre = $_REQUEST["nombre"];
	$apellidos = $_REQUEST["apellidos"];
	$telefono = $_REQUEST["telefono"];
    $categoriaId = (int)$_REQUEST["categoriaId"];

	$nuevaEntrada = ($id == -1);
	
	if ($nuevaEntrada) {
 		$sql = "INSERT INTO persona (nombre, apellidos, telefono, categoriaId) VALUES (?, ?, ?)";
        $parametros = [$nombre, $telefono, $categoriaId];

	} else {
	    $sql = "UPDATE persona SET nombre=?, apellidos=?, telefono=?, categoriaId=? WHERE id=?";
        $parametros = [$nombre, $apellidos, $telefono, $categoriaId, $id];
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
			<h1>Inserción completada</h1>
			<p>Se ha insertado correctamente la nueva entrada de <?php echo $nombre; ?>.</p>
		<?php } else { ?>
			<h1>Guardado completado</h1>
			<p>Se han guardado correctamente los datos de <?php echo $nombre; ?>.</p>

			<?php if ($datosNoModificados) { ?>
				<p>No se ha modificado nada. Los datos se mantienen.</p>
			<?php } ?>
		<?php }
?>

<?php
	} else {
?>

	<h1>Error en la modificación.</h1>
	<p>No se han podido guardar los datos de la persona.</p>

<?php
	}
?>

<a href='personaListado.php'>Volver al listado de personas</a>

</body>

</html>