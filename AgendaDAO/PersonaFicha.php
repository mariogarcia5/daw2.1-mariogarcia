<?php
	require_once "_com/Varios.php";

	$conexion = obtenerPdoConexionBD();
	
	$id = (int)$_REQUEST["id"];

	$nuevaEntrada = ($id == -1);
	
	if ($nuevaEntrada) {
		$personaNombre = "<introduzca nombre>";
        $personaApellidos = "<introduzca apellidos>";
		$personaTelefono = "<introduzca teléfono>";
        $personaEstrella = false;
		$personaCategoriaId = 0;
	} else {
        $sqlPersona = "SELECT * FROM Persona WHERE id=?";

        $select = $conexion->prepare($sqlPersona);
        $select->execute([$id]);
        $rsPersona = $select->fetchAll();

		$personaNombre = $rsPersona[0]["nombre"];
        $personaApellidos = $rsPersona[0]["apellidos"];
		$personaTelefono = $rsPersona[0]["telefono"];
        $personaEstrella = ($rsPersona[0]["estrella"] == 1);
		$personaCategoriaId = $rsPersona[0]["categoriaId"];
	}

	$sqlCategorias = "SELECT id, nombre FROM Categoria ORDER BY nombre";

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

<form method='post' action='PersonaGuardar.php'>

<input type='hidden' name='id' value='<?= $id ?>' />

    <label for='nombre'>Nombre</label>
    <input type='text' name='nombre' value='<?=$personaNombre ?>' />
    <br/>

    <label for='apellidos'> Apellidos</label>
    <input type='text' name='apellidos' value='<?=$personaApellidos ?>' />
    <br/>

    <label for='telefono'> Teléfono</label>
    <input type='text' name='telefono' value='<?=$personaTelefono ?>' />
    <br/>

    <label for='categoriaId'>Categoría</label>
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
    <br/>

    <label for='estrella'>Estrellado</label>
    <input type='checkbox' name='estrella' <?= $personaEstrella ? "checked" : "" ?> />
    <br/>

    <br/>

<?php if ($nuevaEntrada) { ?>
	<input type='submit' name='crear' value='Crear persona' />
<?php } else { ?>
	<input type='submit' name='guardar' value='Guardar cambios' />
<?php } ?>

</form>

<?php if (!$nuevaEntrada) { ?>
    <br />
    <a href='PersonaEliminar.php?id=<?=$id ?>'>Eliminar persona</a>
<?php } ?>

<br />
<br />

<a href='PersonaListado.php'>Volver al listado de personas.</a>

</body>

</html>