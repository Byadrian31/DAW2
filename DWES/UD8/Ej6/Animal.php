<?php

/**
 * Clase abstracta Animal que representa una entidad genérica de animal.
 * Contiene atributos y métodos comunes a todos los animales.
 * 
 * @author Adrián López Pascual
 */
abstract class Animal {
    // Contador estático para rastrear el número total de animales creados.
    protected static $totalAnimales = 0;
    
    // Atributos de cada animal: sexo y nombre.
    protected $sexo;
    protected $nombre;

    /**
     * Constructor de la clase Animal.
     * Se encarga de inicializar el sexo y el nombre del animal.
     * 
     * @param string $sexo Puede ser "H" para hembra o "M" para macho (por defecto "M").
     * @param string $nombre Nombre opcional del animal.
     */
    public function __construct($sexo = "M", $nombre = "") {
        // Validación del sexo, si no es "H" o "M", se asigna "M" por defecto.
        $this->sexo = ($sexo === "H" || $sexo === "M") ? $sexo : "M";
        $this->nombre = $nombre;
        
        // Incrementa el contador de animales creados.
        self::$totalAnimales++;
    }

    /**
     * Método estático para obtener el total de animales creados.
     * 
     * @return string Mensaje con el número total de animales.
     */
    public static function getTotalAnimales() {
        return "Hay un total de " . self::$totalAnimales . " animales<br>
";
    }

    /**
     * Método para simular que el animal se duerme.
     */
    public function dormirse() {
        echo "{$this->getAnimalDescripcion()}: Zzzzzzz<br>
";
    }

    /**
     * Método abstracto que obliga a las subclases a implementar su forma de alimentarse.
     */
    abstract public function alimentarse();

    /**
     * Método que simula la muerte de un animal.
     * Reduce el contador total de animales.
     */
    public function morirse() {
        echo "{$this->getAnimalDescripcion()}: Adiós!<br>
";
        self::$totalAnimales--;
    }


    /**
     * Metodos getters y setters
     * 
     */

    public function getSexo() {
        return $this->sexo;
    }

    /**
     * Establece un nuevo sexo para el animal.
     * 
    */
    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    /**
     * Devuelve el nombre del animal.
     * 
     * @return string Nombre del animal.
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Establece un nuevo nombre para el animal.
     * 
     * @param string $nombre Nuevo nombre del animal.
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    /**
     * Métodos estáticos para crear instancias del animal con diferentes parámetros.
     */

    /**
     * Crea un nuevo animal especificando solo el sexo.
     * 
     * @param string $sexo Sexo del animal.
     * @return static Instancia de la clase hija correspondiente.
     */
    public static function consSexo($sexo) {
        return new static($sexo);
    }

    /**
     * Crea un nuevo animal especificando el sexo y el nombre.
     * 
     * @param string $sexo Sexo del animal.
     * @param string $nombre Nombre del animal.
     * @return static Instancia de la clase hija correspondiente.
     */
    public static function consFull($sexo, $nombre,$raza=null) {
        return new static($sexo, $nombre,$raza);
    }

    /**
     * Método redundante de consFull, también crea un animal con sexo y nombre.
     * 
     * @param string $sexo Sexo del animal.
     * @param string $nombre Nombre del animal.
     * @return static Instancia de la clase hija correspondiente.
     */
    public static function consSexoNombre($sexo, $nombre) {
        return new static($sexo, $nombre);
    }

    /**
     * Método protegido que devuelve una descripción básica del animal.
     * 
     * @return string Nombre de la clase (tipo de animal) y su nombre si lo tiene.
     */
    protected function getAnimalDescripcion() {
        $sexoStr = ($this->sexo === "H") ? "HEMBRA" : "MACHO";
        return get_called_class() . " " . ($this->nombre ?: "");
    }

    /**
     * Método mágico __toString para obtener una representación en cadena del animal.
     * 
     * @return string Información sobre el animal (tipo, sexo y nombre).
     */
    public function __toString() {
        $sexoStr = ($this->sexo === "H") ? "HEMBRA" : "MACHO";
        
        // Determina si el animal es un Ave o un Mamífero.
        $categoria = $this instanceof Ave ? "un Ave" : ($this instanceof Mamifero ? "un Mamífero" : "");
        
        return "Soy un Animal" . ($categoria ? ", $categoria" : "") . ", en concreto un " . get_called_class() . ", con sexo $sexoStr" .
               ($this->nombre ? ", llamado $this->nombre" : "") . "<br>
";
    }
}
