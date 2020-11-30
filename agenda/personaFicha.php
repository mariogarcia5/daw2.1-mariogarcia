<?php
	require_once "_varios.php";

	$conexion = obtenerPdoConexionBD();
	
	$id = (int)$_REQUEST["id"];

	$nuevaEntrada = ($id == -1);
	
	if ($nuevaEntrada) {
		$personaNombre = "Nombre";
        $personaApellidos = "Apellidos";
		$personaTelefono = "Teléfono";
		$personaCategoriaId = 0;
	} else {
        $sqlPersona = "SELECT nombre, apellidos, telefono, categoriaId FROM persona WHERE id=?";

        $select = $conexion->prepare($sqlPersona);
        $select->execute([$id]);
        $rsPersona = $select->fetchAll();

		$personaNombre = $rsPersona[0]["nombre"];
        $personaApellidos = $rsPersona[0]["apellidos"];
		$personaTelefono = $rsPersona[0]["telefono"];
		$personaCategoriaId = $rsPersona[0]["categoriaId"];
	}
	
	$sqlCategorias = "SELECT id, nombre FROM categoria ORDER BY nombre";

    $select = $conexion->prepare($sqlCategorias);
    $select->execute([]);
    $rsCategorias = $select->fetchAll();

?>

<html>

<head>
	<meta charset='UTF-8'>
</head>

<body>

<?php if ($nuevaEntrada) { ?>
	<h1>Nueva ficha de persona</h1>
<?php } else { ?>
	<h1>Ficha de persona</h1>
<?php } ?>

<form method='post' action='personaGuardar.php'>

<input type='hidden' name='id' value='<?= $id ?>' />

<ul>
	<li>
		<strong>Nombre: </strong>
		<input type='text' name='nombre' value='<?=$personaNombre ?>' />
	</li>
    <li>
        <strong> Apellidos: </strong>
        <input type='text' name='apellidos' value='<?=$personaApellidos ?>' />

    </li>
	<li>
		<strong>Teléfono: </strong>
		<input type='text' name='telefono' value='<?=$personaTelefono ?>' />
	</li>
	<li>
		<strong>Categoría: </strong>
		<select name='categoriaId'>
			<?php
                foreach ($rsCategorias as $filaCategoria) {
					$categoriaId = (int) $filaCategoria["id"];
					$categoriaNombre = $filaCategoria["nombre"];
					
					if ($categoriaId == $personaCategoriaId) $seleccion = "selected='true'";
					else                                     $seleccion = "";
					
					echo "<option value='$categoriaId' $seleccion>$categoriaNombre</option>";
                }
			?>
		</select>
	</li>
</ul>

<?php if ($nuevaEntrada) { ?>
	<input type='submit' name='crear' value='Crear persona' />
<?php } else { ?>
	<input type='submit' name='guardar' value='Guardar cambios' />
<?php } ?>

</form>

<?php if (!$nuevaEntrada) { ?>
    <br />
	<a href='personaEliminar.php?id=<?=$id ?>'>Eliminar persona</a>
<?php } ?>

<br />
<br />

<a href='personaListado.php'>Volver al listado de personas</a>

</body>

</html>