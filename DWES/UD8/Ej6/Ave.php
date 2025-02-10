<?php

/**
 * @author Adrián López Pascual
 */

 include_once "Animal.php";
 abstract class Ave extends Animal {
     protected static $totalAves = 0;
 
     public function __construct($sexo = "M", $nombre = "") {
         parent::__construct($sexo, $nombre);
         self::$totalAves++;
     }
 
     public static function getTotalAves() {
         return "Hay un total de " . self::$totalAves . " aves<br>
";
     }
 
     public function ponerHuevo() {
         if ($this->sexo === "H") {
             echo get_called_class() . " {$this->nombre}: He puesto un huevo!<br>
";
         } else {
             echo get_called_class() . " {$this->nombre}: Soy macho, no puedo poner huevos<br>
";
         }
     }
 
     public function morirse() {
         parent::morirse();
         self::$totalAves--;
     }
 }
