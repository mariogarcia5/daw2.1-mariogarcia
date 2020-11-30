<?php
    require_once "_varios.php";

    $conexion = obtenerPdoConexionBD();

    $sql = "
               SELECT
                    p.id        AS pId,
                    p.nombre    AS pNombre,
                    c.id        AS cId,
                    c.nombre    AS cNombre
                FROM
                   persona AS p INNER JOIN categoria AS c
                   ON p.categoriaId = c.id
                ORDER BY p.nombre
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

<h1>Listado de Personas</h1>

<table border='1'>

    <tr>
        <th>Nombre</th>
        <th>Categoría</th>
    </tr>

    <?php
    foreach ($rs as $fila) { ?>
        <tr>
            <td><a href=   'personaFicha.php?id=<?=$fila["pId"]?>'> <?= $fila["pNombre"] ?> </a></td>
            <td><a href= 'categoriaFicha.php?id=<?=$fila["cId"]?>'> <?= $fila["cNombre"] ?> </a></td>
            <td><a href='personaEliminar.php?id=<?=$fila["pId"]?>'> (X)                      </a></td>
        </tr>
    <?php } ?>

</table>

<br />

<a href='personaFicha.php?id=-1'>Crear entrada</a>

<br />
<br />

<a href='categoriaListado.php'>Gestionar listado de Categorías</a>

</body>

</html>