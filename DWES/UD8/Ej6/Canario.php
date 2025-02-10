<?php

/**
 * @author Adrián López Pascual
 */

 include_once "Ave.php";
 class Canario extends Ave {
     public function alimentarse() {
         echo "Canario {$this->nombre}: Estoy comiendo alpiste<br>
";
     }
 

     public function pia() {
         echo "Canario {$this->nombre}: Pio pio pio<br>
";
     }
 }
