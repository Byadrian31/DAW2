<?php

/**
 * @author Adrián López Pascual
 */

/* 
Usa el formulario (Ejercicio 12 UD5) de la caja fuerte donde se indique la contraseña y muestre
las contraseñas ya introducidas y el número de intentos guardando estos datos en una Cookie.
Se deben mostrar la contraseña correcta, las contraseñas ya introducidas y el número de intentos
(cookie).
 */

// Inicializar clave e intentos si no están configurados
if (!isset($_COOKIE['clave']) || !isset($_COOKIE['intentos'])) {
    $clave = rand(1000, 9999); // Generar una clave aleatoria de 4 dígitos
    $intentos = 4; // Establecer el número inicial de intentos
    setcookie('clave', $clave, time() + 3600); // Guardar la clave en una cookie (1 hora)
    setcookie('intentos', $intentos, time() + 3600); // Guardar los intentos en una cookie (1 hora)
    setcookie('intentos_usados', '', time() + 3600); // Inicializar la cookie para contraseñas usadas
} else {
    $clave = $_COOKIE['clave'];
    $intentos = $_COOKIE['intentos'];
}

// Inicializar una variable para las contraseñas introducidas
$contraseñas_usadas = isset($_COOKIE['intentos_usados']) ? $_COOKIE['intentos_usados'] : '';

// Procesar el formulario si se ha enviado
if (isset($_POST['enviar'])) {
    $combinacion = $_POST['combinacion'];

    if (is_numeric($combinacion) && strlen($combinacion) == 4) {
        $intentos--; // Reducir los intentos
        $contraseñas_usadas = $contraseñas_usadas ? $contraseñas_usadas . ',' . $combinacion : $combinacion;

        // Actualizar cookies antes de cualquier salida
        setcookie('intentos', $intentos, time() + 3600); // Actualizar los intentos restantes
        setcookie('intentos_usados', $contraseñas_usadas, time() + 3600); // Actualizar las contraseñas usadas

        // Verificar si la combinación es correcta
        if ($combinacion == $clave) {
            $mensaje = "<p style='color: green;'>La caja fuerte se ha abierto satisfactoriamente.</p>";
            $intentos = 0; // Terminar el juego
            setcookie('intentos', $intentos, time() + 3600);
        } else {
            $mensaje = "<p style='color: red;'>Lo siento, esa no es la combinación.</p>";
        }
    } else {
        $mensaje = "<p style='color: red;'>La clave debe ser un número de 4 dígitos.</p>";
    }

    // Si los intentos se han agotado, mostrar la clave correcta y eliminar las cookies
    if ($intentos == 0) {
        $mensaje .= "<p>Juego terminado. La clave correcta era: " . $clave . "</p>";
        setcookie('clave', '', time() - 3600); // Eliminar la cookie de la clave
        setcookie('intentos', '', time() - 3600); // Eliminar la cookie de los intentos
        setcookie('intentos_usados', '', time() - 3600); // Eliminar la cookie de contraseñas usadas
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
    if (isset($mensaje)) {
        echo $mensaje;
    }

    // Mostrar formulario si aún quedan intentos
    if ($intentos > 0) {
        ?>
        <h3><?php echo "Intentos restantes: " . $intentos; ?></h3>
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
    if ($contraseñas_usadas) {
        echo "<h3>Contraseñas introducidas:</h3>";
        echo $contraseñas_usadas;
    }
    ?>
</body>

</html>
