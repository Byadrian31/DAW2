<?php

/**
 * Clase Lagarto que hereda de Animal.
 * Representa un lagarto con características específicas.
 * 
 * @author Adrián López Pascual
 */
include_once "Animal.php";
class Lagarto extends Animal {
    /**
     * Implementación del método abstracto alimentarse.
     * Simula que el lagarto se alimenta de insectos.
     */
    public function alimentarse() {
        echo "Lagarto {$this->nombre}: Estoy comiendo insectos<br>";
    }

    /**
     * Método para simular que el lagarto toma el sol.
     */
    public function tomarSol() {
        echo "Lagarto {$this->nombre}: Estoy tomando el sol<br>";
    }
}
 
