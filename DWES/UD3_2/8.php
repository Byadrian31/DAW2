<?php
/**
 * @author Adrián López Pascual
 */

/*

*/
$array1 = [];
$array2 = [];
$array3 = [];
for ($i=0; $i < 10; $i++) { 
    $num1 = readline("Dime un número para el primer vector ");
    $num2 = readline("Dime un número para el segundo vector ");
    $array1[$i] = $num1;
    $array2[$i] = $num2;
}

for ($i=0; $i < 10; $i++) { 
    $array3[] = "El " . $i+1 . "º de A = " .$array1[$i];
    $array3[] = "El " . $i+1 . "º de B = " .$array2[$i];
}

echo "Vector 3\n";

foreach ($array3 as $value) {
    echo $value . ", \n";
}

echo "\n";

?>