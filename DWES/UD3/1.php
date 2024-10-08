<?php
/**
 * @author Adrián López Pascual
*/

$texto = readline("Dime un carácter: ");

if (ctype_upper($texto)) {
    echo "Carácter: letra mayúscula \n";
}elseif (ctype_lower($texto)) {
    echo "Carácter: letra minúscula \n";
}elseif (ctype_digit($texto)) {
    echo "Carácter: número\n";
}elseif (ctype_space($texto)) {
    echo "Carácter: blanco\n";
}elseif (ctype_punct($texto)) {
    echo "Carácter: puntuación\n";
} else {
    echo "Carácter: especial\n";
}
?>