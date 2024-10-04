<?php
/**
 * @author Adrián López Pascual
 */
$fecha = date('w');
if ($fecha <= 15) {
    echo "Primera quincena";
} else {
    echo "Segunda quincena";
}

echo " \n";
?>