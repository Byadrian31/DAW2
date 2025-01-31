<?php

/**
 * @author Adrián López Pascual
 */

/*
Crea un formulario de autenticación para visualizar resultados basándote en el Ejercicio 10 de la
UD5 de modo que, según el usuario que acceda (recoge un nombre y perfil (Gerente,
Sindicalista y Responsable de Nóminas, todos excluyentes entre sí) y crea el vector de
empleados en este formulario), sea redirigido a su página personalizada donde pueda ver los
datos a los que tiene permiso. Así pues, el Gerente podrá ver todos los resultados del salario
mínimo, máximo y promedio, el sindicalista sólo puede acceder al salario medio y la
responsable de Nóminas al salario mínimo y máximo. Añade un título a cada página indicando
el rol o si es el formulario de la empresa junto con tu nombre. En cada perfil, añade un botón
cerrar sesión que permita liberar la sesión y volver a la página del formulario.
*/

session_start();
$_SESSION['empleados'] = [
    "Alejandro" => 2000,
    "Peter" => 1400,
    "Silvia" => 1200,
    "Adriana" => 1000
];

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
    <form action="./comp.php" method="post">
        <fieldset>
            <legend>Datos personales</legend>
            <label for="nombre">Nombre:</label> <br>
            <input type="text" name="nombre" id="nombre" required>
            <br>
            <label for="perfil">Perfil:</label> <br>
            <select name="perfil" id="perfil">
                <option value="g">Gerente</option>
                <option value="s">Sindicalista</option>
                <option value="r">Responsable de Nóminas</option>
            </select>
            
            <input type="submit" value="Enviar" name="enviar">
        </fieldset>
    </form>
</body>

</html>