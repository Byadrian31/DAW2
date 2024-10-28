<?php
/**
 * @author Adrián López Pascual
 */

/*
19. Crea un programa donde se le seleccione el curso (radiobutton), los módulos (a seleccionar de 
un desplegable) y las horas (marcar o desmarcar) y genere un horario usando una tabla
*/

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adrián López Pascual</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h1>Adrián López Pascual</h1>

<form method="post" action="">
    <label>Seleccione el curso:</label><br>
    <input type="radio" name="curso" value="Curso 1"> Curso 1<br>
    <input type="radio" name="curso" value="Curso 2"> Curso 2<br><br>

    <label for="modulos">Seleccione los módulos:</label><br>
    <select id="modulos" name="modulos[]" multiple>
        <option value="Bases">Bases de datos</option>
        <option value="Entornos">Entornos</option>
        <option value="JS">JS</option>
        <option value="PHP">PHP</option>
    </select><br><br>

    <label>Seleccione las horas:</label><br>
    <input type="checkbox" name="horas[]" value="9:00-10:00"> 9:00-10:00<br>
    <input type="checkbox" name="horas[]" value="10:00-11:00"> 10:00-11:00<br>
    <input type="checkbox" name="horas[]" value="11:00-12:00"> 11:00-12:00<br>
    <input type="checkbox" name="horas[]" value="12:00-13:00"> 12:00-13:00<br>
    <input type="checkbox" name="horas[]" value="13:00-14:00"> 13:00-14:00<br>
    <input type="checkbox" name="horas[]" value="14:00-15:00"> 14:00-15:00<br><br>

    <input type="submit" value="Enviar" name="enviar">
</form>

<?php
if (isset($_POST['enviar'])) {
    $curso = $_POST['curso'];
    $modulos = $_POST['modulos'];
    $horas = $_POST['horas'];

    if ($curso && $modulos && $horas) {
        echo "<h2>Horario para $curso</h2>";
        echo "<table>";
        echo "<tr><th>Hora</th><th>Módulo</th></tr>";
        
        foreach ($horas as $hora) {
            foreach ($modulos as $modulo) {
                echo "<tr><td>$hora</td><td>$modulo</td></tr>";
            }
        }

        echo "</table>";
    } else {
        echo "<p style='color:red;'>Por favor, seleccione un curso, al menos un módulo y una hora.</p>";
    }
}
?>
</body>
</html>
