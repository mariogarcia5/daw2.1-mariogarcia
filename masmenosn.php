<?php

    if (!isset($_REQUEST["acumulado"]) || isset($_REQUEST["reset"])) {
        $acumulado = 0;
        $diferencia = 1;
    } else {
        $acumulado = (int) $_REQUEST["acumulado"];
        $diferencia = (int) $_REQUEST["diferencia"];

        if (isset($_REQUEST["resta"])) {
            $acumulado = $acumulado - $diferencia;
        } else if (isset($_REQUEST["suma"])) {
            $acumulado = $acumulado + $diferencia;
        }
    }

?>

<html>

<h1><?=$acumulado?></h1>

<form method='get'>

    <input type='hidden' name='acumulado' value='<?=$acumulado?>'>
    <input type='submit' value=' - ' name='resta'>
    <input type='number' name='diferencia' value='<?=$diferencia?>'>
    <input type='submit' value=' + ' name='suma'>

    <br /><br />

    <input type='submit' value='Resetear' name='reset'>

</form>

</html>
