<?php

/**
 * @author Adrián López Pascual
 */

/*
5. Ejercicio 1: Elabora un programa que dado un carácter introducido por el usuario y determine 
si es:
1. una letra mayúscula 4. un carácter blanco
2. una letra minúscula 5. un carácter de puntuación
3. un carácter numérico 6. un carácter especial
Se debe usar funciones para la comprobación de datos.
*/

if (isset($_POST['enviar'])) {
    $car = $_POST['car'];
    //Uso la función ctype_* cambiando * por el indicado en cada caso 
    if (ctype_upper($car)) {
        echo "Carácter: letra mayúscula \n";
    } elseif (ctype_lower($car)) {
        echo "Carácter: letra minúscula \n";
    } elseif (ctype_digit($car)) {
        echo "Carácter: número \n";
    } elseif (ctype_space($car)) {
        echo "Carácter: blanco \n";
    } elseif (ctype_punct($car)) {
        echo "Carácter: puntuación \n";
    } else {
        echo "Carácter: especial \n";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adrián López Pascual</title>
</head>

<body>
    <h1>Adrián López Pascual</h1>
    <form action="" method="post">
        <fieldset>
            <legend>Carácteres</legend>
            <label for="carácter">Carácter:</label>
            <input type="text" name="car" maxlength="1">
            <input type="submit" value="Enviar" name="enviar">
        </fieldset>
    </form>
</body>

</html>