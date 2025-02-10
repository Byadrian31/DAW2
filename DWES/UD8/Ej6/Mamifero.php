<?php

/**
 * @author Adrián López Pascual
 */

 include_once "Animal.php";
 abstract class Mamifero extends Animal {
     protected static $totalMamiferos = 0;
 
     public function __construct($sexo = "M", $nombre = "") {
         parent::__construct($sexo, $nombre);
         self::$totalMamiferos++;
     }
 
     public static function getTotalMamiferos() {
         return "Hay un total de " . self::$totalMamiferos . " mamíferos<br>
";
     }
 
     public function amamantar() {
         if ($this->sexo === "H") {
             echo get_called_class() . " {$this->nombre}: Amamantando a mis crías<br>
";
         } else {
             echo get_called_class() . " {$this->nombre}: Soy macho, no puedo amamantar<br>
";
         }
     }
 
     public function morirse() {
         parent::morirse();
         self::$totalMamiferos--;
     }
 }
