<?php

/**
 * @author: Adrián López Pascual
 */

// Genera el patrón para los teléfonos fijos de la provincia de Valencia

echo "Teléfonos fijos: \n";
function comprobarTelefono($telefono)
{
    // Primero, defino el patrón de expresión regular para validar los teléfonos fijos de Valencia
    $patron = '/^96\d{7}$/';
    return preg_match($patron, $telefono) ? "Válido" : "Inválido";
}

echo comprobarTelefono("966123456"); // Devuelve 1 = true
echo "\n";
echo comprobarTelefono("9661234567"); // Devuelve 0 = false
echo "\n";

// Genera el patrón para los códigos postales de la Comunidad Valenciana

echo "\nCódigo postal: \n";

function comprobarCP($cp)
{
    // Patrón actualizado para comprobar todos los códigos postales de la Comunidad Valenciana
    $patron = "/^(46[0-9]{3}|03[0-9]{3}|12[0-9]{3})$/";


    return preg_match($patron, $cp) ? "Válido" : "Inválido";  // Devuelve 1 si hay coincidencia, 0 si no hay coincidencia
}

echo comprobarCP("46001"); // Valencia, debería devolver 1
echo "\n";

echo comprobarCP("99999"); // No válido, debería devolver 0
echo "\n";

// Genera el patrón para los teléfonos móviles

echo "\nTeléfono móvil: \n";
function comprobarTelefonoMovil($telefono)
{

    $patron = "/^(6|7)[0-9]{8}$/"; // Que empiece por 6 o 7 y tenga 8 dígitos entre el 0 y el 9

    return preg_match($patron, $telefono) ? "Válido" : "Inválido";
}

echo comprobarTelefonoMovil("622352799"); // True
echo "\n";
echo comprobarTelefonoMovil("961084537"); // 0
echo "\n";

// Genera el patrón para un NIF 

echo "\nNIF: \n";

function comprobarNif($Nif)
{

    $patron = '/^[0-9]{8}[A-Z]$/';

    return preg_match($patron, $Nif) ? "Válido" : "Inválido";
}

echo comprobarNif("53885269H");
echo "\n";
echo comprobarNif("A487537656");
echo "\n";

// Genera el patrón para fecha en formato dd/mm/aaaa o bien dd-mm-aaaa

echo "\nFecha: \n";

function comprobarFecha($fecha)
{

    $patron = '/^\d{2}[\/\-]\d{2}[\/\-]\d{4}$/';

    return preg_match($patron, $fecha) ? "Válido" : "Inválido";
}

echo comprobarFecha('12/12/2024'); // Válido
echo "\n";
echo comprobarFecha("19-06-1998"); // Válido
echo "\n";
echo comprobarFecha("2024/12/12"); // Inválido
echo "\n";

// Genera el patrón para una cadena que sea aprobado (puede ser mayúsculas o minúsculas

echo "\nAprobado May y Min \n";

function comprobarAprobadoMayMin($palabra)
{

    $patron = '/^(aprobado|APROBADO)$/';

    return preg_match($patron, $palabra) ? "Válido" : "Inválido";
}

echo comprobarAprobadoMayMin("APROBADO");
echo "\n";
echo comprobarAprobadoMayMin("aprobado");
echo "\n";
echo comprobarAprobadoMayMin("Aprobado");
echo "\n";

// Genera el patrón para una cadena que contenga aprobado en minúsculas

echo "\nAprobado minúsculas: \n";

function comprobarAprobadoMin($palabra)
{

    $patron = '/^aprobado$/';

    return preg_match($patron, $palabra) ? "Válido" : "Inválido";
}

echo comprobarAprobadoMin("APROBADO");
echo "\n";
echo comprobarAprobadoMin("aprobado");
echo "\n";

// Genera el patrón para una cadena que contenga aprobado tanto en mayúsculas como en minúsculas

echo "\nAprobado: \n";

function comprobarAprobado($string)
{

    $patron = '/^aprobado$/';

    $palabra = strtolower($string);
    return preg_match($patron, $palabra) ? "Válido" : "Inválido";
}

echo comprobarAprobado("Aprobado");
echo "\n";
echo comprobarAprobado("aprobado");
echo "\n";
echo comprobarAprobado("Suspenso");
echo "\n";

// Genera el patrón para letras mayúsculas/minúsculas y espacios

echo "Letras y espacios: \n";

function comprobarLetrasyEspacios($cadena)
{

    $patron = '/^[A-Za-z\s]+$/';

    return preg_match($patron, $cadena) ? "Válido" : "Inválido";
}

echo comprobarLetrasyEspacios("Hola soy Alejandro");
echo "\n";
echo comprobarLetrasyEspacios("Tengo 18 años");
echo "\n";

// Genera el patrón para solamente números, sin espacios

echo "Número sin espacios: \n";

function comprobarNumeros($numero)
{

    $patron =  '/^\d+$/';

    return preg_match($patron, $numero) ? "Válido" : "Inválido";
}

