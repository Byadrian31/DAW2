<?php
/**
 * Clase Canario que hereda de Ave.
 * Representa a los canarios con características específicas.
 * 
 * @author Adrián López Pascual
 */
include_once "Ave.php";
class Canario extends Ave {
    /**
     * Implementación del método abstracto alimentarse.
     * Simula que el canario se alimenta.
     */
    public function alimentarse() {
        echo "Canario {$this->nombre}: Estoy comiendo alpiste<br>
";
    }

    /**
     * Método para simular el canto del canario.
     */
    public function pia() {
        echo "Canario {$this->nombre}: Pio pio pio<br>
";
    }
}
