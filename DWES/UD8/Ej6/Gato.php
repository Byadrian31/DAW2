<?php

/**
 * @author Adrián López Pascual
 */

 include_once "Mamifero.php";
 class Gato extends Mamifero {
     public function alimentarse() {
         echo "Gato {$this->nombre}: Estoy comiendo pescado<br>
";
     }
 
     public function maulla() {
         echo "Gato {$this->nombre}: Miauuuu<br>
";
     }
 }
