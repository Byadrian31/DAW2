<?php

/**
 * @author Adrián López Pascual
 */
/* 
Usa el formulario del ejercicio 1 de Cookies de saludo o despedida de modo que uses la sesión
para mostrar el usuario y saludo actuales y además muestre el usuario y saludo anterior.
*/

session_start(); // Iniciar sesión

if (isset($_POST['enviar'])) {
    if (isset($_POST['nombre']) && isset($_POST['saludo'])) {
        $nombre = $_POST['nombre'];
        $saludo = $_POST['saludo'];

        // Guardar datos actuales en la sesión
        $_SESSION['actual'] = [
            'nombre' => $nombre,
            'saludo' => $saludo
        ];

        // Mostrar datos actuales
        echo "El nombre es <strong>$nombre</strong> y el saludo es <strong>$saludo</strong>.<br>";

        // Mostrar datos anteriores si existen
        if (isset($_SESSION['anterior'])) {
            $nombreAnterior = $_SESSION['anterior']['nombre'];
            $saludoAnterior = $_SESSION['anterior']['saludo'];
            echo "El anterior nombre es <strong>$nombreAnterior</strong> y el anterior saludo es <strong>$saludoAnterior</strong>.<br>";
        } else {
            echo "No hay datos anteriores.<br>";
        }

        // Actualizar datos anteriores con los actuales
        $_SESSION['anterior'] = $_SESSION['actual'];
    } else {
        echo "No se ha introducido el nombre o el saludo.";
    }
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
    <form action="" method="post">
        <fieldset>
            <legend>Formulario</legend>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" placeholder="Nombre" required><br>
            <label for="saludo">Saludo</label>
            <input type="radio" name="saludo" value="saludo" required>
            <label for="despedida">Despedida</label>
            <input type="radio" name="saludo" value="despedida" required><br>
            <input type="submit" value="Enviar" name="enviar">
        </fieldset>
    </form>
</body>

</html>
