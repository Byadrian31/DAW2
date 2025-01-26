<?php

/**
 * @author Adrián López Pascual
 */


session_start(); // Iniciar la sesión

// Recuperar los datos desde la sesión
$datos = $_SESSION['datos'] ?? [];

$nombre = $datos['nombre'] ?? '';
$contraseña = $datos['contraseña'] ?? '';
$nivel_estudios = $datos['nivel_estudios'] ?? '';
$nacionalidad = $datos['nacionalidad'] ?? '';
$email = $datos['email'] ?? '';
$idiomas = $datos['idiomas'] ?? [];
$foto = $datos['foto'] ?? [];
$fotoN = $foto['nombre'] ?? '';
$fotoR = $foto['ruta'] ?? '';
$fotoE = $foto['extension'] ?? '';
$fotoT = $foto['tamaño'] ?? '';

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
</head>

<body>
    <h1>Datos del Formulario</h1>
    <p><strong>Nombre:</strong> <?= htmlspecialchars($nombre) ?></p>
    <p><strong>Contraseña:</strong> <?= htmlspecialchars($contraseña) ?></p>
    <p><strong>Nivel de Estudios:</strong> <?= htmlspecialchars($nivel_estudios) ?></p>
    <p><strong>Nacionalidad:</strong> <?= htmlspecialchars($nacionalidad) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
    <p><strong>Idiomas:</strong> <?= htmlspecialchars(implode(', ', $idiomas)) ?></p>
    <p><strong>Foto:</strong></p>
    <?php if (!empty($fotoN)): ?>
        <img src="<?= htmlspecialchars($fotoR) ?>" alt="Foto" width="200">
        <p><strong>Nombre:</strong> <?= htmlspecialchars($fotoN) ?></p>
        <p><strong>Extensión:</strong> <?= htmlspecialchars($fotoE) ?></p>
        <p><strong>Tamaño:</strong> <?= htmlspecialchars($fotoT) ?> bytes</p>
        <p><strong>Ruta:</strong> <?= htmlspecialchars($fotoR) ?></strong></p>
    <?php else: ?>
        <p>No se subió ninguna foto.</p>
    <?php endif; ?>

</body>

</html>