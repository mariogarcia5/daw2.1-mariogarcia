<?php
    require_once "_varios.php";

     if(!haySesionIniciada()){ //Si no hay sesión iniciada, redirige al inicio
            redireccionar("Inicio.php");
     }


    if(hayCookieValida()) { //Canjea cookie si ha marcado el checkbox de recuerdame y accede directamente a GarantiaListado
        $cookieCanjeada = intentarCanjearSesionCookie();
    }

    $pdo = obtenerPdoConexionBD();

    //Consulta SQL
    $sql = "SELECT * FROM garantia ORDER BY idGarantia";
    $select = $pdo->prepare($sql);
    $select->execute([]);
    $rs = $select->fetchAll();


    if(isset($_REQUEST["motor"])){ //Recoge los datos seleccionados en Motor y lo marca
        $_SESSION["facturaMotor"] = $_REQUEST["motor"];
        $_SESSION["motorMarcado"] = true;
    }

?>

<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

<h1>Garantías</h1>

<?=mostrarInfoUsuario()?>

<br />
<br />

<form action="FacturaListado.php" method="get">
    <table border='1' bgcolor='#d3d3d3' bordercolor='black'>

        <tr bgcolor='#a9a9a9' align='center'>
        <th>Años</th>
        <th>Kilometraje</th>
        <th>Precio</th>
    </tr>

    <?php

    if(isset($_SESSION["admin"])){ //Si hay sesión como admin muestra enlaces a la ficha

    foreach ($rs as $fila) { ?>
        <tr align="center">
            <td><a href='GarantiaFicha.php?garantiaId=<?=$fila["idGarantia"]?>'> <?= $fila["anios"] ?>       </a></td>
            <td><a href='GarantiaFicha.php?garantiaId=<?=$fila["idGarantia"]?>'> <?= $fila["kilometraje"] ?> </a></td>
            <td><a href='GarantiaFicha.php?garantiaId=<?=$fila["idGarantia"]?>'> <?= $fila["precio"] ?> €    </a></td>
            <td><input type="radio" name="garantia" value='<?=$fila["idGarantia"]?>'></td>
        </tr>
    <?php }
    } else { //Si es un usuario normal
    foreach ($rs as $fila) { ?>
        <tr align="center">
            <td><p> <?= $fila["anios"] ?>       </p></td>
            <td><p> <?= $fila["kilometraje"] ?> </p></td>
            <td><p> <?= $fila["precio"] ?> €    </p></td>
            <td><input type="radio" name="garantia" value='<?=$fila["idGarantia"]?>'></td>
        </tr>
    <?php }
    } ?>

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

    <br/>

    <?php if(isset($_SESSION["admin"])){ //Permite crear una nueva entrada si ha iniciado sesión como administrador ?>
        <a href="GarantiaFicha.php?garantiaId=-1">Nueva entrada</a>
    <?php } ?>

    <br/>
    <br/>

    <input type="submit" value="Ver factura">

    <br/>

</form>

<button onclick="location.href='MotorListado.php'">Volver</button>

</body>

</html>
