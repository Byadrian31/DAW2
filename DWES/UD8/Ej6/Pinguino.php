<?php

/**
 * Clase Pinguino que hereda de Ave.
 * Representa un pingüino con características específicas.
 * 
 * @author Adrián López Pascual
 */
include_once "Ave.php";
class Pinguino extends Ave {
    /**
     * Implementación del método abstracto alimentarse.
     * Simula que el pingüino se alimenta de peces.
     */
    public function alimentarse() {
        echo "Pingüino {$this->nombre}: Estoy comiendo peces<br>";
    }

    /**
     * Método para simular el sonido del pingüino.
     */
    public function pia() {
        echo "Pingüino {$this->nombre}: Soy un pingüino programando en PHP<br>";
    }

    /**
     * Método para simular que el pingüino programa en PHP.
     */
    public function programar() {
        echo "Pingüino {$this->nombre}: Estoy programando en PHP 🐧<br>";
    }
}