<?php

/**
 * @author Adrián López Pascual
 */



function inicializarTablero()
{
    $array = [];
    for ($n = 0; $n < 5; $n++) {
        for ($m = 0; $m < 5; $m++) {
            $array[$n][$m] = " ";
        }
    }

    echo imprimirTablero($array);
    return $array;
}

function imprimirTablero($array)
{

    for ($n = 0; $n < 3; $n++) {
        for ($m = 0; $m < 3; $m++) {
            echo " " . $array[$n][$m] . " | ";
        }
        echo "\n";
        echo "--- | --- | ---";
        echo "\n";
    }
}


function verificarGanador($array)
{
    $resultado = false;
    // Horizontal
    if ($array[0][0] == $array[0][1] && $array[0][0] = $array[0][2] && $array[0][0] != " ") {
        $resultado = true;
    } elseif ($array[1][0] == $array[1][1] && $array[1][0] == $array[1][2] && $array[1][0] != " ") {
        $resultado = true;
    } elseif ($array[2][0] == $array[2][1] && $array[2][0] == $array[2][2] && $array[2][0] != " ") {
        $resultado = true;
    }
    // Vertical
    elseif ($array[0][0] == $array[1][0] && $array[0][0] == $array[2][0] && $array[0][0] != " ") {
        $resultado = true;
    } elseif ($array[0][1] == $array[1][1] && $array[0][1] == $array[2][1] && $array[0][1] != " ") {
        $resultado = true;
    } elseif ($array[2][0] == $array[2][1] && $array[2][0] == $array[2][2] && $array[2][0] != " " ) {
        $resultado = true;
    }
    // Diagonal
    elseif ($array[0][0] == $array[1][1] && $array[0][0] == $array[2][2] && $array[0][0] != " ") {
        $resultado = true;
    } elseif ($array[0][2] == $array[1][1] && $array[0][2] == $array[2][0] && $array[0][2] != " ") {
        $resultado = true;
    }

    return $resultado;
}

function tableroLleno($array)
{
    $cant = 0;
    for ($i = 0; $i < 3; $i++) {
        for ($a = 0; $a < 3; $a++) {
            if ($array[$i][$a] != " ") {
                $cant ++;
            }
        }
    }

    if ($cant = 9 && verificarGanador($array) == false) {
        echo "Empate, nadie gana";
    }
}


function iniciarPartida($j1,$f1,$j2,$f2)
{
        do {
            $op = readline($j1 . "(" . $f1 . "), indica la fila (0-2) o escribe 's' para abandonar la partida: ");
            echo "\n";
            $op2 = readline($j1 . "(" . $f1 . "), indica la columna (0-2) o escribe 's' para abandonar la partida: ");
            echo "\n";
            $cadena = inicializarTablero();
            $cadena[$op][$op2] = $f1;

            while ($cadena[$op][$op2] != " ") {
                echo "Esa posición no es valida \n";
                $op = readline($j1 . "(" . $f1 . "), indica la fila (0-2) o escribe 's' para abandonar la partida: ");
                echo "\n";
                $op2 = readline($j1 . "(" . $f1 . "), indica la columna (0-2) o escribe 's' para abandonar la partida: ");
                echo "\n";
                $cadena[$op][$op2] = $f1;
            }




            if (verificarGanador($cadena) == true) {
                echo "¡" . $j1 . " ha ganado esta partida! \n";
                return $j1;


            }

            $op = readline($j2 . "(" . $f2 . "), indica la fila (0-2) o escribe 's' para abandonar la partida: ") ;
            echo "\n";
            $op2 = readline($j2 . "(" . $f2 . "), indica la columna (0-2) o escribe 's' para abandonar la partida: ") ;
            echo "\n";
            $cadena = inicializarTablero();

            while ($cadena[$op][$op2] != " ") {
                echo "Esa posición no es valida \n";
                $op = readline($j2 . "(" . $f2 . "), indica la fila (0-2) o escribe 's' para abandonar la partida: ") ;
                echo "\n";
                $op2 = readline($j2 . "(" . $f2 . "), indica la columna (0-2) o escribe 's' para abandonar la partida: ") ;
                echo "\n";
            }

            $cadena[$op][$op2] = $f2;

        } while ($op = "s" || $op2 = "s");
}

echo "Bienvenido al 3 en raya\n";
$j1 = readline("Dime tu nombre jugador 1 ") ;
echo "\n";
$f1 = readline("Elige la ficha que quieras ") ;
echo "\n";

$j2 = readline("Dime tu nombre jugador 2 ") ;
echo "\n";
$f2 = readline("Elige la ficha que quieras ") ;
echo "\n";

echo "Jugador 1 es : " . $j1 . " y su ficha es " . $f1 . "\n";
echo "Jugador 2 es : " . $j2 . " y su ficha es " . $f2 . "\n";



$partidas = 0;
$w1 = 0;
$w2 = 0;
$l1 = 0;
$l2 = 0;
$c1 = 0;
$c2 = 0;
while ($partidas < 5) {
    $ganador = iniciarPartida($j1,$f1,$j2,$f2);
    $num = $partidas++;
    $nuevotorneo = "";
    echo "--- Partida " . $num . " --- ";
    if ($ganador == $j1) {
        $w1++;
        $l2++;
        if ($w1 == 3) {
            $c1++;
        }
    } else {
        $w2++;
        $l1++;
        if ($w2 == 3) {
            $c2++;
        }
    }

    if($c1 == 3 ) {
        echo $j1 . " ha ganado el torneo \n ";
        echo "---Estadísticas del Torneo--- \n";
        echo $j1 . "(" . $f1 . ") - Victorias: " . $w1 . ", Derrotas: " . $l1 . ", Copas: " . $c1 . " \n";
        echo $j2 . "(" . $f2 . ") - Victorias: " . $w2 . ", Derrotas: " . $l2 . ", Copas: " . $c2 . " \n";
        $opc = readline("¿Desean jugar otro torneo? (s para iniciar otro, cualquier otra tecla para no continuar): ");
        echo "\n;";
        if ($opc == "s") {
            $partidas == 0;
            $w1 = 0;
            $w2 = 0;
            $l1 = 0;
            $l2 = 0;
            $nuevoTorneo = "--- Iniciando un nuevo torneo de 3 partidas ---";
        } else {
            $partidas = 10;
        }
    } elseif ($c2 == 3) {
        echo $j2 . " ha ganado el torneo \n";
        echo "---Estadísticas del Torneo--- \n";
        echo $j1 . "(" . $f1 . ") - Victorias: " . $w1 . ", Derrotas: " . $l1 . ", Copas: " . $c1 . " \n";
        echo $j2 . "(" . $f2 . ") - Victorias: " . $w2 . ", Derrotas: " . $l2 . ", Copas: " . $c2 . " \n";
        $opc = readline("¿Desean jugar otro torneo? (s para iniciar otro, cualquier otra tecla para no continuar): ");
        echo "\n;";
        if ($opc == "s") {
            $partidas == 0;
            $w1 = 0;
            $w2 = 0;
            $l1 = 0;
            $l2 = 0;
            $nuevoTorneo = "--- Iniciando un nuevo torneo de 3 partidas ---";
        } else {
            $partidas = 10;
        }
    }
    
}
