<?php
/**
 * @author Adrián López Pascual
 */
session_start();
$nombre = $_SESSION['nombre'];
$apellido = $_SESSION['apellido'];
$asignatura = $_SESSION['asignatura'];
$grupo = $_SESSION['grupo'];

echo "<h1>Profesor</h1>";
echo "<h2>Bienvenido $nombre $apellido</h2>";
echo "<h2>Asignatura: $asignatura</h2>";
echo "<h2>Grupo: $grupo</h2>";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adrián López Pascuak</title>
</head>

<body>
    <form action="logout.php" method="post">
        <input type="submit" value="Cerrar sesión">
    </form>
</body>

</html>