<?php

    require_once "_varios.php";

     if(!haySesionIniciada()){ //Si no hay sesión iniciada, redirige al inicio
            redireccionar("Inicio.php");
     }

    if(hayCookieValida()) { //Canjea cookie si ha marcado el checkbox de recuerdame y accede directamente a DisenioListado
        $cookieCanjeada = intentarCanjearSesionCookie();
    }

    $pdo = obtenerPdoConexionBD();

    //Consultas SQL
    $sql = "SELECT * FROM disenio ORDER BY idDisenio";
    $select = $pdo->prepare($sql);
    $select->execute([]);
    $rs = $select->fetchAll();

    $sqlColor = "SELECT * FROM color ORDER BY idColor";
    $selectColor = $pdo->prepare($sqlColor);
    $selectColor->execute([]);
    $rsColor = $selectColor->fetchAll();


    if(isset($_REQUEST["coche"])){ //Recoge los datos seleccionados en Coche y lo marca
        $_SESSION["facturaCoche"] = $_REQUEST["coche"];
        $_SESSION["cocheMarcado"]= true;

    }


?>
<html>
<head>
    <meta charset="UTF-8">
</head>

<body>

<h1>Diseños</h1>

<?=mostrarInfoUsuario()?>

<br />
<br />

<form method="get" action="MotorListado.php">
    <table border='1' bgcolor='#d3d3d3' bordercolor='black'>

        <tr bgcolor='#a9a9a9' align='center' align="center">
            <th>Acabado</th>
            <th>Llantas</th>
            <th>Asientos</th>
            <th>Parrilla</th>
            <th>Precio</th>
        </tr>

        <?php

        if(isset($_SESSION["admin"])){ //Si hay sesión como admin muestra enlaces a la ficha

        foreach ($rs as $fila) { ?>
            <tr align="center">
                <td> <a href='DisenioFicha.php?disenioId=<?=$fila["idDisenio"]?>'> <?= $fila["acabado"] ?> </a></td>
                <td> <a href='DisenioFicha.php?disenioId=<?=$fila["idDisenio"]?>'> <?= $fila["llantas"] ?> </a></td>
                <td> <a href='DisenioFicha.php?disenioId=<?=$fila["idDisenio"]?>'> <?= $fila["asientos"] ?> </a></td>
                <td> <a href='DisenioFicha.php?disenioId=<?=$fila["idDisenio"]?>'> <?= $fila["parrilla"] ?> </a></td>
                <td> <a href='DisenioFicha.php?disenioId=<?=$fila["idDisenio"]?>'> <?= $fila["precio"] ?> €</a></td>
                <td><input type="radio" name="disenio" value='<?=$fila["idDisenio"]?>'> </td>
            </tr>
        <?php }
        } else { //Si es un usuario normal
            foreach ($rs as $fila) { ?>
                <tr align="center">
                    <td> <p> <?= $fila["acabado"] ?>  </p></td>
                    <td> <p> <?= $fila["llantas"] ?>  </p></td>
                    <td> <p> <?= $fila["asientos"] ?> </p></td>
                    <td> <p> <?= $fila["parrilla"] ?> </p></td>
                    <td> <p> <?= $fila["precio"] ?> € </p></td>
                    <td><input type="radio" name="disenio" value='<?=$fila["idDisenio"]?>'> </td>
                </tr>
            <?php }
        }?>

    </table>

    <!-- Menú de navegación -->
    <div id="menu" style=" position:absolute; top: 30px; right:200px; padding:40px; border: 1px solid; background-color: darkgrey; border-radius:20px; ">
        <a href="Inicio.php">Inicio</a><br>
        <a href="CocheListado.php">Coches</a><?php if($_SESSION["cocheMarcado"]){echo " <img src='imagenes/tick.png' width='15px' height='15px'>";} ?><br>
        <a href="DisenioListado.php">Diseños</a><?php if($_SESSION["disenioMarcado"]){echo " <img src='imagenes/tick.png' width='15px' height='15px'>";} ?><br>
        <a href="MotorListado.php">Motores</a><?php if($_SESSION["motorMarcado"]){echo " <img src='imagenes/tick.png' width='15px' height='15px'>";} ?><br>
        <a href="GarantiaListado.php">Garantias</a><?php if($_SESSION["garantiaMarcado"]){echo " <img src='imagenes/tick.png' width='15px' height='15px'>";} ?><br>
        <a href="FacturaListado.php">Factura</a><br>
    </div>

    <br />
    <?php if(isset($_SESSION["admin"])){ //Permite crear una nueva entrada si ha iniciado sesión como administrador ?>
        <a href="DisenioFicha.php?disenioId=-1">Nueva entrada</a>
    <?php } ?>


    <h2>Colores disponibles</h2>

    <table border='1' bgcolor='#d3d3d3' bordercolor='black'>

        <tr bgcolor='#a9a9a9' align='center'>
            <th colspan="3">Color</th>
        </tr>
        <?php
        foreach ($rsColor as $filaColor) { ?>
            <tr>
                <td><p> <?= $filaColor["color"] ?> </p></td>
                <td style="background-color:<?=$filaColor["hexadecimal"]?>; width: 15px; height: 10px;"></td>
                <td><input type="radio" name="color" value='<?=$filaColor["idColor"]?>' </td>
            </tr>
        <?php } ?>

    </table>

    <br />

    <input type="submit" value="Guardar y continuar">

</form>

<br/>

<button onclick="location.href='CocheListado.php'">Volver</button>

<br/>

</body>

</html>