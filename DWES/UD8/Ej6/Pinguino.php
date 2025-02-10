<?php

/**
 * @author Adrián López Pascual
 */

 include_once "Ave.php";

 class Pinguino extends Ave {
     public function alimentarse() {
         echo "Pingüino {$this->nombre}: Estoy comiendo peces<br>
";
     }
 
     public function pia() {
         echo "Pingüino {$this->nombre}: Soy un pingüino programando en PHP<br>
";
     }

     public function programar() {
        echo "Pingüino {$this->nombre}: Estoy programando en PHP 🐧<br>
";
    }
 }


