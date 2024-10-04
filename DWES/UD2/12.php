<?php
/**
 * @author Adrián López Pascual
 * version 1
 */
$cambio = 166.386;
$salir = false;
while (!$salir) {
    $num = readline("¿Cuántas pesetas quieres cambiar? ");
    $euros = $num/$cambio;
    echo $num . "pts es igual a " . $euros . "€";
    echo "\n";
    $respuesta = readLine("¿Quieres comprobar otra cantidad?(Y/N) ");

    if ($respuesta == "N") {
        $salir = true;
    }
}
echo " \n";
?>
