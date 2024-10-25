<?php

/**
 * @author Adrián López Pascual
 */

/*
16. Formulario 4, petición por POST y mostrar en NombreAlumnoForm1OK.php los resultados 
indicando el campo en cursiva y el contenido en negrita
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adrián - Formulario de registro 4</title>
</head>

<body>
    <h1>Adrián López - Formulario de registro 4</h1>

    <form action="./AdrianForm4OK.php" method="get">
        <fieldset>
            <legend>Datos Personales</legend>
            <label for="nombre">Nombre:</label>
            <input type="text" name="name" maxlength="50" placeholder="Nombre"><br> <br>

            <label for="apellido">Apellidos:</label>
            <input type="text" name="ape" maxlength="200" placeholder="Apellidos"><br> <br>

            <label for="email">Correo electrónico:</label>
            <input type="text" name="email" maxlength="250" placeholder="Correo electrónico"><br> <br>

            <label for="user">Usuario:</label>
            <input type="text" name="user" maxlength="5" placeholder="Usuario"><br> <br>

            <label for="pass">Contraseña:</label>
            <input type="password" name="pass" maxlength="15" placeholder="Contraseña"><br> <br>

            <label for="sexo">Sexo:</label>
            <input type="radio" name="sexo" value="masculino"> hombre
            <input type="radio" name="sexo" value="femenino"> mujer<br> <br>
        </fieldset>

        <fieldset>
            <legend>Datos de contacto</legend>
            <label for="provincia">Provincia:</label>
            <select name="provincia">
                <option value="alicante">Alicante</option>
                <option value="castellon">Castellón</option>
                <option value="valencia">Valencia</option>
            </select>
            <br> <br>

            <label for="horario">Horario de contacto:</label>
            <select multiple size="2" name="horario[]">
                <option value="De 8 a 14 horas">De 8 a 14 horas</option>
                <option value="De 14 a 18 horas">De 14 a 18 horas</option>
                <option value="De 18 a 21 horas">De 18 a 21 horas</option>
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
        </fieldset>

        <fieldset>
            <legend>Datos de la incidencia</legend>
            <label for="incidencia">Tipo de incidencia:</label>
            <select name="incidencia">
                <option value="telFijo">Teléfono fijo</option>
                <option value="movil">Teléfono móvil</option>
                <option value="internet">Internet</option>
                <option value="tv">Televisión</option>
            </select>
            <br> <br>

            <label for="comentario">Descripción de la incidencia:</label>
            <textarea name="comentario" cols="40" rows="4" placeholder="Descripción de la incidencia"></textarea><br> <br>
        </fieldset>

        <input type="submit" value="Enviar" name="enviar">
        <input type="reset" value="Reset" name="reset">
    </form>

</body>

</html>
