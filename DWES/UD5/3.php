<?php

/**
 * @author Adrián López Pascual
 */


/*
3. Ejercicios 11 y 12 unirlos en una calculadora de euros que convierta de euros a pesetas y de 
pesetas a euros según lo que elija el usuario (de forma excluyente) y por la cantidad que 
introduzca. Comprueba que los datos introducidos son los esperados.
*/

 // Función para realizar la conversión correspondiente
 function convertir($op, $cant){
    $cambio = 166.386;
    if ($op == "euros") { 
        $pesetas = $cant*$cambio;
        echo $cant . "€ es igual a " . $pesetas . " pesetas";
    } else {
        $euros = $cant/$cambio;
        echo $cant . " pesetas es igual a " . $euros . "€";
    }
 
 }
// Condición que espera al botón Enviar
if (isset($_POST['enviar'])) {
    $cant = $_POST['cant'];
    $op = $_POST['conversor'];
    if (is_numeric($cant)) {
        echo convertir($op,$cant);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adrián López Pascual</title>
</head>

<body>
    <h1>Adrián López Pascual</h1>
    <form action="" method="post">
        <fieldset>
            <legend>€ a pesetas / pesetas a €</legend>
            <label for="conversor">Conversor:</label>
            <input type="radio" name="conversor" value="euros"> € a pesetas
            <input type="radio" name="conversor" value="pesetas"> pesetas a €<br>
            <label for="cant">Cantidad:</label>
            <input type="text" name="cant"><br>
            <input type="submit" value="Enviar" name="enviar">
        </fieldset>
    </form>
</body>

</html>