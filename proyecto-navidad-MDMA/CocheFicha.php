<?php

    require_once "_varios.php";

    if(!esAdmin()){ //Si por algun motivo el usuario que accede no es un admin, redirecciona al Inicio
        redireccionar("Inicio.php");
    }

    $pdo = obtenerPdoConexionBD();

    $_SESSION["cocheId"] = (int)$_REQUEST["cocheId"];


    $nuevaEntrada = ($_SESSION["cocheId"] == -1);

    if($nuevaEntrada){

        $marcaCoche = " ";
        $modeloCoche = " ";
        $tipoCoche = " ";
        $precioCoche = " ";

    } else{

        $sql = "SELECT marca, modelo, tipo, precio FROM coche WHERE idCoche=?";
        $select = $pdo->prepare($sql);
        $select->execute([$_SESSION["cocheId"]]);
        $rs = $select->fetchAll();

        $marcaCoche = $rs[0]["marca"];
        $modeloCoche = $rs[0]["modelo"];
        $tipoCoche = $rs[0]["tipo"];
        $precioCoche = $rs[0]["precio"];
    }

?>
<html>

<h1>Ficha de coche</h1>

<?php
    if($nuevaEntrada){
            echo "<h3>Introduce los datos</h3>";
    }
    ?>

<form method="post" action="CocheGuardar.php">
    <ul>
        <li>
            <strong>Marca: </strong>
            <input type="text" name="marca" value="<?=$marcaCoche?>">
        </br></br>
        </li>
        <li>
            <strong>Modelo: </strong>
            <input type="text" name="modelo" value="<?=$modeloCoche?>">
            </br></br>
        </li>
        <li>
            <strong>Tipo: </strong>
            <input type="text" name="tipo" value="<?=$tipoCoche?>">
            </br></br>
        </li>
        <li>
            <strong>Precio: </strong>
            <input type="text" name="precio" value="<?=$precioCoche?>">
            </br></br>
        </li>

    </ul>
    <?php if($nuevaEntrada){ ?>
        <input type="submit" value="Crear coche" name="crear">
    <?php } else {?>
        <input type="submit" value="Guardar cambios" name="guardar">
    <?php } ?>
</form>

<button onclick="location.href='CocheListado.php'">Volver</button>

<br />
<br />

<a href="CocheEliminar.php?id=<?=$_SESSION["cocheId"]?>">Eliminar</a>

</html>
