<?php

/**
 * @author Adrián López Pascual
 */

/*
 Crea un formulario en el que se le pida al usuario los siguientes datos: nombre y preferencia de 
idioma, color y ciudad. Crea una Cookie que almacene estos datos y que, al recargar la página 
por realizar una nueva selección de datos (y posiblemente usuario) muestre los datos 
introducidos en el formulario junto con los datos obtenidos de la Cookie.
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
            <label for="idioma">Idioma</label>
            <select name="idioma">
                <option value="Castellano">Castellano</option>
                <option value="Valenciano">Valenciano</option>
                <option value="Ingles">Ingles</option>
            </select>
            <label for="color">Color</label>
            <input type="radio" name="color" value="rojo"> Rojo
            <input type="radio" name="color" value="azul"> Azul <br>
            <label for="ciudad">Ciudad</label>
            <input type="checkbox" name="Valencia" value="Valencia"> Valencia
            <input type="checkbox" name="Barcelona" value="Barcelona"> Barcelona<br>
            <input type="submit" value="Enviar" name="enviar">
        </fieldset>
    </form>
</body>

</html>