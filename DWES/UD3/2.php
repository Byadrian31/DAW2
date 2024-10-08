<?php
/**
 * @author Adrián López Pascual
*/
setlocale(LC_ALL,"es_ES");
$horaActual = date("H:i:s");
$diaSemana = date("l");
echo ("La hora actual es: " . $horaActual ."\n");
echo "El día es: " . ucfirst(strftime("%A")) ."\n";
?>