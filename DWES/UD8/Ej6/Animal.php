<?php

/**
 * @author Adrián López Pascual
 */

 abstract class Animal {
    protected static $totalAnimales = 0;
    protected $sexo;
    protected $nombre;

    public function __construct($sexo = "M", $nombre = "") {
        $this->sexo = ($sexo === "H" || $sexo === "M") ? $sexo : "M";
        $this->nombre = $nombre;
        self::$totalAnimales++;
    }

    public static function getTotalAnimales() {
        return "Hay un total de " . self::$totalAnimales . " animales<br>
";
    }

    public function dormirse() {
        echo "{$this->getAnimalDescripcion()}: Zzzzzzz<br>
";
    }

    abstract public function alimentarse();

    public function morirse() {
        echo "{$this->getAnimalDescripcion()}: Adiós!<br>
";
        self::$totalAnimales--;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public static function consSexo($sexo) {
        return new static($sexo);
    }

    public static function consFull($sexo, $nombre) {
        return new static($sexo, $nombre);
    }

    public static function consSexoNombre($sexo, $nombre) {
        return new static($sexo, $nombre);
    }

    protected function getAnimalDescripcion() {
        $sexoStr = ($this->sexo === "H") ? "HEMBRA" : "MACHO";
        return get_called_class() . " " . ($this->nombre ?: "");
    }

    public function __toString() {
        $sexoStr = ($this->sexo === "H") ? "HEMBRA" : "MACHO";
        $categoria = $this instanceof Ave ? "un Ave" : ($this instanceof Mamifero ? "un Mamífero" : "");
        return "Soy un Animal" . ($categoria ? ", $categoria" : "") . ", en concreto un " . get_called_class() . ", con sexo $sexoStr" .
               ($this->nombre ? ", llamado $this->nombre" : "") . "<br>
";
    }
}
