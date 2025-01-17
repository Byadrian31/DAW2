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
    if (isset($_POST['nombre']) && isset($_POST['idioma']) && isset($_POST['color']) && isset($_POST['ciudades'])) {
        $nombre = $_POST['nombre'];
        $idioma = $_POST['idioma'];
        $color = $_POST['color'];
        $ciudades = $_POST['ciudades'];
        $texto = implode(",", [$nombre, $idioma, $color, implode(",", $ciudades)]);

        setcookie('datos', $texto, time() + 3600);

        echo "El nombre es " . $nombre . " idioma es " . $idioma . " color es " . $color . " y las ciudades ";

        foreach ($ciudades as $ciudad) {
            echo htmlspecialchars($ciudad) . " ";
        }
        echo "<br>";
        
        if (isset($_COOKIE['datos'])) {
            $cookie = explode(",", $_COOKIE['datos']);
            $ncook = $cookie[0];
            $icook = $cookie[1];
            $ccook = $cookie[2];
            $cscook = $cookie[3];
            echo "El anterior nombre es " . $ncook . " idioma es " . $icook . " color es " . $ccook . " y las ciudades "; ;
            foreach (explode(",", $cscook) as $ciudad) {
                echo htmlspecialchars($ciudad) . " " ;
            }
            echo "<br>";
            
        } else {
            echo "No hay datos anteriores.";
        }
    } else {
        echo "No se han introducido todos los valores";
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
            <br>
            <label for="color">Color</label>
            <input type="radio" name="color" value="rojo"> Rojo
            <input type="radio" name="color" value="azul"> Azul <br>
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