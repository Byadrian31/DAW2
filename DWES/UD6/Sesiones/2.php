<?php

/**
 * @author Adrián López Pascual
 */

/*
Usa el formulario del ejercicio 2 de Cookies con selección de color, idioma y ciudad de modo
que uses la sesión para mostrar el nombre del usuario, color, idioma y ciudad actuales y además
muestre el nombre del usuario, color, idioma y ciudad anterior.
 */

session_start(); // Iniciar la sesión

if (isset($_POST['enviar'])) {
    if (isset($_POST['nombre']) && isset($_POST['idioma']) && isset($_POST['color']) && isset($_POST['ciudades'])) {
        $nombre = $_POST['nombre'];
        $idioma = $_POST['idioma'];
        $color = $_POST['color'];
        $ciudades = $_POST['ciudades'];

        // Guardar los datos actuales en la sesión
        $datosActuales = [
            'nombre' => $nombre,
            'idioma' => $idioma,
            'color' => $color,
            'ciudades' => $ciudades
        ];

        // Mostrar los datos actuales
        echo "<h3>Datos actuales:</h3>";
        echo "El nombre es <strong>$nombre</strong>, el idioma es <strong>$idioma</strong>, el color es <strong>$color</strong> y las ciudades son: ";
        foreach ($ciudades as $ciudad) {
            echo htmlspecialchars($ciudad) . " ";
        }
        echo "<br>";

        // Mostrar los datos anteriores si existen
        if (isset($_SESSION['actual'])) {
            $datosAnteriores = $_SESSION['actual'];
            echo "<h3>Datos anteriores:</h3>";
            echo "El nombre era <strong>{$datosAnteriores['nombre']}</strong>, el idioma era <strong>{$datosAnteriores['idioma']}</strong>, el color era <strong>{$datosAnteriores['color']}</strong> y las ciudades eran: ";
            foreach ($datosAnteriores['ciudades'] as $ciudadAnterior) {
                echo htmlspecialchars($ciudadAnterior) . " ";
            }
            echo "<br>";
        } else {
            echo "<h3>No hay datos anteriores.</h3>";
        }

        // Ahora actualizamos los datos anteriores a los actuales
        $_SESSION['actual'] = $datosActuales;
    } else {
        echo "<p style='color: red;'>Por favor, complete todos los campos del formulario.</p>";
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
            <label for="idioma">Idioma</label>
            <select name="idioma" required>
                <option value="Castellano">Castellano</option>
                <option value="Valenciano">Valenciano</option>
                <option value="Ingles">Inglés</option>
            </select>
            <br>
            <label for="color">Color</label>
            <input type="radio" name="color" value="rojo" required> Rojo
            <input type="radio" name="color" value="azul" required> Azul <br>
            <label for="ciudad">Ciudad</label> <br>
            <input type="checkbox" name="ciudades[]" value="Valencia"> Valencia <br>
            <input type="checkbox" name="ciudades[]" value="Barcelona"> Barcelona<br>
            <input type="checkbox" name="ciudades[]" value="Madrid"> Madrid<br>
            <input type="checkbox" name="ciudades[]" value="Sevilla"> Sevilla<br>
            <input type="submit" value="Enviar" name="enviar">
        </fieldset>
    </form>
</body>

</html>
