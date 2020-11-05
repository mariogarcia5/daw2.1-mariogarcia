<?php

    if (!isset($_REQUEST["cantidad"]) || isset($_REQUEST["reset"])) {
        $cantidad = 0;
    } else {
        $cantidad = (int) $_REQUEST["cantidad"] + 1;
    }

?>

<html>

<form method='get'>

    <input type='text' name='cantidad' value='<?=$cantidad?>'>

    <input type='submit' value='suma 1' name='sumar'>

    <br /><br />

    <input type='submit' value='Resetear' name='reset'>

</form>

</html>