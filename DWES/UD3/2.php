<?php
/**
 * @author Adrián López Pascual
*/

/*
Dada la fecha del sistema, indicar las horas, minutos y segundos junto con el día de la semana
*/

// Coge la hora local en español
setlocale(LC_ALL,"es_ES");
$horaActual = date("H:i:s");
$diaSemana = date("l");
echo ("La hora actual es: " . $horaActual ."\n");
//Con la función ucfirst(strftime("%A")), devuelve la primera letra en mayúscula.
echo "El día es: " . ucfirst(strftime("%A")) ."\n";
?>