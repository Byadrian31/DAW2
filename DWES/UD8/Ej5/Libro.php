<?php

/**
 * @author Adrián López Pascual
 */

include_once 'Publicacion.php';

class Libro extends Publicacion {
    private $prestado; // Estado de préstamo del libro

    // Constructor de la clase
    public function __construct($ISBN, $titulo, $año) {
        parent::__construct($ISBN, $titulo, $año); // Llama al constructor de Publicacion
        $this->prestado = false; // Inicializa como no prestado
    }

    // function presta() para prestar un libro
    public function presta() {
        if ($this->prestado) {
            echo "❌ El libro \"$this->titulo\" ya está prestado.\n";
        } else {
            $this->prestado = true;
            echo "📚 El libro \"$this->titulo\" ha sido prestado.\n";
        }
    }

    // function devuelve() para devolver un libro
    public function devuelve() {
        if (!$this->prestado) {
            echo "⚠️ El libro \"$this->titulo\" no está prestado.\n";
        } else {
            $this->prestado = false;
            echo "✅ El libro \"$this->titulo\" ha sido devuelto.\n";
        }
    }

    // function mostrarPrestado() para mostrar si un libro está prestado o no
    public function mostrarPrestado() {
        $estado = $this->prestado ? "📕 Prestado" : "📗 Disponible";
        echo "El libro \"$this->titulo\" está actualmente: $estado.\n";
    }

    // function __toString()
    public function __toString() {
        $estado = $this->prestado ? "📕 Prestado" : "📗 Disponible";
        return parent::__toString() . ", Estado: $estado\n";
    }
}
