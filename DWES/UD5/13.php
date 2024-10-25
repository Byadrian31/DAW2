<?php

/**
 * @author Adrián López Pascual
 */

/*
  13. Formulario 1, petición por GET y mostrar en NombreAlumnoForm1OK.php los resultados 
    indicando el campo en cursiva y el contenido en negrita
 */


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adrián López Pascual </title>
</head>

<body>

    <h1>Adrián López Pascual</h1>

    <form action="./AdrianForm1OK.php" method="get">
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