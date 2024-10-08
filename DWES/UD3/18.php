<?php

/**
 * @author Adrián López Pascual
 */
$num = readline("Dime el número: ");

if ($num % 2 == 0) {
    print "Las cifras del centro son: " . substr($num,(strlen($num)/2)-1,2) . "\n";
} else {
    print "Las cifras del centro son: " . substr($num,(strlen($num)/2),1) . "\n";
}

?>