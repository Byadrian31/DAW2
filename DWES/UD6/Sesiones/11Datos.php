<?php

/**
 * @author Adrián Lopez Pascual
 */

session_start(); // Iniciar la sesión

// Verificar si existen datos en la sesión
if (isset($_SESSION['datos'])) {
    $datos = $_SESSION['datos']; // Obtener los datos de la sesión
    $nombre = isset($datos['nombre']) ? $datos['nombre'] : '';
    $apellido = isset($datos['apellido']) ? $datos['apellido'] : '';
    $edad = isset($datos['edad']) ? $datos['edad'] : '';
    $estudios = isset($datos['estudios']) ? $datos['estudios'] : '';
    $situacion = isset($datos['situacion']) ? $datos['situacion'] : [];
    $hobbies = isset($datos['hobbies']) ? $datos['hobbies'] : [];
    $hobbiesOtro = isset($datos['hobbiesOtro']) ? $datos['hobbiesOtro'] : '';
} else {
    echo "<p>No se han encontrado datos en la sesión.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen de Datos</title>
</head>
<body>
    <h1>Resumen de los datos ingresados</h1>
    <p><strong>Nombre:</strong> <?= htmlspecialchars($nombre) ?></p>
    <p><strong>Apellido:</strong> <?= htmlspecialchars($apellido) ?></p>
    <p><strong>Edad:</strong> <?= htmlspecialchars($edad) ?></p>
    <p><strong>Nivel de estudios:</strong> <?= htmlspecialchars($estudios) ?></p>
    <p><strong>Situación actual:</strong> <?= implode(', ', $situacion) ?></p>
    <p><strong>Hobbies:</strong> <?= implode(', ', $hobbies) ?></p>
    <?php if (!empty($hobbiesOtro)): ?>
        <p><strong>Otro hobby:</strong> <?= htmlspecialchars($hobbiesOtro) ?></p>
    <?php endif; ?>
</body>
</html>
