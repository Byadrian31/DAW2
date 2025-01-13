<?php

/**
 * @author Adrián López Pascual
 */

// Horario usando arrays asociativos
$horario = [
    "14:10" => ["Lunes" => "DWEC", "Martes" => "DWEC", "Miércoles" => "--", "Jueves" => "DWES", "Viernes" => "EIE"],
    "15:05" => ["Lunes" => "DWEC", "Martes" => "DWEC", "Miércoles" => "DWEC", "Jueves" => "DWES", "Viernes" => "DWES"],
    "16:00" => ["Lunes" => "DWES", "Martes" => "DIW", "Miércoles" => "DWEC", "Jueves" => "EIE", "Viernes" => "DWES"],
    "16:55" => ["Lunes" => "P", "Martes" => "A", "Miércoles" => "T", "Jueves" => "I", "Viernes" => "O"],
    "17:15" => ["Lunes" => "DWES", "Martes" => "DIW", "Miércoles" => "DWEC", "Jueves" => "DIW", "Viernes" => "DIW"],
    "18:10" => ["Lunes" => "EIE", "Martes" => "DWES", "Miércoles" => "DAW", "Jueves" => "DIW", "Viernes" => "DIW"],
    "19:05" => ["Lunes" => "DAW", "Martes" => "DWES", "Miércoles" => "DAW", "Jueves" => "DAW", "Viernes" => "--"],
    "20:00" => ["Lunes" => "DAW", "Martes" => "--", "Miércoles" => "TUT", "Jueves" => "DAW", "Viernes" => "--"],
];

// Encabezado de la tabla
// Uso de la función str_repeat() para colocar los suficientes '-'
echo "|" . str_repeat("-", 70) . "| \n";
printf("%-10s %-10s %-10s %-16s %-10s %-10s %-10s \n", "|Hora", "|Lunes", "|Martes", "|Miércoles", "|Jueves", "|Viernes", "|");
echo "|" . str_repeat("-", 70) . "| \n";

// Bucle para mostrar el horario
foreach ($horario as $hora => $dias) {
    printf(
        "|%-10s|%-10s|%-10s|%-15s|%-10s|%-10s|\n",
        $hora,
        $dias["Lunes"],
        $dias["Martes"],
        $dias["Miércoles"],
        $dias["Jueves"],
        $dias["Viernes"]
    );
}

// Final tabla
echo "|" . str_repeat("-", 70) . "| \n";
