<?php
	require_once "_varios.php";

	$conexionBD = obtenerPdoConexionBD();

	$id = (int)$_REQUEST["id"];

	$sql = "DELETE FROM categoria WHERE id=?";

    $sentencia = $conexionBD->prepare($sql);

    $sqlConExito = $sentencia->execute([$id]);

    $correctoNormal = ($sqlConExito && $sentencia->rowCount() == 1);

 	$noExistia = ($sqlConExito && $sentencia->rowCount() == 0);

?>

<html>

<head>
	<meta charset='UTF-8'>
</head>

<body>

<?php if ($correctoNormal) { ?>

	<h1>Eliminación exitosa</h1>
	<p>Se ha eliminado exitosamente la categoría.</p>

<?php } else if ($noExistia) { ?>

	<h1>Eliminación fallida</h1>
	<p>No existe la categoría que a eliminar.</p>

<?php } else { ?>

	<h1>Error en la eliminación</h1>
	<p>No se ha podido eliminar la categoría.</p>

<?php } ?>

<a href='categoriaListado.php'>Volver al listado de categorías.</a>

</body>

</html>