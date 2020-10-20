<?php
    if (!isset($_REQUEST["num1"]) ||
    isset($_REQUEST["num2"]) ||
    isset($_REQUEST["res"])|| 
    isset($_REQUEST["reset"])){

        $num1 = (int) $_REQUEST["num1"];
        $num2 = (int) $_REQUEST["num2"];
        $res = $num1 + $num2;
        
        if(isset($_REQUEST["sum"])){
            $res = $num1 + $num2;
        } else if (isset($_REQUEST["res"])) {
            $res = $num1 - $num2;
        } else if (isset($_REQUEST["mul"])) {
            $res = $num1 * $num2;
        } else if (isset($_REQUEST["div"])) {
            $res = $num1 / $num2;
        }
    
    }
?>

<html>
<head>
    <meta charset="utf-8">
</head>
<body>
    <p>Introduce dos números:</p>
    
    <form method="get">
    <p>Número 1:</p>
    <input type="number" name="num1">
    <p>Número 2:</p>
    <input type="number" name="num2">
    <p>Elije la operación:</p>
    <input type="submit" name="sum" value=" + ">
    <input type="submit" name="res" value=" - ">
    <input type="submit" name="mul" value=" x ">
    <input type="submit" name="div" value=" / ">
    <p>Resultado:</p>
    <p><?=$res?></p> 
        
    <br>  
    <input type='submit' value='Resetear' name="reset">
    </form>
    
</body>

</html>