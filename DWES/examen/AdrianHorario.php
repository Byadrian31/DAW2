<?php
/**
 * @author Adrián López Pascual
 */

$Dias =  ["Lunes", "Martes" , "Miércoles", "Jueves", "Viernes"];
$Lunes = ["DWEC", "DWEC", "DWES", "P", "DWES", "EIE", "DAW", "DAW"];
$Martes = ["DWEC", "DWEC", "DIW", "A", "DIW", "DWES", "DWES", "--"];
$Miercoles = ["--", "DWEC", "DWEC", "T", "DWEC", "DAW", "DAW", "TUT"];
$Jueves = ["DWES", "DWES", "EIE", "I", "DIW", "DIW", "DAW", "DAW"];
$Viernes = ["EIE", "DWES", "DWES", "O", "DIW", "DIW", "--", "--"];

echo "|-------------------------------------------------------------------------------------------| \n";

echo"|Hora       |" . $Dias[0] . "       |" . $Dias[1] . "       |" . $Dias[2] . "       |" . $Dias[3] . "       |" . $Dias[4] . "       " . "       |\n";

echo "|-------------------------------------------------------------------------------------------| \n";

echo"|14:10      |" . $Lunes[0] . "        |" . $Martes[0] . "         |" . $Miercoles[0] . "              |" . $Jueves[0] . "         |" . $Viernes[0] . "                  |\n";
echo"|15:05      |" . $Lunes[1] . "        |" . $Martes[1] . "         |" . $Miercoles[1] . "            |" . $Jueves[1] . "         |" . $Viernes[1] . "                 |\n";
echo"|16:00      |" . $Lunes[2] . "        |" . $Martes[2] . "          |" . $Miercoles[2] . "            |" . $Jueves[2] . "          |" . $Viernes[2] . "                 |\n";
echo"|16:55      |" . $Lunes[3] . "           |" . $Martes[3] . "            |" . $Miercoles[3] . "               |" . $Jueves[3] . "            |" . $Viernes[3] . "                    |\n";
echo"|17:15      |" . $Lunes[4] . "        |" . $Martes[4] . "          |" . $Miercoles[4] . "            |" . $Jueves[4] . "          |" . $Viernes[4] . "                  |\n";
echo"|18:10      |" . $Lunes[5] . "         |" . $Martes[5] . "         |" . $Miercoles[5] . "             |" . $Jueves[5] . "          |" . $Viernes[5] . "                  |\n";
echo"|19:05      |" . $Lunes[6] . "         |" . $Martes[6] . "         |" . $Miercoles[6] . "             |" . $Jueves[6] . "          |" . $Viernes[6] . "                   |\n";
echo"|20:00      |" . $Lunes[7] . "         |" . $Martes[7] . "           |" . $Miercoles[7] . "             |" . $Jueves[7] . "          |" . $Viernes[7] . "                   |\n";

echo "|-------------------------------------------------------------------------------------------| \n";


?>