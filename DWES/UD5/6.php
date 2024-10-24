<?php

/**
 * @author Adrián López Pascual
 */

/*
6. Ejercicio 4: Elabora un programa para determinar si una hora leída en la forma horas, minutos 
y segundos está correctamente expresada. Utiliza funciones para la comprobación de datos.
*/

 function validarHora($hora) {
        // Intenta crear un objeto DateTime con el formato especificado
        $fechaHora = DateTime::createFromFormat('H:i:s', $hora);
        
        // Verifica si la fecha y hora son válidas
        return $fechaHora && $fechaHora->format('H:i:s') === $hora;

}

if (isset($_POST['enviar'])) {
    $hora = $_POST['hora'];

    if (validarHora($hora)) {
        echo "La hora $hora es válida.";
    } else {
        echo "La hora $hora no es válida. Asegúrate de usar el formato hh:mm:ss.";
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
            <legend>Hora</legend>
            <label for="carácter">Hora:</label>
            <input type="text" name="hora" placeholder="hh:mm:ss">
            <input type="submit" value="Enviar" name="enviar">
        </fieldset>
    </form>
</body>

</html>