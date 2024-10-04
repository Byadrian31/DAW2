<?php
/**
 * @author Adrián López Pascual
 * version 1
 */
$cambio = 166.386;
$salir = false;
while (!$salir) {
    $num = readline("¿Cuántos euros quieres cambiar? ");
    $pesetas = $num*$cambio;
    echo $num . "€ es igual a " . $pesetas . "pts";
    echo "\n";
    $respuesta = readLine("¿Quieres comprobar otra cantidad?(Y/N) ");

    if ($respuesta == "N") {
        $salir = true;
    }
}
echo " \n";
?>
