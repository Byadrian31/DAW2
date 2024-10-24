<?php

/**
 * @author Adrián López Pascual
 */

/*
8. Ejercicio 7 Calcula, dada dos fechas inicio y final introducidas por el usuario (puede ser la 
actual y otra deseada), cuántos días, horas y minutos hay de diferencia entre dichas horas.
*/

function validarHora($hora)
{
    // Intenta crear un objeto DateTime 
    $fecha = DateTime::createFromFormat('Y-m-d H:i:s', $hora);

    // Verifica si la fecha y hora son válidas
    return $fecha && $fecha->format('Y-m-d H:i:s') === $hora;
}


if (isset($_POST['enviar'])) {
    $fechaI = $_POST['fechaI'];
    $fechaD = $_POST['fechaD'];

    // Uso de la función validarHora()
    if (validarHora($fechaI) && validarHora($fechaD)) {
        // Se crean las fechas y con diff se muestra la diferencia entre estas
        $fecha1 = new DateTime($fechaI);
        $fecha2 = new DateTime($fechaD);
        $intervalo = $fecha1->diff($fecha2);
        echo $intervalo->format(' %d día(s), %m mes(es), %y año(s), %h hora(s), %i minuto(s), %s segundo(s)') . "\n";
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
    <form action="" method="post">
        <fieldset>
            <legend>Diferencia fechas</legend>
            <label for="carácter">Fecha inicial:</label>
            <input type="text" name="fechaI" placeholder="yyyy-mm-dd hh:mm:ss"> <br>
            <label for="carácter">Fecha deseada:</label>
            <input type="text" name="fechaD" placeholder="yyyy-mm-dd hh:mm:ss"> <br>
            <input type="submit" value="Enviar" name="enviar">
        </fieldset>
    </form>
</body>

</html>