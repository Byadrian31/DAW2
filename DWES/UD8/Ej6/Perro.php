<?php

/**
 * @author Adrián López Pascual
 */

 include_once "Mamifero.php";
 class Perro extends Mamifero {
     private $raza;
 
     public function __construct($sexo = "M", $nombre = "", $raza = "Desconocida") {
         parent::__construct($sexo, $nombre);
         $this->raza = $raza;
     }
 
     public function alimentarse() {
         echo "Perro {$this->nombre}: Estoy comiendo carne<br>
";
     }
 
     public function ladra() {
         echo "Perro {$this->nombre}: Guau guau<br>
";
     }
 
     public function __toString() {
         $descripcion = parent::__toString();
         return str_replace("<br>
", ", raza {$this->raza}" . ($this->nombre ? " y mi nombre es {$this->nombre}" : " y no tengo nombre") . "<br>
", $descripcion);
     }
 }
