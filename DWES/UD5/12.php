<?php

/**
 * @author Adrián López Pascual
 */

 /*12. Ejercicio 5. Realiza el control de acceso a una caja fuerte. La combinación será un número de 
 4 cifras. El programa nos pedirá la combinación para abrirla. Si no acertamos, se nos mostrará el 
 mensaje “Lo siento, esa no es la combinación” en color rojo y si acertamos se nos dirá “La caja 
 fuerte se ha abierto satisfactoriamente” en color verde. Tendremos cuatro oportunidades para 
 abrir la caja fuerte.*/


// Elemento clave no existe entonces se crea la clave y los intentos
// En caso de que ya esten creados se recogen de un formulario
if (!isset($_POST['clave'])) {
    // Saco 4 números random para posteriormente juntarlos para tener la clave de la caja fuerte
    $num1 = rand(0, 9);
    $num2 = rand(0, 9);
    $num3 = rand(0, 9);
    $num4 = rand(0, 9);
    $clave = $num1 . $num2 . $num3 . $num4;
    $intentos = 4; // 4 intentos
} else {
    $clave = $_POST['clave'];
    $intentos = $_POST['intentos'];
}


// Con esta función generamos el formulario en cuestión
// Hay dos campos hidden que son clave e intentos, estos campos están
// Para cumplir el isset de arriba, consiguiendo así que no se reestablezcan las variables
function generar_formulario($intentos, $clave) {
    ?>
    <h3><?php echo "Intentos restantes: " . $intentos;?></h3>
    <form action="" method="post">
        <fieldset>
            <legend>Caja fuerte</legend>
            <label for="num">Clave:</label>
            <input type="text" name="combinacion" maxlength="4" required>
            <input type="hidden" name="clave" value="<?php echo $clave; ?>">
            <input type="hidden" name="intentos" value="<?php echo $intentos; ?>">
            <input type="submit" value="Enviar" name="enviar">
        </fieldset>
    </form>
    <?php
}

// Funcionamiento del ejercicio
if (isset($_POST['enviar'])) {
    // Recojo la combinación del form
    $combinacion = $_POST["combinacion"];
        // Compruebo que sea numérico
    if (is_numeric($combinacion)) {
        // Boolean para tratar el final del juego
        $find = false;
        // Lógica del programa
        if ($intentos > 0) {
            if ($combinacion == $clave) {
                echo "<p style='color: green;'>La caja fuerte se ha abierto satisfactoriamente.</p>";
                $find = true;
                $intentos = 0; // Finaliza el juego
            } else if($combinacion != $clave) {
                echo "<p style='color: red;'>Lo siento, esa no es la combinación.</p>";
                echo $clave;
                $intentos--;
            }  
        } else if($intentos == 0 && !$find) {
            echo "No has acertado la combinación, la combinación era: " . $clave;
        }
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
    <?php 
        if ($intentos > 0) {
            generar_formulario($intentos, $clave);
        }
    ?>
</body>

</html>
