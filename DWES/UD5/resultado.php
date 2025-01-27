<?php

/**
 * @author Adrián López Pascual
 */

// Recuperar datos enviados por la URL
$nombre = $_GET['nombre'] ?? '';
$contraseña = $_GET['contraseña'] ?? '';
$nivel_estudios = $_GET['nivel_estudios'] ?? '';
$nacionalidad = $_GET['nacionalidad'] ?? '';
$email = $_GET['email'] ?? '';
$idiomas = explode(',', $_GET['idiomas'] ?? '');
$foto = $_GET['foto'] ?? '';
$foto_size = intval($_GET['foto_size']);
/* 
<?php
if (isset($_GET['foto']) && isset($_GET['foto_size'])) {
    $foto = htmlspecialchars($_GET['foto']);
    $foto_size = intval($_GET['foto_size']); // Convertir a un número entero para seguridad
    $foto_size_kb = $foto_size / 1024; // Convertir a KB

    echo "<p>La foto se ha subido correctamente.</p>";
    echo "<p>Tamaño de la foto: " . number_format($foto_size_kb, 2) . " KB</p>";
    echo "<img src='temp/$foto' alt='Foto subida' width='200'>";
} else {
    echo "<p>No se recibió ninguna foto o el tamaño no fue especificado.</p>";
}

*/


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
    <?php if (!empty($foto)): ?>
        <p><strong>Ruta de la imagen:</strong> temp/<?= htmlspecialchars($foto) ?></p>
        <p><strong>Tamaño:</strong> <?= htmlspecialchars($foto_size) ?></p>
        <img src="temp/<?= htmlspecialchars($foto) ?>" alt="Foto subida" width="200">
    <?php endif; ?>
</body>
</html>
