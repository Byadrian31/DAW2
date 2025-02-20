<?php

/**
 * Clase abstracta Ave que hereda de Animal.
 * Representa aves con características específicas.
 * 
 * @author Adrián López Pascual
 */
include_once "Animal.php";

abstract class Ave extends Animal {
    // Contador estático para rastrear el número total de aves creadas.
    protected static $totalAves = 0;

    /**
     * Constructor de la clase Ave.
     * Llama al constructor de la clase padre y aumenta el contador de aves.
     * 
     * @param string $sexo Puede ser "H" para hembra o "M" para macho (por defecto "M").
     * @param string $nombre Nombre opcional del ave.
     */
    public function __construct($sexo = "M", $nombre = "") {
        parent::__construct($sexo, $nombre);
        self::$totalAves++;
    }

    /**
     * Método estático para obtener el total de aves creadas.
     * 
     * @return string Mensaje con el número total de aves.
     */
    public static function getTotalAves() {
        return "Hay un total de " . self::$totalAves . " aves<br>
";
    }

    /**
     * Método para simular la puesta de un huevo.
     * Solo las hembras pueden poner huevos.
     */
    public function ponerHuevo() {
        if ($this->getSexo() === "H") {
            echo get_called_class() . " {$this->getNombre()}: He puesto un huevo!<br>
";
        } else {
            echo get_called_class() . " {$this->getNombre()}: Soy macho, no puedo poner huevos<br>
";
        }
    }

    /**
     * Método que simula la muerte del ave.
     * Llama al método de la clase padre y reduce el contador de aves.
     */
    public function morirse() {
        parent::morirse();
        self::$totalAves--;
    }
}
