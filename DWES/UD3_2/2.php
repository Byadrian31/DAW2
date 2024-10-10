<?php
/**
 * @author Adrián López Pascual
 */

$nota = readline("Dime la nota (0-10) ");
while (10 < $nota || $nota < 0) {
    echo "Porfavor del 0 al 10 \n";
    $nota = readline("Dime la nota (0-10) ");
}

if ($nota >= 0 && $nota < 5) {
    echo "SUSPENSO \n";
} elseif ($nota == 5) {
    echo "SUFICIENTE \n";
} elseif ($nota == 6) {
    echo "BIEN \n";
} elseif ($nota >= 7 && $nota <= 8) {
    echo "NOTABLE \n";
} elseif ($nota == 9) {
    echo "SOBRESALIENTE \n";
} elseif ($nota == 10) {
    echo "MATRÍCULA DE HONOR \n";
}
?>