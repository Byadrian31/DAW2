<?php

/**
 * @author Adrián López Pascual
 */

/*
Calcula, dada la fecha y hora actual y la fecha y hora deseada, cuántas horas y minutos quedan
para dicho momento.
*/

//Saco la fecha actual y se la pido al usuario
$fechaInicio = date("Y/m/d H:i:s");
$fechaDeseada = readline("Dime la fecha deseada (ej: yyyy-mm-dd hh:mm:ss) ");
//Convierto las variables en fechas
$date1 = new DateTime($fechaInicio);
$date2 = new DateTime($fechaDeseada);
//Uso diff y format para sacar la diferencia entre fechas
$interval = $date1->diff($date2);

echo $interval->format(' %d día(s), %m mes(es), %y año(s), %h hora(s), %i minuto(s), %s segundo(s)') . "\n";
?>