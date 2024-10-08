<?php

/**
 * @author Adrián López Pascual
 */

$num = rand(1,15);
$total = 1;
for ($i=$num; $i > 0 ; $i--) { 
    $total *= $i;
}
printf("El factorial de %1d es: %1d \n", $num, $total);
?>