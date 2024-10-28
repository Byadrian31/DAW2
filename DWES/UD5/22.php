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

if (isset($_POST['enviar'])) {
    $email = $_POST['email'];
    $acceptsAds = isset($_POST['cond']) ? '1' : '0';

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Redirige a otra página pasando el correo y la aceptación de publicidad
        header("Location: ./22Form.php?email=" . urlencode($email) . "&cond=" . urlencode($acceptsAds));
        exit; // Asegúrate de terminar el script después de redirigir
    } else {
        echo "<p>Correo inválido</p>";
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

    <h1>Adrián López Pascual</h1>

    <form action="" method="post">
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
