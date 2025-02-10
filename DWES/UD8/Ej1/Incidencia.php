<?php

/**
 * @author Adrián López Pascual
 */

/*
Una empresa quiere implementar un programa que lleve el control de las incidencias que se
producen en sus ordenadores. Cada incidencia tiene un código: 1, 2, 3, 4, etc. Cuando se crea
una nueva incidencia, se le asigna un código de forma automática y se pone el estado como
“pendiente”. Al crear una incidencia hay que indicar también el número de puesto (un número
entero). Cuando se resuelve una incidencia, hay que proporcionar información sobre cómo se ha
resuelto o qué es lo que fallaba, además, el estado pasa a “resuelta”.
*/

class Incidencia
{
    // Contador estático para el número total de incidencias pendientes
    private static $pendientes = 0;

    // Contador estático para asignar códigos únicos a cada incidencia
    private static $contador = 0;

    // Atributos de cada incidencia
    private $codigo;      // Código único de la incidencia
    private $estado;      // Estado de la incidencia ("Pendiente" o "Resuelta")
    private $puesto;      // Número de puesto donde ocurre la incidencia
    private $problema;    // Descripción del problema reportado
    private $solucion;    // Descripción de la solución aplicada (vacío hasta que se resuelva)


    public function __construct($puesto, $problema)
    {
        $this->codigo = ++self::$contador; // Asigna un código único a la incidencia
        $this->estado = "Pendiente";       // Inicializa el estado como "Pendiente"
        $this->puesto = $puesto;           // Asigna el número del puesto
        $this->problema = $problema;       // Guarda la descripción del problema
        self::$pendientes++;               // Incrementa el número total de incidencias pendientes
    }


    public function resuelve($solucion)
    {
        $this->solucion = $solucion; // Guarda la solución aplicada
        $this->estado = "Resuelta";  // Cambia el estado a "Resuelta"
        self::$pendientes--;         // Disminuye el número de incidencias pendientes
    }


    public static function getPendientes()
    {
        return self::$pendientes; // Número de incidencias sin resolver
    }

    public function __toString()
    {
        // Construye la cadena con los datos de la incidencia
        $resultado = "Incidencia " . $this->codigo . " - Puesto: " . $this->puesto . " - " . $this->problema . " - " . $this->estado;
        
        // Si la incidencia está resuelta, se agrega la solución
        if ($this->estado == "resuelta") {
            $resultado = "Incidencia " . $this->codigo . " - Puesto: " . $this->puesto . " - " . $this->estado . " - " . $this->problema . " - " . $this->solucion;
        }

        return $resultado . "\n"; // Retorna la descripción de la incidencia con un salto de línea
    }
}
