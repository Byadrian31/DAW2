<?php

/**
 * @author Adrián López Pascual
 */

$fechaInicio = date("Y/m/d H:i:s");
$fechaDeseada = readline("Dime la fecha deseada (ej: yyyy-mm-dd hh:mm:ss) ");
$date1 = new DateTime($fechaInicio);
$date2 = new DateTime($fechaDeseada);

$interval = $date1->diff($date2);

echo $interval->format(' %d dia(s), %m mes(es), %y año(s), %h hora(s), %i minuto(s), %s segundo(s)') . "\n";
?>