<?php

/**
 * @author Adrián López Pascual
 */


include_once 'Publicacion.php';

class Revista extends Publicacion {
    private $numeroPublicacion; // Número de la publicación

    // Constructor de la clase
    public function __construct($ISBN, $titulo, $año, $numeroPublicacion) {
        parent::__construct($ISBN, $titulo, $año); // Llama al constructor de Publicacion
        $this->numeroPublicacion = $numeroPublicacion;
    }

    // function __toString()
    public function __toString() {
        return parent::__toString() . ", Número de publicación: $this->numeroPublicacion\n";
    }
}
