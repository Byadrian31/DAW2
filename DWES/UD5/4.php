<?php

/**
 * @author Adrián López Pascual
 */
// Condición que espera al botón Enviar
if (isset($_POST['enviar'])) {
    $nombre = $_POST['nombre'];
    $horas = $_POST['horas'];
    if (is_numeric($horas)) {
        if ($horas > 40) {
            $resto = $horas - 40;
            $total = ($resto * 16) + (40 * 12);
            echo $nombre . " tiene un salario semanal de " . $total;
        } else {
            $total = $horas * 12;
            echo $nombre . " tiene un salario semanal de " . $total;
        }
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adrián López Pascual</title>
</head>

<body>
    <h1>Adrián López Pascual</h1>
    <form action="" method="post">
        <fieldset>
            <legend>Salario</legend>
            <label for="nombre">Trabajador:</label>
            <input type="text" name="nombre"><br>
            <label for="horas">Horas semanales:</label>
            <input type="text" name="horas"><br>
            <input type="submit" value="Enviar" name="enviar">
        </fieldset>
    </form>
</body>

</html>