<?php

/**
 * @author Adrián López Pascual
 */

// Clase abstracta Publicacion, no se puede instanciar directamente
abstract class Publicacion {
    protected $ISBN;
    protected $titulo;
    protected $año;

    // Constructor de la clase
    public function __construct($ISBN, $titulo, $año = 2024) {
        $this->ISBN = $ISBN;
        $this->titulo = $titulo;
        $this->año = $año;
    }

    // function __toString()
    public function __toString() {
        return "ISBN: $this->ISBN, Título: \"$this->titulo\", Año: $this->año";
    }
}
