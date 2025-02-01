<?php
/**
 * @author Adrián López Pascual
 */

 /* 
    Crea un formulario de identificación de usuario de modo que el usuario introduzca su nombre,
apellido, asignatura y grupo. Además debe seleccionar si es menor o mayor de edad y si tiene
un cargo o no. Según los datos introducidos, se clasificará en un perfil según la siguiente tabla:

Genera una página para cada perfil de la tabla en la que se muestre un saludo de bienvenida
indicando los datos del usuario (nombre y apellidos) y mostrando la asignatura y grupo elegidos.
Además deberá poder cerrar la sesión y volver a la página del formulario. Utiliza las sesiones
para poder realizar este ejercicio.
 */

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adrián López Pascual</title>
</head>

<body>
    <h1>Adrián López Pascual</h1>
    <form action="comp.php" method="post">
        <fieldset>
            <legend>Datos personales</legend>
            <label for="nombre">Nombre:</label> <br>
            <input type="text" name="nombre" id="nombre" required>
            <br>
            <label for="apellido">Apellido:</label> <br>
            <input type="text" name="apellido" id="apellido" required>
            <br>
            <label for="asignatura">Asignatura:</label> <br>
            <input type="text" name="asignatura" id="asignatura" required>
            <br>
            <label for="grupo">Grupo:</label> <br>
            <input type="text" name="grupo" id="grupo" required>
            <br>
            <label for="edad">Edad:</label> <br>
            <input type="radio" name="edad" value="mayor" required> Mayor de edad
            <input type="radio" name="edad" value="menor" required> Menor de edad
            <br>
            <label for="cargo">Cargo:</label> <br>
            <input type="radio" name="cargo" value="si" required> Sí
            <input type="radio" name="cargo" value="no" required> No
            <br>
            
            <input type="submit" value="Enviar" name="enviar">
        </fieldset>
    </form>
</body>

</html>