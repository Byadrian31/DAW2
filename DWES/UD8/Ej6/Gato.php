<?php

/**
 * Clase Gato que hereda de Mamifero.
 * Representa un gato con características específicas.
 * 
 * @author Adrián López Pascual
 */
include_once "Mamifero.php";
class Gato extends Mamifero {
    /**
     * Implementación del método abstracto alimentarse.
     * Simula que el gato se alimenta.
     */
    public function alimentarse() {
        echo "Gato {$this->nombre}: Estoy comiendo pescado<br>";
    }

    /**
     * Método para simular el maullido del gato.
     */
    public function maulla() {
        echo "Gato {$this->nombre}: Miauuuu<br>";
    }
}
