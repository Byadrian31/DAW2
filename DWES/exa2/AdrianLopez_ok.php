<?php

/**
 * @author Adrián López Pascual
 */

// Recuperar datos enviados por la URL
$nombre = $_GET['nombre'] ?? '';
$email = $_GET['email'] ?? '';
$user = $_GET['user'] ?? '';
$contraseña = $_GET['contraseña'] ?? '';
$trabajo = $_GET['trabajo'] ?? '';
$poblacion = $_GET['poblacion'] ?? '';
$material = explode(',', $_GET['material'] ?? '');
$necesidades = explode(',', $_GET['necesidades'] ?? '');
$respuesta = $_GET['respuesta'] ?? '';
$foto = $_GET['foto'] ?? '';

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
</head>
<body>
    <h1 style="color:blue">Sus datos han sido enviados correctamente - <?= htmlspecialchars($nombre) ?> </h1>
    <ul>
    <li><i>Nombre:</i> <strong> <?=  strtoupper(htmlspecialchars($nombre)) ?> </strong></li>
    <li><i>Contraseña:</i> <strong> <?= strtoupper(htmlspecialchars($contraseña)) ?> </strong></li>
    <li><i>Nivel de Estudios:</i> <strong> <?= strtoupper(htmlspecialchars($nivel_estudios)) ?> </strong></li>
    <li><i>Nacionalidad:</i> <strong> <?= strtoupper(htmlspecialchars($nacionalidad)) ?> </strong></li>
    <li><i>Email:</i> <strong> <?= strtoupper(htmlspecialchars($email)) ?> </strong></li>
    <li><i>Idiomas:</i> <strong> <?= strtoupper(htmlspecialchars(implode(', ', $idiomas))) ?> </strong></li>
    <li><i>Foto:</i></li>
    <?php if (!empty($foto)): ?> </strong>
        <li><i>Ruta de la imagen:</i> temp/<strong> <?= strtoupper(htmlspecialchars($foto)) ?> </strong></li>
        <img src="img/ <?= htmlspecialchars($foto) ?>" alt="Foto subida" width="200">
    <?php endif; ?>
    </ul>
    
</body>
</html>
