<?php

function inicializarTablero()
{
    $array = [];
    for ($n = 0; $n < 3; $n++) {
        for ($m = 0; $m < 3; $m++) {
            $array[$n][$m] = " ";
        }
    }
    return $array;
}

function imprimirTablero($array)
{
    for ($n = 0; $n < 3; $n++) {
        echo "\n";
        for ($m = 0; $m < 3; $m++) {
            echo " " . $array[$n][$m];
            if ($m < 2) echo " |";
        }
        echo "\n";
        if ($n < 2) echo "---|---|---";
    }
    echo "\n";
}

function verificarGanador($array)
{
    // Horizontal
    if ($array[0][0] == $array[0][1] && $array[0][0] == $array[0][2] && $array[0][0] != " "
        || $array[1][0] == $array[1][1] && $array[1][0] == $array[1][2] && $array[1][0] != " "
        || $array[2][0] == $array[2][1] && $array[2][0] == $array[2][2] && $array[2][0] != " ") {
        return true;
    }
    // Vertical
    elseif ($array[0][0] == $array[1][0] && $array[0][0] == $array[2][0] && $array[0][0] != " "
        || $array[0][1] == $array[1][1] && $array[0][1] == $array[2][1] && $array[0][1] != " "
        || $array[0][2] == $array[1][2] && $array[0][2] == $array[2][2] && $array[0][2] != " ") {
        return true;
    }
    // Diagonal
    elseif ($array[0][0] == $array[1][1] && $array[0][0] == $array[2][2] && $array[0][0] != " "
        || $array[0][2] == $array[1][1] && $array[0][2] == $array[2][0] && $array[0][2] != " ") {
        return true;
    }
    return false;
}

function tableroLleno($array)
{
    foreach ($array as $fila) {
        if (in_array(" ", $fila)) {
            return false;
        }
    }
    return true;
}

function iniciarPartida($j1, $f1, $j2, $f2)
{
    $tablero = inicializarTablero();
    $turno = 1; // Comienza el jugador 1

    while (true) {
        imprimirTablero($tablero);
        if ($turno == 1) {
            $op = readline($j1 . "(" . $f1 . "), indica la fila (0-2): ");
            $op2 = readline($j1 . "(" . $f1 . "), indica la columna (0-2): ");
            $ficha = $f1;
        } else {
            $op = readline($j2 . "(" . $f2 . "), indica la fila (0-2): ");
            $op2 = readline($j2 . "(" . $f2 . "), indica la columna (0-2): ");
            $ficha = $f2;
        }

        if ($op == 's' || $op2 == 's') {
            echo "Partida abandonada.\n";
            return null;
        }

        if ($tablero[$op][$op2] != " ") {
            echo "Esa posición ya está ocupada. Intenta de nuevo.\n";
            continue;
        }

        $tablero[$op][$op2] = $ficha;

        if (verificarGanador($tablero)) {
            imprimirTablero($tablero);
            echo "¡" . ($turno == 1 ? $j1 : $j2) . " ha ganado esta partida! \n";
            return ($turno == 1 ? $j1 : $j2);
        }

        if (tableroLleno($tablero)) {
            imprimirTablero($tablero);
            echo "La partida ha terminado en empate.\n";
            return "Empate";
        }

        $turno = ($turno == 1) ? 2 : 1; // Cambiar turno
    }
}

echo "Bienvenido al 3 en raya\n";
$j1 = readline("Dime tu nombre jugador 1: ");
$f1 = readline("Elige la ficha que quieras para jugador 1: ");
$j2 = readline("Dime tu nombre jugador 2: ");
$f2 = readline("Elige la ficha que quieras para jugador 2: ");

$partidas = 0;
$w1 = 0;
$w2 = 0;
$l1 = 0;
$l2 = 0;
$c1 = 0;
$c2 = 0;

while ($partidas < 5) {
    $ganador = iniciarPartida($j1, $f1, $j2, $f2);
    $partidas++;
    echo "--- Partida $partidas ---\n";
    
    if ($ganador == $j1) {
        $w1++;
        $l2++;
    } elseif ($ganador == $j2) {
        $w2++;
        $l1++;
    }

    if ($w1 == 3 || $w2 == 3) {
        echo "El torneo ha terminado.\n";
        break;
    }
}
?>
