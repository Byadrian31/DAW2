<?php

/**
 * @author Adrián López Pascual
 */

/*
    Creación del Formulario 4
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

<?php
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

        echo "<p><b>Tipo de incidencia:</b> " . strtoupper($_GET['incidencia']) . "</p>";
        echo "<p><b>Descripción de la incidencia:</b> " . strtoupper($_GET['comentario']) . "</p>";


    }
    ?>

    <h1>Adrián López - Formulario de registro 4</h1>

    <form action="" method="get">
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
