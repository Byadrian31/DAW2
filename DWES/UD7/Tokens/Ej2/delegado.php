<?php
/**
 * @author Adrián López Pascual
 */
session_start();
$nombre = $_SESSION['usuario'];
$apellido = $_SESSION['apellido'];
$asignatura = $_SESSION['asignatura'];
$grupo = $_SESSION['grupo'];

echo "<h1>Delegado</h1>";
echo "<h2>Bienvenido $nombre $apellido</h2>";
echo "<h2>Asignatura: $asignatura</h2>";
echo "<h2>Grupo: $grupo</h2>";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['cerrar'])) {
       header("Location: logout.php");
    }

    if (isset($_POST['sid'])) {
        $_SESSION["token"] = bin2hex(random_bytes(24)); // Regenerar el token
    }
}

// Comprobar si el token coincide
if (!hash_equals($_SESSION['token'], $_SESSION['form_token'])) {
    $_SESSION['frase'] = "<h1 style='color:red;'>Token incorrecto. Posible ataque CSRF.</h1>";
    header("Location: 2.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adrián López Pascuak</title>
</head>

<body>
    <form action="" method="post">
        <input type="submit" value="Cerrar sesión" name="cerrar">
        <input type="submit" value="Generar nuevo token" name="sid">
    </form>
</body>

</html>