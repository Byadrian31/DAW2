<?php

/**
 * @author Adrián López Pascual
 */

/*
    Creación del Formulario 3
 */

if (isset($_GET['enviar'])) {
    echo "<h2>Datos Enviados:</h2>";
    echo "<p><b>Nombre:</b> " . strtoupper($_GET['name']) . "</p>";
    echo "<p><b>Apellidos:</b> " . strtoupper($_GET['ape']) . "</p>";
    echo "<p><b>Correo electrónico:</b> " . strtoupper($_GET['email']) . "</p>";
    echo "<p><b>Usuario:</b> " . strtoupper($_GET['user']) . "</p>";
    echo "<p><b>Contraseña:</b> " . strtoupper($_GET['pass']) . "</p>";
    echo "<p><b>Sexo:</b> " . (isset($_GET['sexo']) ? strtoupper($_GET['sexo']) : 'No seleccionado') . "</p>";

    echo "<p><b>Provincia:</b> " . strtoupper($_GET['provincia']) . "</p>";

    echo "<p><b>Horario de contacto:</b> ";
    if (isset($_GET['horario'])) {
        echo strtoupper(implode(" – ", $_GET['horario']));
    } else {
        echo "No seleccionado";
    }
    echo "</p>";

    echo "<p><b>Cómo nos has conocido:</b> ";
    echo isset($_GET['amigo']) ? "Ha seleccionado amigo. " : "No ha seleccionado amigo. ";
    echo isset($_GET['web']) ? "Ha seleccionado web. " : "No ha seleccionado web. ";
    echo isset($_GET['prensa']) ? "Ha seleccionado prensa. " : "No ha seleccionado prensa. ";
    echo isset($_GET['otros']) ? "Ha seleccionado otros. " : "No ha seleccionado otros. ";
    echo "</p>";

    echo "<p><b>Descripción de la incidencia:</b> " . strtoupper($_GET['comentario']) . "</p>";

    echo "<p><b>Deseo recibir información:</b> " . (isset($_GET['condiciones']) ? "Ha seleccionado recibir ofertas" : "No ha seleccionado
    recibir ofertas") . "</p>";
    echo "<p><b>Condiciones:</b> " . (isset($_GET['condiciones2']) ? "Ha aceptado las condiciones" : "No ha aceptado las condiciones") . "</p>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adrián - Formulario de registro 3</title>
</head>

<body>

    <h1>Adrián López - Formulario de registro 3</h1>

    <form action="" method="get">
        <label for="nombre">Nombre:</label>
        <input type="text" name="name" maxlength="50"><br> <br>

        <label for="apellido">Apellidos:</label>
        <input type="text" name="ape" maxlength="200"><br> <br>

        <label for="email">Correo electrónico:</label>
        <input type="text" name="email" maxlength="250"><br> <br>

        <label for="user">Usuario:</label>
        <input type="text" name="user" maxlength="5"><br> <br>

        <label for="password">Contraseña:</label>
        <input type="password" name="pass" maxlength="15"><br> <br>

        <label for="sexo">Sexo:</label>
        <input type="radio" name="sexo" value="masculino"> hombre
        <input type="radio" name="sexo" value="femenino"> mujer<br> <br>


        <label for="provincia">Provincia:</label>
        <select name="provincia">
            <option value="alicante">Alicante</option>
            <option value="castellon">Castellón</option>
            <option value="valencia">Valencia</option>
        </select>
        <br> <br>

        <label for="horario">Horario de contacto</label>
        <select multiple size="2" name="horario[]">
            <option value="mañana">De 8 a 14 horas</option>
            <option value="tarde">De 14 a 18 horas</option>
            <option value="noche">De 18 a 21 horas</option>
        </select>
        <br> <br>

        <label for="conocer">¿Cómo nos has conocido?</label><br><br>

        <input type="checkbox" name="amigo">
        <label for="amigo">Un amigo</label>

        <input type="checkbox" name="web">
        <label for="web">Web</label>

        <input type="checkbox" name="prensa">
        <label for="prensa">Prensa</label>

        <input type="checkbox" name="otros">
        <label for="otros">Otros</label>

        <br> <br>

        <label for="comentario">Comentario:</label>
        <textarea name="comentario" cols="60" rows="6"></textarea><br> <br>

        <input type="checkbox" name="condiciones" checked> Deseo recibir información sobre novedades y ofertas<br> <br>
        <input type="checkbox" name="condiciones2"> Declaro haber leído y aceptar las condiciones generales del programa y la normativa sobre protección de dato<br> <br>
        <input type="submit" value="Enviar" name="enviar">
        <input type="reset" value="Reset" name="reset">

    </form>
</body>

</html>