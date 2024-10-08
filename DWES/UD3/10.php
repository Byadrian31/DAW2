<?php

/**
 * @author Adrián López Pascual
 */

$num = rand(1,20);
$total = 0;
for ($i=$num; $i > 0 ; $i--) { 
    $total += $i;
}
printf("El sumatorio de %1d es: %1d \n", $num, $total);
?>