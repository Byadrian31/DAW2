<?php

/**
 * @author Adrián López Pascual
 */

/*
22. Escribe un formulario que solicite una dirección de correo y que la confirme e indique si 
acepta recibir publicidad. Añade botón Enviar y Borrar. Cuando enviemos, iremos a otra página 
donde se le indique el email y si ha aceptado recibir publicidad o no. El botón borrar se 
mantendrá en el mismo formulario inicial pero limpiará todos los campos.
*/

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

    <form action="./22Form.php" method="post">
        <fieldset>
            <legend>Correo electrónico</legend>
            <label for="email">Correo electrónico:</label>
            <input type="text" name="email" required> <br>
            Acepto recibir publicidad
            <input type="checkbox" name="cond"> <br>
            <input type="submit" value="Enviar" name="enviar">
            <input type="reset" value="Borrar">
        </fieldset>
    </form>

</body>
</html>
