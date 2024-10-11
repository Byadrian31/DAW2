<?php

/**
 * @author Adrián López Pascual
 */

/*
Diseñar la función operaMatriz, a la que se le pasa dos matrices de enteros positivos mayores de
0 y la operación que se desea realizar: sumar, restar, multiplicar o dividir (mediante un carácter:
's', 'r', 'm', 'd'). La función debe imprimir las matrices originales, indicar la operación a realizar y
la matriz con los resultados.
AÑADIDO -> Agregar menú para que el usuario pueda elegir si hacer las matrices o de manera random
 */

// Función para rellenar la Matriz con rand() pidiendo únicamente la longitud de la matriz
function rellenarMatrizRandom($longitud) {
    $matriz = [];
    for ($n = 0; $n < $longitud; $n++) {
        for ($m = 0; $m < $longitud; $m++) {
            $num1 = rand(0, 10);
            $matriz[$n][$m] = $num1;
        }
    }
    return $matriz;
}

// Función para rellenar la Matriz con los valores introducidos por el usuario además de la longitud de la matriz
function rellenarMatriz($longitud) {
    $matriz = [];
    for ($n = 0; $n < $longitud; $n++) {
        for ($m = 0; $m < $longitud; $m++) {
            $num1 = readline("Dime un número para la matriz (posición[" . $n . "][" . $m . "]): ");
            $matriz[$n][$m] = $num1;
        }
    }
    return $matriz;
}

// Función para mostrar la matriz
function mostrarMatriz($mostrar)
{
    foreach ($mostrar as $fila) {
        foreach ($fila as $valor) {
            echo $valor . " ";
        }
        echo "\n";
    }
}


//Función para dependiendo de (+,-,*,/) muestre el resultado de la operación entre ambas matrices, además de mostrarlas previamente
function operaMatriz($matriz1, $matriz2, $operacion)
{
    if (count($matriz1) == count($matriz2)) {
        $matriz = [];
        switch ($operacion) {
            case 's':
                echo "SUMAR:\n";
                echo "Primera matriz: \n";
                mostrarMatriz($matriz1);
                echo "--------------\n";
                echo "\n";

                echo "Segunda matriz: \n";
                mostrarMatriz($matriz2);
                echo "--------------\n";
                echo "\n";

                echo "RESULTADO(+): \n";

                for ($n = 0; $n < count($matriz1); $n++) {
                    for ($m = 0; $m < count($matriz1); $m++) {
                        $matriz[$n][$m] = $matriz1[$n][$m] + $matriz2[$n][$m];
                        echo $matriz[$n][$m] . " ";
                    }
                    echo "\n";
                }
                break;

            case 'r':
                echo "RESTAR:\n";
                echo "Primera matriz: \n";
                mostrarMatriz($matriz1);
                echo "--------------\n";
                echo "\n";

                echo "Segunda matriz: \n";
                mostrarMatriz($matriz2);
                echo "--------------\n";
                echo "\n";

                echo "RESULTADO(-): \n";

                for ($n = 0; $n < count($matriz1); $n++) {
                    for ($m = 0; $m < count($matriz1); $m++) {
                        $matriz[$n][$m] = $matriz1[$n][$m] - $matriz2[$n][$m];
                        echo $matriz[$n][$m] . " ";
                    }
                    echo "\n";
                }
                break;

            case 'm':
                echo "MULTIPLICAR:\n";
                echo "Primera matriz: \n";
                mostrarMatriz($matriz1);
                echo "--------------\n";
                echo "\n";

                echo "Segunda matriz: \n";
                mostrarMatriz($matriz2);
                echo "--------------\n";
                echo "\n";

                echo "RESULTADO(*): \n";

                for ($n = 0; $n < count($matriz1); $n++) {
                    for ($m = 0; $m < count($matriz1); $m++) {
                        $matriz[$n][$m] = $matriz1[$n][$m] * $matriz2[$n][$m];
                        echo $matriz[$n][$m] . " ";
                    }
                    echo "\n";
                }
                break;

            case 'd':
                echo "DIVIDIR:\n";
                echo "Primera matriz: \n";
                mostrarMatriz($matriz1);
                echo "--------------\n";
                echo "\n";

                echo "Segunda matriz: \n";
                mostrarMatriz($matriz2);
                echo "--------------\n";
                echo "\n";

                echo "RESULTADO(/): \n";

                for ($n = 0; $n < count($matriz1); $n++) {
                    for ($m = 0; $m < count($matriz1); $m++) {
                        if ($matriz2[$n][$m] == 0) {
                            $matriz[$n][$m] = "NaN";
                            echo $matriz[$n][$m] . " ";
                        } else {
                            $matriz[$n][$m] = $matriz1[$n][$m] / $matriz2[$n][$m];
                            printf("%.2f ", $matriz[$n][$m]);
                        }
                    }
                    echo "\n";
                }
                break;

            default:
                echo "Operación invalida\n";
                break;
        }
    } else {
        return "La longitud de las matrices no es la misma\n";
    }
}


//AÑADIDO: Menú para que el usuario decida como crear las matrices
$respuesta = readline("¿Quieres crear tu las matrices? (Y/N) ");

if ($respuesta == "Y") {
    $longitud = readline("Dime la longitud de la matriz ");
    $op = readline("Dime la operación: sumar(s), restar(r), multiplicar(m) y dividir(d) ");
    echo "Vamos a rellenar el primer matriz \n";

    //Almaceno en $array1 el resultado de la función
    $array1 = rellenarMatriz($longitud);

    echo "Vamos a rellenar el segundo matriz \n";
    
    //Almaceno en $array2 el resultado de la función
    $array2 = rellenarMatriz($longitud);

    operaMatriz($array1,$array2,$op);
} else {
    $longitud = readline("Dime la longitud de la matriz ");
    $op = readline("Dime la operación: sumar(s), restar(r), multiplicar(m) y dividir(d) ");
    $array1 = rellenarMatrizRandom($longitud);
    $array2 = rellenarMatrizRandom($longitud);

    operaMatriz($array1,$array2,$op);
}
?>