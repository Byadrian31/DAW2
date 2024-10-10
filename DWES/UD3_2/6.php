<?php
/**
 * @author Adrián López Pascual
 */
$numeros = [];
$contPar = 0;
$contImpar = 0;
for ($i=0; $i < 8; $i++) { 
    $num = rand(0,50);
    if ($num % 2 == 0) {
        $numeros["par"][] = $num;
        printf("Número %d es par\n",$num);
        $contPar++;
    }else{
        $numeros["impar"][] = $num;
        printf("Número %d es impar\n",$num);
        $contImpar++;
    }
}

echo "Lista de Pares: \n";
echo "---------------\n";

for ($i=0; $i < count($numeros["par"]); $i++) { 
    echo $numeros["par"][$i] . " ";
}
echo "\n";

echo "---------------\n";

echo "Lista de Impares: \n";
echo "---------------\n";
for ($i=0; $i < count($numeros["impar"]); $i++) { 
    echo $numeros["impar"][$i] . " ";
}
echo "\n";
echo "---------------\n";

$parTotal = ($contPar/8)*100;
$imparTotal = ($contImpar/8)*100;

printf("Hay %d números pares de 8, con un porcentaje de %d \n", $contPar, $parTotal);
printf("Hay %d números impares de 8, con un porcentaje de %d \n", $contImpar, $imparTotal);
?>