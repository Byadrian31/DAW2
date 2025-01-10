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
        if ($n < 2){ 
            echo "---|---|---";
        }
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
    $movimientos = 0; // Control de turnos máximo (9 movimientos)

    do {
        imprimirTablero($tablero);
        $jugadorActual = ($turno == 1) ? $j1 : $j2;
        $fichaActual = ($turno == 1) ? $f1 : $f2;
        $oponente = ($turno == 1) ? $j2 : $j1;

        // Pedir fila y columna
        $fila = readline("$jugadorActual ($fichaActual), indica la fila (0-2) o escribe 's' para abandonar la partida: ");
        if ($fila === 's') {
            echo "$jugadorActual ha abandonado la partida. ¡$oponente gana!\n";
            return $oponente;
        }
        $columna = readline("$jugadorActual ($fichaActual), indica la columna (0-2) o escribe 's' para abandonar la partida: ");
        if ($columna === 's') {
            echo "$jugadorActual ha abandonado la partida. ¡$oponente gana!\n";
            return $oponente;
        }

        // Validar entrada
        if (!is_numeric($fila) || !is_numeric($columna) || $fila < 0 || $fila > 2 || $columna < 0 || $columna > 2) {
            echo "Posición inválida. Intenta nuevamente.\n";
            continue;
        }

        // Validar si la posición está ocupada
        if ($tablero[$fila][$columna] != " ") {
            echo "Esa posición ya está ocupada. Intenta nuevamente.\n";
            continue;
        }

        // Colocar ficha
        $tablero[$fila][$columna] = $fichaActual;
        $movimientos++;

        // Verificar ganador
        if (verificarGanador($tablero)) {
            imprimirTablero($tablero);
            echo "¡$jugadorActual ha ganado esta partida!\n";
            return $jugadorActual;
        }

        // Cambiar turno
        $turno = ($turno == 1) ? 2 : 1;
    } while ($movimientos < 9);

    imprimirTablero($tablero);
    echo "La partida ha terminado en empate.\n";
    return "Empate";
}

// Programa principal
echo "Bienvenido al 3 en raya\n";
$j1 = readline("Dime tu nombre jugador 1: ");
$f1 = readline("Elige la ficha que quieras: ");
$j2 = readline("Dime tu nombre jugador 2: ");
$f2 = readline("Elige la ficha que quieras: ");

$estadisticas = [
    $j1 => ['victorias' => 0, 'derrotas' => 0, 'empates' => 0, 'copas' => 0],
    $j2 => ['victorias' => 0, 'derrotas' => 0, 'empates' => 0, 'copas' => 0],
];

do {
    echo "--- Iniciando torneo de 3 partidas ---\n";

    for ($partida = 1; $partida <= 3; $partida++) {
        echo "--- Partida $partida de 3 ---\n";
        $ganador = iniciarPartida($j1, $f1, $j2, $f2);

        if ($ganador === $j1) {
            $estadisticas[$j1]['victorias']++;
            $estadisticas[$j2]['derrotas']++;
        } elseif ($ganador === $j2) {
            $estadisticas[$j2]['victorias']++;
            $estadisticas[$j1]['derrotas']++;
        } else {
            $estadisticas[$j1]['empates']++;
            $estadisticas[$j2]['empates']++;
        }
    }

    // Determinar ganador del torneo
    $ganadorTorneo = ($estadisticas[$j1]['victorias'] > $estadisticas[$j2]['victorias']) ? $j1 : $j2;
    if ($estadisticas[$j1]['victorias'] === $estadisticas[$j2]['victorias']) {
        echo "El torneo ha terminado en empate.\n";
    } else {
        echo "¡$ganadorTorneo gana el torneo y obtiene una copa!\n";
        $estadisticas[$ganadorTorneo]['copas']++;
    }

    // Mostrar estadísticas completas
    echo "\n--- Estadísticas del torneo ---\n";
    foreach ([$j1, $j2] as $jugador) {
        echo "$jugador: " .
            "Victorias: {$estadisticas[$jugador]['victorias']}, " .
            "Derrotas: {$estadisticas[$jugador]['derrotas']}, " .
            "Empates: {$estadisticas[$jugador]['empates']}, " .
            "Copas: {$estadisticas[$jugador]['copas']}\n";
    }

    // Reiniciar estadísticas de victorias y derrotas para el siguiente torneo
    $estadisticas[$j1]['victorias'] = 0;
    $estadisticas[$j2]['victorias'] = 0;
    $estadisticas[$j1]['derrotas'] = 0;
    $estadisticas[$j2]['derrotas'] = 0;

    $continuar = readline("¿Desean jugar otro torneo? (s/n): ");
} while (strtolower($continuar) === 's');

echo "Gracias por jugar. ¡Hasta la próxima!\n";

?>
