<?php

/**
 * @author Adrián López Pascual
 */
/* 
Crea un formulario sencillo donde el usuario indique su nombre y seleccione si quiere  un 
saludo o despedida. Se debe almacenar en una Cookie el usuario y el saludo y al pulsar Enviar, 
se debe indicar los valores actuales (usuario y saludo o despedida elegidos) y los valores del 
usuario anterior y acción elegida almacenadas en la Cookie
*/

if (isset($_POST['enviar'])) {
    if (isset($_POST['nombre']) && isset($_POST['saludo'])) {
        $nombre = $_POST['nombre'];
        $saludo = $_POST['saludo'];
        $texto = implode(",", [$nombre, $saludo]);

        setcookie('datos', $texto, time() + 3600);

        echo "El nombre es " . $nombre . " y el saludo es " . $saludo . ".<br>";
        
        if (isset($_COOKIE['datos'])) {
            $cookie = explode(",", $_COOKIE['datos']);
            $ncook = $cookie[0];
            $scook = $cookie[1];
            echo "El anterior nombre es " . $ncook . " y el anterior saludo es " . $scook . ".<br>";
        } else {
            echo "No hay datos anteriores.";
        }
    } else {
        echo "No se ha introducido el nombre o el saludo";
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
            <input type="radio" name="saludo" value="saludo">
            <label for="despedida">Despedida</label>
            <input type="radio" name="saludo" value="despedida"><br>
            <input type="submit" value="Enviar" name="enviar">
        </fieldset>
    </form>
</body>

</html>