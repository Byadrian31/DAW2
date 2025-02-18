<?php

/**
 * Clase Perro que hereda de Mamifero.
 * Representa un perro con características específicas.
 * 
 * @author Adrián López Pascual
 */
include_once "Mamifero.php";
class Perro extends Mamifero {
    // Atributo para almacenar la raza del perro.
    private $raza;

    /**
     * Constructor de la clase Perro.
     * Llama al constructor de la clase padre y asigna la raza.
     * 
     * @param string $sexo Sexo del perro ("H" para hembra o "M" para macho, por defecto "M").
     * @param string $nombre Nombre opcional del perro.
     * @param string $raza Raza del perro, por defecto "Desconocida".
     */
    public function __construct($sexo = "M", $nombre = "", $raza = "teckel") {
        parent::__construct($sexo, $nombre);
        $this->raza = $raza;
    }

    /**
     * Métodos Getters y Setters
     */
    public function getRaza() {
        return $this->raza;
    }

    public function setRaza($raza) {
        $this->raza = $raza;
    }

    /**
     * Implementación del método abstracto alimentarse.
     * Simula que el perro se alimenta.
     */
    public function alimentarse() {
        echo "Perro {$this->getNombre()}: Estoy comiendo carne<br>
";
    }

    /**
     * Método para simular el ladrido del perro.
     */
    public function ladra() {
        echo "Perro {$this->getNombre()}: Guau guau<br>
";
    }

    /**
     * Método mágico __toString para obtener una representación en cadena del perro.
     * Devuelve una descripción del perro con su raza y nombre si lo tiene.
     * 
     * @return string Información sobre el perro.
     */
    public function __toString() {
        // Llamamos al método padre para obtener la descripción base
        $descripcion = parent::__toString();
        $descripcion = preg_replace('/<br>\s*$/', '', $descripcion);

        if (strpos($descripcion, "llamado " . $this->getNombre()) !== false) {
            $nombrePattern = "/, llamado " . preg_quote($this->getNombre(), '/') . "/";
            $descripcion = preg_replace($nombrePattern, '', $descripcion);
            // Retornamos la descripción con la raza y el nombre correctamente formateados
            return $descripcion . ", raza {$this->getRaza()} y mi nombre es {$this->getNombre()}<br>\n";
        }else {
            return $descripcion . ", raza {$this->getRaza()} y no tengo nombre<br>\n";
        }
    }
    
    
}
