<?php
require_once "varios.php";

$conexion = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];

$nuevaEntrada = ($id == -1);

if ($nuevaEntrada) {
    $equipoNombre = "Nombre equipo";
    $equipoLocalidad = "Localidad del equipo";
    $equipoAnioCreacion = "Año creación";
} else {
    $sql = "SELECT * FROM equipo WHERE id=?";

    $select = $conexion->prepare($sql);
    $select->execute([$id]);
    $rsEquipo = $select->fetchAll();

    $equipoNombre = $rsEquipo[0]["nombre"];
    $equipoLocalidad = $rsEquipo[0]["localidad"];
    $equipoAnioCreacion = $rsEquipo[0]["anioCreacion"];
    $equipoId = $rsEquipo[0]["id"];
}

$sql = "SELECT * FROM jugador";

$select = $conexion->prepare($sql);
$select->execute([$id]);
$rsJugadoresDelEquipo = $select->fetchAll();

?>

<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

<?php if ($nuevaEntrada) { ?>
    <h1>Nueva ficha del equipo</h1>
<?php } else { ?>
    <h1>Ficha de equipo</h1>
<?php } ?>

<form method='post' action='equipoGuardar.php'>

    <input type='hidden' name='id' value='<?=$id?>' />

    <label for='nombre'>Nombre: </label>
    <input type='text' name='nombre' value='<?=$equipoNombre?>' />
    <br/>
    <br/>
    <label for='localidad'>Localidad: </label>
    <input type='text' name='localidad' value='<?=$equipoLocalidad?>' />
    <br/>
    <br/>

    <label for='anioCreacion'>Año creación: </label>
    <input type='text' name='anioCreacion' value='<?=$equipoAnioCreacion?>' />
    <br/>
    <br/>

    <?php if ($nuevaEntrada) { ?>
        <input type='submit' name='crear' value='Crear equipo' />
    <?php } else { ?>
        <input type='submit' name='guardar' value='Guardar cambios' />
    <?php } ?>

</form>

<br />
<a href='equipoListado.php'>Volver al listado de equipos.</a>
<br />
<br />

<a href='jugadoresEquipoListado.php?id=<?=$id?>'>Ver jugadores del equipo.</a>

</body>

</html>