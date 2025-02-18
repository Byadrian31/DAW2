<?php

/**
 * Clase Gato que hereda de Mamifero.
 * Representa un gato con características específicas.
 * 
 * @author Adrián López Pascual
 */
include_once "Mamifero.php";
class Gato extends Mamifero {
private $raza;

    /**
     * Constructor de la clase Gato.
     * Llama al constructor de la clase padre y asigna la raza.
     * 
     * @param string $sexo Sexo del gato ("H" para hembra o "M" para macho, por defecto "M").
     * @param string $nombre Nombre opcional del gato.
     * @param string $raza Raza del gato, por defecto "Desconocida".
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
     * Simula que el gato se alimenta.
     */
    public function alimentarse() {
        echo "Gato {$this->getNombre()}: Estoy comiendo pescado<br>
";
    }

    /**
     * Método para simular el maullido del gato.
     */
    public function maulla() {
        echo "Gato {$this->getNombre()}: Miauuuu<br>
";
    }

        /**
     * Método mágico __toString para obtener una representación en cadena del gato.
     * Devuelve una descripción del gato con su raza y nombre si lo tiene.
     * 
     * @return string Información sobre el gato.
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
