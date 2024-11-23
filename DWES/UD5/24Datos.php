<?php

/**
 * @author Adrián López Pascual
 */

// Recoge los datos enviados por GET
$nombre = isset($_GET['nombre']) ? $_GET['nombre'] : '';
$apellido = isset($_GET['apellido']) ? $_GET['apellido'] : '';
$edad = isset($_GET['edad']) ? $_GET['edad'] : '';
$peso = isset($_GET['peso']) ? $_GET['peso'] : '';
$sexo = isset($_GET['sexo']) ? $_GET['sexo'] : '';
$estado = isset($_GET['estado']) ? $_GET['estado'] : '';
$aficion = isset($_GET['aficion']) ? $_GET['aficion'] : '';
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
    <p><strong>Peso:</strong> <?= htmlspecialchars($peso) ?></p>
    <p><strong>Sexo:</strong> <?= htmlspecialchars($sexo) ?></p>
    <p><strong>Estado civil:</strong> <?= htmlspecialchars($estado) ?></p>
    <p><strong>Aficiones:</strong> <?= implode(', ', $aficion) ?></p>
</body>
</html>
