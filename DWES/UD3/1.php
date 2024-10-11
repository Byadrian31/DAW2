<?php
/**
 * @author Adrián López Pascual
*/

/*
Elabora un programa que dado un carácter determine si es:
1. una letra mayúscula
2. una letra minúscula
3. un carácter numérico
4. un carácter blanco
5. un carácter de puntuación
6. un carácter especial
*/

$texto = readline("Dime un carácter: ");

//Uso la función ctype_* cambiando * por el indicado en cada caso 
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