echo comprobarNumeros("12345");
echo "\n";
echo comprobarNumeros("123 345");
echo "\n";

// Genera el patrón para números con espacios

echo "Números con espacios: \n";

function comprobarNumerosEspacios($numero)
{

    $patron = '/^\d+(?:\s+\d+)*$/';

    return preg_match($patron, $numero) ? "Válido" : "Inválido";
}

echo comprobarNumerosEspacios("123 456");
echo "\n";
echo comprobarNumerosEspacios("123 ABC");
echo "\n";

// Genera el patrón para texto en blanco, números, mayúsculas/minúsculas y caracteres acentuados

echo "Texto en blanco, números, mayúsculas/minúsculas y caracteres acentuados: \n";

function comprobarVariado($cadena)
{

    $patron =  '/^[\w\sáéíóúÁÉÍÓÚ]+$/u';

    return preg_match($patron, $cadena) ? "Válido" : "Inválido";
}

echo comprobarVariado("  123 Último");
echo "\n";
echo comprobarVariado(" $%");
echo "\n";

// Genera el patrón para el caso anterior añadiendo los signos de puntuación: comillas simples, coma, punto, punto y coma, dos puntos y guiones

echo "Idem que el anterior más signos de puntuación";

function comprobarVariadoPuntuacion($cadena)
{
    $patron = '/^[\w\sáéíóúÁÉÍÓÚ.,;:\-\'"]+$/u';
    return preg_match($patron, $cadena) ? "Válido" : "Inválido";
}

echo comprobarVariadoPuntuacion("  123 Último,.;:-_");  // Debería devolver 1 (verdadero)
echo "\n";
echo comprobarVariadoPuntuacion(" $%");  // Debería devolver 0 (falso)
echo "\n";

// Genera el patrón para validar una dirección de email

echo "E-mail: \n";

function comprobarEmail($email)
{

    $patron = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

    return preg_match($patron, $email) ? "Válido" : "Inválido";
}

echo comprobarEmail("alejandrosilla6@gmail.com");
echo "\n";
echo comprobarEmail("alejandrogmail.com");
echo "\n";

// Genera el patrón para validar una URL sencilla (http://www.ieslasenia.org/ejercicio?16)

echo "URL: \n";

function comprobarURL($url)
{

    $patron = '/^http:\/\/(?:[a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}(?:\/\S*)?$/';

    return preg_match($patron, $url) ? "Válido" : "Inválido";
}

echo comprobarURL("https://aules.edu.gva.es/fp/mod/assign/view.php?id=6437386");
echo "\n";
echo comprobarURL("http://www.ieslasenia.org/ejercicio?16");
echo "\n";

// Genera el patrón para validar una contraseña con al menos un carácter en minúscula, una mayúscula, un número y al menos 6 caracteres de longitud

echo "Contraseña: \n";

function comprobarPass($pass)
{

    $patron =  '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/';

    return preg_match($patron, $pass) ? "Váldio" : "Inválido";
}

echo comprobarPass("Abc123");
echo "\n";
echo comprobarPass("ABC39487");
echo "\n";

// Genera el patrón para validar una IPv4

echo "IPv4 \n";

function comporbarIPv($IPv)
{

    $patron = '/^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/';

    return preg_match($patron, $IPv) ? "Válido" : "Inválido";
}

echo comporbarIPv("192.168.1.1");
echo "\n";
echo comporbarIPv("256.100.50.25");
echo "\n";

// Genera el patrón para validar una MAC separada por :

echo "MAC separado por : \n";

function comprobarMac($Mac)
{

    $patron = '/^([0-9A-Fa-f]{2}(:)){5}[0-9A-Fa-f]{2}$/';
    return preg_match($patron, $Mac) ? "Válido" : "Inváldio";
}

echo comprobarMac("00:1A:2B:3C:4D:5E"); // Dirección MAC válida
echo "\n";
echo comprobarMac("00:1G:2B:3C:4D:5E"); // Dirección MAC inválida
echo "\n";


// Genera el patrón para validar una MAC separada por -

echo "MAC separado por - \n";

function comprobarMacGuion($Mac)
{

    $patron = '/^([0-9A-Fa-f]{2}(-)){5}[0-9A-Fa-f]{2}$/';
    return preg_match($patron, $Mac) ? "Válido" : "Inváldio";
}

echo comprobarMacGuion("00-1A-2B-3C-4D-5E"); // Dirección MAC válida
echo "\n";
echo comprobarMacGuion("00-1G-2B-3C-4D-5E"); // Dirección MAC inválida
echo "\n";

// Genera el patrón para validar una matrícula de vehículo español

echo "Matricula de coche: \n";
function comprobaMatricula($matricula)
{
    $patron = '/^[0-9]{4}[A-Z]{3}$/';

    return preg_match($patron, $matricula) ? "Válido" : "Inválido";
}

echo comprobaMatricula("1234ABC"); 
echo "\n";
echo comprobaMatricula("1234AB"); 
echo "\n";


