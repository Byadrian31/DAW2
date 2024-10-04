<?php
/**
 * @author Adrián López Pascual
 * version 1
 */
// Verifica si la extensión intl está habilitada
if (!extension_loaded('intl')) {
    die("La extensión intl no está habilitada. \n");
}

$ale = rand(1, 5);
$formatterES = new NumberFormatter("es", NumberFormatter::SPELLOUT);

echo "La cantidad es de " . $ale . " - " . $formatterES->format($ale);
echo " \n";
?>
