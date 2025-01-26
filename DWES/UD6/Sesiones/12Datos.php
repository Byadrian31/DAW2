<?php

/**
 * @author Adrián López Pascual
 */

session_start(); // Iniciar sesión

// Verificar si existen datos en la sesión
if (isset($_SESSION['datos'])) {
    $datos = $_SESSION['datos']; // Obtener los datos de la sesión
    $nombre = isset($datos['nombre']) ? $datos['nombre'] : '';
    $apellido = isset($datos['apellido']) ? $datos['apellido'] : '';
    $edad = isset($datos['edad']) ? $datos['edad'] : '';
    $peso = isset($datos['peso']) ? $datos['peso'] : '';
    $sexo = isset($datos['sexo']) ? $datos['sexo'] : '';
    $estado = isset($datos['estado']) ? $datos['estado'] : '';
    $aficion = isset($datos['aficion']) ? $datos['aficion'] : [];
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
    <p><strong>Peso:</strong> <?= htmlspecialchars($peso) ?></p>
    <p><strong>Sexo:</strong> <?= htmlspecialchars($sexo) ?></p>
    <p><strong>Estado civil:</strong> <?= htmlspecialchars($estado) ?></p>
    <p><strong>Aficiones:</strong> <?= htmlspecialchars(implode(', ', $aficion)) ?></p>
</body>
</html>
