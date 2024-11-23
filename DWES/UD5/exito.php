<?php

/**
 * @author Adrián López Pascual
 */

// Verifica si se ha pasado el nombre por GET
if (isset($_GET['nombre'])) {
    $nombre_usuario = urldecode($_GET['nombre']);  // Decodifica el nombre recibido
} else {
    $nombre_usuario = "Usuario desconocido";  // Si no se pasa nombre, muestra un valor predeterminado
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Proceso Exitoso!</title>
</head>
<body>
    <h1>¡Registro completado con éxito!</h1>
    <p>Gracias por registrarte, <strong><?= htmlspecialchars($nombre_usuario) ?></strong>. Los datos han sido procesados correctamente.</p>
    <p>Nombre: <?= htmlspecialchars($nombre_usuario) ?><br>Grupo: 2º DAW</p>
</body>
</html>

