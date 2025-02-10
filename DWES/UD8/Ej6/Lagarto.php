<?php

/**
 * @author Adrián López Pascual
 */

 include_once "Animal.php";
 class Lagarto extends Animal {
     public function alimentarse() {
         echo "Lagarto {$this->nombre}: Estoy comiendo insectos<br>
";
     }
 
     public function tomarSol() {
         echo "Lagarto {$this->nombre}: Estoy tomando el sol<br>
";
     }
 }
 
