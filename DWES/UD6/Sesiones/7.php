<?php

/**
 * @author Adrián López Pascual
 */

/* 
Usa el formulario del ejercicio 7 de Cookies de caja fuerte de modo que uses la sesión para
mostrar la contraseña introducida y el número de intentos actuales y además muestre las
contraseñas introducidas de la ejecución anterior. Si abre la caja o llega al máximo de intentos, a
los datos anteriores se añadirá la contraseña correcta y un mensaje de éxito o no conseguido.
 */

session_start(); // Iniciar la sesión

// Inicializar la clave, los intentos y las contraseñas introducidas
if (!isset($_SESSION['clave'])) {
    $_SESSION['clave'] = rand(1000, 9999); // Generar una clave aleatoria de 4 dígitos
    $_SESSION['intentos'] = 4; // Número inicial de intentos
    $_SESSION['contraseñas_usadas'] = []; // Array para almacenar contraseñas usadas
}

$clave = $_SESSION['clave'];
$intentos = $_SESSION['intentos'];
$contraseñas_usadas = $_SESSION['contraseñas_usadas'];
$mensaje = "";

// Procesar el formulario si se ha enviado
if (isset($_POST['enviar'])) {
    $combinacion = $_POST['combinacion'];

    if (is_numeric($combinacion) && strlen($combinacion) == 4) {
        $intentos--; // Reducir los intentos
        $_SESSION['intentos'] = $intentos;

        // Almacenar la contraseña introducida
        $_SESSION['contraseñas_usadas'][] = $combinacion;
        $contraseñas_usadas = $_SESSION['contraseñas_usadas']; // Actualizar el array

        // Verificar si la combinación es correcta
        if ($combinacion == $clave) {
            $mensaje = "<p style='color: green;'>La caja fuerte se ha abierto satisfactoriamente.</p>";
            $_SESSION['resultado'] = "Éxito: La clave correcta era $clave";
            session_unset(); // Reiniciar el juego
        } else {
            $mensaje = "<p style='color: red;'>Lo siento, esa no es la combinación.</p>";
        }

        // Si los intentos se han agotado
        if ($intentos == 0) {
            $mensaje .= "<p>Juego terminado. La clave correcta era: " . $clave . "</p>";
            $_SESSION['resultado'] = "Fallido: La clave correcta era $clave";
            session_unset(); // Reiniciar el juego
        }
    } else {
        $mensaje = "<p style='color: red;'>La clave debe ser un número de 4 dígitos.</p>";
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
    // Mostrar mensaje si existe
    if ($mensaje) {
        echo $mensaje;
    }

    // Mostrar formulario si aún quedan intentos
    if (isset($_SESSION['intentos']) && $_SESSION['intentos'] > 0) {
        ?>
        <h3><?php echo "Intentos restantes: " . $_SESSION['intentos']; ?></h3>
        <form action="" method="post">
            <fieldset>
                <legend>Caja fuerte</legend>
                <label for="num">Clave:</label>
                <input type="text" name="combinacion" maxlength="4" required>
                <input type="submit" value="Enviar" name="enviar">
            </fieldset>
        </form>
        <?php
    }

    // Mostrar contraseñas introducidas si existen
    if (!empty($contraseñas_usadas)) {
        echo "<h3>Contraseñas introducidas:</h3>";
        echo implode(", ", $contraseñas_usadas);
    }

    // Mostrar resultado final si el juego ha terminado
    if (isset($_SESSION['resultado'])) {
        echo "<h3>Resultado final:</h3>";
        echo $_SESSION['resultado'];
    }
    ?>
</body>

</html>
