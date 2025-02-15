<?php

/**
 * @author Adrián López Pascual
 */

/*
 Muestra los múltiplos de 5 entre 0 y 100 usando:
a) bucle for
b) bucle while
c) bucle do-while
 */


echo "BUCLE FOR: \n";
echo "---------- \n";
for ($i = 5; $i < 101; $i += 5) {
    echo $i . " ";
}
echo "\n";
echo "---------- \n";
echo "\n";


echo "BUCLE WHILE: \n";
echo "---------- \n";
$cont = 5;
while ($cont < 101) {
    echo $cont . " ";
    $cont += 5;
}
echo "\n";
echo "---------- \n";
echo "\n";


echo "BUCLE  DO WHILE: \n";
echo "---------- \n";
$a = 5;
do {
    if ($a % 5 == 0) {
        echo $a . " ";
    }
    $a += 5;
} while ($a < 101);

echo "\n";
echo "---------- \n";
?>