<?php
/**
 * @author Adrián López Pascual
*/
$segundosT = readline("Dime los segundos que han pasado desde las 12: ");

$horas = floor($segundosT / 3600);
$minutos = floor(($segundosT % 3600) / 60);
$segundos = $segundosT % 60;

printf("Desde las 12 han pasado %02d:%02d:%02d\n", $horas, $minutos, $segundos);
?>