<?php

$oculto = (int) $_REQUEST["oculto"];

if (!isset($_REQUEST["intento"])) {

    $intento = null;
    $numIntentos = 0;

} else {

    $intento = (int) $_REQUEST["intento"];
    $numIntentos = (int) $_REQUEST["numIntentos"] + 1;
    $numAsteriscos = 1 + log(abs($intento - $oculto), 1.5);
    $stringCercania = "";
    for ($i=1; $i <= $numAsteriscos; $i++) {
        $stringCercania = $stringCercania . "*";
    }
}

?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body>

<h1>ADIVINA EL NÚMERO OCULTO</h1>

<?php

if ($intento == null) {

} elseif ($intento < $oculto) {
    echo "<p>El número oculto es mayor ($stringCercania)</p>";
} elseif ($intento > $oculto) {
    echo "<p>El número oculto es menor ($stringCercania)</p>";
} else {
    echo "<p>¡Has adivinado el número oculto! Era el $oculto. Lo has adivinado en $numIntentos intentos.</p>";
}

if ($intento != $oculto) {
    ?>

    <form method="post">
        <h2>Jugador 2</h2>
        <p>Adivina el número: (llevas <?= $numIntentos ?> intentos).</p>
        <input type="hidden" name="oculto" value="<?= $oculto ?>">
        <input type="hidden" name="numIntentos" value="<?= $numIntentos ?>">
        <input type="number" name="intento">
        <input type="submit" value="Probar">
    </form>

    <?php
}
?>

</body>

</html>