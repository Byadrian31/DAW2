<?php

/**
 * @author Adrián López Pascual
 */

/*
9. Ejercicio 8. Crea la tabla de multiplicar de un número indicado por el usuario siendo que el 
multiplicador se podrá seleccionar entre 1 y 10. Se multiplicará desde 1 al multiplicador 
seleccionado.
*/

if (isset($_POST['enviar'])) {
    $num = $_POST['num'];
    $mult = $_POST['mult'];
    if (is_numeric($num) && is_numeric($mult)) {
    echo "<h2>Tabla de multiplicar del número " . $num . "</h2><br>";
    // For para crear la tabla de multiplicar
    for ($i=1; $i <= $mult ; $i++) { 
        echo $num . "x" . $i . " = " . ($num*$i) . "<br>";
    }
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
            <legend>Tabla de multiplicar</legend>
            <label for="carácter">Número:</label>
            <input type="text" name="num"> <br>
            <label for="carácter">Multiplicador:</label>
            <select name="mult">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
             <br>
            <input type="submit" value="Enviar" name="enviar">
        </fieldset>
    </form>
</body>

</html>