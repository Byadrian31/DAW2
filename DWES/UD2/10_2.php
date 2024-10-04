<?php
/**
 * @author Adrián López Pascual
 * version 2
 */
$ale = rand(1,5);
$num = ["uno","dos","tres","cuatro","cinco"];
$texto = "El numero es: " . $ale;
switch ($ale) {
    case 1:
        echo $texto . " - " . $num[0];
        break;
    
    case 2:
        echo $texto . " - " . $num[1];
        break;

    case 3:
        echo $texto . " - " . $num[2];
        break;
    
    case 4:
        echo $texto . " - " . $num[3];
        break;
    
    case 5:
        echo $texto . " - " . $num[4];
        break;

    default:
        # Aquí no llegará el ejercicio
        break;
}
echo " \n";
?>