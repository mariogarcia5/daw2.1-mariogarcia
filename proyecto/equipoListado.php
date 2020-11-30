<?php
require_once "varios.php";

$conexionBD = obtenerPdoConexionBD();

$sql = "SELECT id, nombre, localidad, anioCreacion FROM equipo ORDER BY nombre";

$select = $conexionBD->prepare($sql);
$select->execute([]);
$rs = $select->fetchAll();

?>

<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

<h1>Listado de Equipos</h1>

<table border='1' bgcolor='#d3d3d3' bordercolor='black'>

    <tr bgcolor='#a9a9a9' align='center'>
        <th>Nombre</th>
        <th>Ciudad</th>
        <th>Año creación</th>
    </tr>

    <?php foreach ($rs as $fila) { ?>
        <tr align="center">
            <td><a href='equipoFicha.php?id=<?=$fila["id"]?>'> <?= $fila["nombre"] ?> </a></td>
            <td><a href='equipoFicha.php?id=<?=$fila["id"]?>'> <?= $fila["localidad"] ?> </a></td>
            <td><a href='equipoFicha.php?id=<?=$fila["id"]?>'> <?= $fila["anioCreacion"] ?> </a></td>
        </tr>
    <?php } ?>

</table>

<br />
<br />

<a href='jugadorListado.php'>Listado de jugadores</a>

</body>

</html>