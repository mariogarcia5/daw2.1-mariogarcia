<?php
require_once "varios.php";

$conexion = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];


$nuevaEntrada = ($id == -1);

if ($nuevaEntrada) {
    $jugadorNombre = "Nombre";
    $jugadorApellidos = "Apellido";
    $jugadorPosicion = "Posicion";
    $jugadorIdEquipo = 1;

} else {
    $sqlJugador = "SELECT * FROM jugador WHERE id=?";

    $select = $conexion->prepare($sqlJugador);
    $select->execute([$id]);
    $rsJugador = $select->fetchAll();

    $jugadorNombre = $rsJugador[0]["nombre"];
    $jugadorApellidos = $rsJugador[0]["apellido"];
    $jugadorPosicion = $rsJugador[0]["posicion"];
    $jugadorIdEquipo = $rsJugador[0]["idEquipo"];
}

$sqlEquipos = "SELECT * FROM equipo";

$select = $conexion->prepare($sqlEquipos);
$select->execute([]);
$rsPosicion = $select->fetchAll();

?>

<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

<?php if ($nuevaEntrada) { ?>
    <h1>Nueva ficha de jugador</h1>
<?php } else { ?>
    <h1>Ficha del jugador</h1>
<?php } ?>

<form method='post' action='jugadorGuardar.php'>

    <input type='hidden' name='id' value='<?= $id ?>' />

    <label for='nombre'>Nombre: </label>
    <input type='text' name='nombre' value='<?=$jugadorNombre ?>' />
    <br/>
    <br/>

    <label for='apellido'> Apellidos: </label>
    <input type='text' name='apellido' value='<?=$jugadorApellidos ?>' />
    <br/>
    <br/>

    <label for='posicion'> Posición: </label>
    <input type='text' name='posicion' value='<?=$jugadorPosicion ?>' />
    <br/>
    <br/>

    <label for='equipo'>Equipo: </label>
    <select name='equipo'>
        <?php
        foreach ($rsPosicion as $filaPosicion) {
            $posicionId = (int) $filaPosicion["id"];
            $posicionNombre = $filaPosicion["nombre"];

            if ($posicionId == $jugadorIdEquipo) $seleccion = "selected='true'";
            else                                     $seleccion = "";

            echo "<option value='$posicionId' $seleccion>$posicionNombre</option>";
        }
        ?>
    </select>
    <br/>
    <br/>
    <br/>

    <?php if ($nuevaEntrada) { ?>
        <input type='submit' name='crear' value='Nuevo jugador' />
    <?php } else { ?>
        <input type='submit' name='guardar' value='Guardar cambios' />
    <?php } ?>

</form>

<?php if (!$nuevaEntrada) { ?>
    <br />
    <a href='jugadorEliminar.php?id=<?=$id ?>'>Eliminar jugador</a>
<?php } ?>
    <br />
    <br />
<a href='jugadorListado.php'>Volver al listado de jugadores.</a>

</body>

</html>