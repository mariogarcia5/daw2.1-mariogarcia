<?php 
    $listaCoches = array("Volvo", "Mercedes", "Audi"); 
    $listaCoches[2] = "Seat";
    $listaCoches[3] = "Opel";
    $listaCoches[4] = "Renault";
    $listaCoches[4] = "Ferrari";
    ?>


<html>
<head>Ejercicio 4</head>
<body>
   <select>
    
    <?php for($i = 0; $i<=5; $i++){?>
    <option><?php echo $listaCoches[$i]?></option>
    <?php } ?>
    
    </select> 

</body>
</html>
