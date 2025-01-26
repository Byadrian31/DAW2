<?php

/**
 * @author
 */

/* 
Usa el formulario (Ejercicio 22 UD5) que guarde en una Cookie la preferencia del usuario de si
desea o no recibir publicidad y que muestre la opción anterior y la nueva elegida en caso de que
la modifique.
 */

// Procesar el formulario al enviarlo
if (isset($_POST['enviar'])) {
    // Verificar si el usuario marcó la casilla de recibir publicidad
    $recibirPublicidad = isset($_POST['cond']) ? "Sí" : "No";

    // Guardar la preferencia actual en una cookie
    setcookie('preferencia_anterior', $recibirPublicidad, time() + 3600); // Duración de 1 hora

    // Mostrar la nueva elección
    echo "<h3>Preferencia actual:</h3>";
    echo "<p>Desea recibir publicidad: <strong>$recibirPublicidad</strong></p>";
}

// Mostrar la preferencia anterior si existe una cookie
if (isset($_COOKIE['preferencia_anterior'])) {
    echo "<h3>Preferencia anterior:</h3>";
    echo "<p>Deseaba recibir publicidad: <strong>" . $_COOKIE['preferencia_anterior'] . "</strong></p>";
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adrián López Pascual</title>
</head>

<body>

    <h1>Adrián López Pascual</h1>

    <form action="" method="post">
        <fieldset>
            <legend>Correo electrónico</legend>
            <label for="email">Correo electrónico:</label>
            <input type="email" name="email" required> <br>
            Acepto recibir publicidad
            <input type="checkbox" name="cond"> <br>
            <input type="submit" value="Enviar" name="enviar">
            <input type="reset" value="Borrar">
        </fieldset>
    </form>

</body>

</html>
