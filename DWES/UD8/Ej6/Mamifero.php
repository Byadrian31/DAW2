<?php

/**
 * Clase abstracta Mamifero que hereda de Animal.
 * Representa mamíferos con características específicas.
 * 
 * @author Adrián López Pascual
 */
include_once "Animal.php";

abstract class Mamifero extends Animal {
    // Contador estático para rastrear el número total de mamíferos creados.
    protected static $totalMamiferos = 0;

    /**
     * Constructor de la clase Mamifero.
     * Llama al constructor de la clase padre y aumenta el contador de mamíferos.
     * 
     * @param string $sexo Puede ser "H" para hembra o "M" para macho (por defecto "M").
     * @param string $nombre Nombre opcional del mamífero.
     */
    public function __construct($sexo = "M", $nombre = "") {
        parent::__construct($sexo, $nombre);
        self::$totalMamiferos++;
    }

    /**
     * Método estático para obtener el total de mamíferos creados.
     * 
     * @return string Mensaje con el número total de mamíferos.
     */
    public static function getTotalMamiferos() {
        return "Hay un total de " . self::$totalMamiferos . " mamíferos<br>";
    }

    /**
     * Método para simular la acción de amamantar.
     * Solo las hembras pueden amamantar a sus crías.
     */
    public function amamantar() {
        if ($this->sexo === "H") {
            echo get_called_class() . " {$this->nombre}: Amamantando a mis crías<br>";
        } else {
            echo get_called_class() . " {$this->nombre}: Soy macho, no puedo amamantar<br>";
        }
    }

    /**
     * Método que simula la muerte del mamífero.
     * Llama al método de la clase padre y reduce el contador de mamíferos.
     */
    public function morirse() {
        parent::morirse();
        self::$totalMamiferos--;
    }
}
