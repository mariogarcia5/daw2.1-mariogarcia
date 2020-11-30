<?php
require_once "varios.php";

$conexion = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];

session_start();

$sql = "
               SELECT
                    j.id     AS jId,
                    j.nombre AS jNombre,
                    j.apellido AS jApellido,
                    j.posicion AS jPosicion,
                    j.idEquipo AS jIdEquipo,
                    e.id     AS eId,
                    e.nombre AS eNombre
                FROM
                   jugador AS j INNER JOIN equipo AS e
                   ON j.idEquipo = e.id
                WHERE 
                    j.idEquipo = $id
                ORDER BY e.nombre
            ";

$select = $conexion->prepare($sql);
$select->execute([]);
$rs = $select->fetchAll();

?>

<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

<h1>Listado de Jugadores del equipo</h1>

<table border='1' bgcolor='#d3d3d3' bordercolor='black'>

    <tr bgcolor='#a9a9a9' align='center'>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Posicion</th>
        <th>Equipo</th>
        <th>Eliminar</th>
    </tr>

    <?php
    foreach ($rs as $fila) { ?>
        <tr align="center">
            <td><a href= 'jugadorFicha.php?id=<?=$fila["jId"]?>'><?= $fila["jNombre"] ?></td>
            <td><a href= 'jugadorFicha.php?id=<?=$fila["jId"]?>'><?= $fila["jApellido"] ?></td>
            <td><a href= 'jugadorFicha.php?id=<?=$fila["jId"]?>'><?= $fila["jPosicion"] ?></td>
            <td><a href= 'equipoFicha.php?id=<?=$fila["eId"]?>'> <?= $fila["eNombre"] ?> </a></td>
            <td><a href='jugadorEliminar.php?id=<?=$fila["jId"]?>'> (X)                  </a></td>
        </tr>
    <?php } ?>

</table>

<br />
<br />

<a href='jugadorFicha.php?id=-1'>Nuevo jugador</a>

<br />
<br />

<a href='equipoListado.php'>Volver al listado de equipos.</a>

</body>

</html>