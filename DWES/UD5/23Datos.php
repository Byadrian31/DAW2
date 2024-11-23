<?php

/**
 * @author Adrián López Pascual
 */

// Recoge los datos enviados por GET
$nombre = isset($_GET['nombre']) ? $_GET['nombre'] : '';
$apellido = isset($_GET['apellido']) ? $_GET['apellido'] : '';
$edad = isset($_GET['edad']) ? $_GET['edad'] : '';
$estudios = isset($_GET['estudios']) ? $_GET['estudios'] : '';
$situacion = isset($_GET['situacion']) ? $_GET['situacion'] : '';
$hobbies = isset($_GET['hobbies']) ? $_GET['hobbies'] : '';
$hobbiesOtro = isset($_GET['hobbiesOtro']) ? $_GET['hobbiesOtro'] : '';
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
