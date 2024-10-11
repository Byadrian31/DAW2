<?php
/**
 * @author Adrián López Pascual
*/

/*
Crea un programa que reciba una hora expresada en segundos transcurridos desde las 12 de la
noche y la convierta en horas, minutos y segundos
*/

$segundosT = readline("Dime los segundos que han pasado desde las 12: ");
// Con la función floor hago que los decimales no cambien el número, ej: 2.5 = 2
$horas = floor($segundosT / 3600);
$minutos = floor(($segundosT % 3600) / 60);
$segundos = $segundosT % 60;

printf("Desde las 12 han pasado %02d:%02d:%02d\n", $horas, $minutos, $segundos);
?>