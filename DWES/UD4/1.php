<?php

/**
 * @author Adrián López Pascual
 */

/*
    Creación del Formulario 1
 */

 if (isset($_GET['enviar'])) {
    echo "<h2>Datos Enviados:</h2>";
    echo "<p><b>Nombre:</b> " . strtoupper($_GET['name']) . "</p>";
    echo "<p><b>Apellidos:</b> " . strtoupper($_GET['ape']) . "</p>";
    echo "<p><b>Sexo:</b> " . (isset($_GET['sexo']) ? strtoupper($_GET['sexo']) : 'No seleccionado') . "</p>";
    echo "<p><b>Correo electrónico:</b> " . strtoupper($_GET['email']) . "</p>";
    echo "<p><b>Provincia:</b> " . strtoupper($_GET['provincia']) . "</p>";
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
    <title>Adrián - Formulario de registro</title>
</head>

<body>

    <h1>Adrián López - Formulario de registro</h1>

    <form action="" method="get">
        <label for="nombre">Nombre:</label>
        <input type="text" name="name" maxlength="50"><br> <br>

        <label for="apellido">Apellidos:</label>
        <input type="text" name="ape" maxlength="200"><br> <br>

        <label for="sexo">Sexo:</label>
        <input type="radio" name="sexo" value="Hombre"> hombre
        <input type="radio" name="sexo" value="Mujer"> mujer<br> <br>

        <label for="email">Correo electrónico:</label>
        <input type="text" name="email" maxlength="250"><br> <br>

        <label for="provincia">Provincia:</label>
        <select name="provincia">
            <option value="alicante">Alicante</option>
            <option value="castellon">Castellón</option>
            <option value="valencia">Valencia</option>
        </select>
        <br> <br>

        <input type="checkbox" name="condiciones" checked> Deseo recibir información sobre novedades y ofertas<br> <br>
        <input type="checkbox" name="condiciones2"> Declaro haber leído y aceptar las condiciones generales del programa y la normativa sobre protección de dato<br> <br>
        <input type="submit" value="Enviar" name="enviar">

    </form>
</body>

</html>