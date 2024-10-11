<?php

/**
 * @author Adrián López Pascual
 */

 /*
 Crear un programa para introducir números por teclado mientras su suma no alcance o iguale a
1000. Cuando ésto ocurra, debes mostrar los números introducidos, cuántos son, el total de la
suma y la media de todos ellos.
 */

$numeros = [];
$total = 0;

// Uso un bucle do-while para no siempre usar los mismo bucles
do {
    $num = readline("Dime un número: ");
    if ($num >= 1000) {
        while ($num >=1000) {
            echo "Tienes que decir otro número menor que 1000 ";
            $num = readline("Dime un número: ");
        }
        
    }
    $numeros[] = $num;
    $total += $num;

} while ($total < 1000);
// Con este if elimino el último número(porque es >=1000) tanto de la variable $total como del array $numeros 
if ($total >= 1000) {
    $total -= $num;
    array_pop($numeros);
}

$media = $total / count($numeros);
echo "Lista de números: \n";
foreach ($numeros as $value) {
    echo $value . " \n";
}

printf("Hay un total de %d números\n",count($numeros));
printf("La suma total es %d y la media de los números es %.2f\n",$total,$media);
 ?>