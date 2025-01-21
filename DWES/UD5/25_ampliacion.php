<?php

/**
 * @author Adrián López Pascual
 */

// Inicializar un array para almacenar errores de validación
$errores = [];
// Variable para guardar temporalmente el nombre del archivo subido
$foto_temporal = '';
// Directorio temporal donde se almacenarán las fotos subidas
$directorio_temporal = 'temp/';

// Verificar si el formulario ha sido enviado o si se ha pulsado el botón de validar
if (isset($_POST['validar']) || isset($_POST['enviar'])) {
    // Validar el nombre
    if (empty($_POST['nombre']) || ctype_alpha(str_replace(' ', '', $_POST['nombre'])) === false) {
        $errores['nombre'] = 'El nombre completo es obligatorio y debe contener solo letras y espacios';
    }

    // Validar la contraseña (mínimo 6 caracteres)
    if (strlen($_POST['contraseña']) < 6) {
        $errores['contraseña'] = 'La contraseña debe tener al menos 6 caracteres';
    }

    // Validar nivel de estudios
    if (empty($_POST['nivel_estudios'])) {
        $errores['nivel_estudios'] = 'Debe seleccionar un nivel de estudios';
    }

    // Validar nacionalidad
    if (empty($_POST['nacionalidad'])) {
        $errores['nacionalidad'] = 'Debe seleccionar una nacionalidad';
    }

    // Validar selección de idiomas (al menos uno)
    if (empty($_POST['idiomas'])) {
        $errores['idiomas'] = 'Debe seleccionar al menos un idioma';
    }

    // Validar formato del email
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errores['email'] = 'El email no es válido';
    }

    // Validar subida de foto
    if (!empty($_FILES['foto']['name'])) {
        $extensiones_permitidas = ['jpg', 'jpeg', 'png', 'gif']; // Extensiones válidas
        $tamano_maximo = 120 * 1024; // Tamaño máximo permitido (120 KB)
        $archivo = $_FILES['foto']; // Archivo subido
        $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION); // Obtener extensión del archivo

        // Validar extensión
        if (!in_array(strtolower($extension), $extensiones_permitidas)) {
            $errores['foto'] = 'La foto debe ser JPG, JPEG, PNG o GIF';
        } 
        // Validar tamaño del archivo
        elseif ($archivo['size'] > $tamano_maximo) {
            $errores['foto'] = 'El tamaño de la foto no debe superar los 120 KB';
        } 
        // Si no hay errores, mover el archivo a la carpeta temporal
        else {
            if (!is_dir($directorio_temporal)) {
                mkdir($directorio_temporal, 0777, true); // Crear directorio si no existe
            }
            $foto_temporal = uniqid() . '.' . $extension; // Generar un nombre único para la foto
            move_uploaded_file($archivo['tmp_name'], $directorio_temporal . $foto_temporal);
        }
    } 
    // Si no se subió una nueva foto, usar la foto temporal anterior
    else {
        if (isset($_POST['foto_temporal']) && !empty($_POST['foto_temporal'])) {
            $foto_temporal = $_POST['foto_temporal'];
        } else {
            $errores['foto'] = 'Debe subir una foto';
        }
    }

    // Si se presionó enviar y no hay errores, redirigir a resultado.php con los datos
    if (isset($_POST['enviar']) && empty($errores)) {
        $url = 'resultado.php?' .
            'nombre=' . urlencode($_POST['nombre']) . // Codificar nombre
            '&contraseña=' . urlencode($_POST['contraseña']) . // Codificar contraseña
            '&nivel_estudios=' . urlencode($_POST['nivel_estudios']) . // Codificar nivel de estudios
            '&nacionalidad=' . urlencode($_POST['nacionalidad']) . // Codificar nacionalidad
            '&email=' . urlencode($_POST['email']) . // Codificar email
            '&idiomas=' . urlencode(implode(',', $_POST['idiomas'])) . // Codificar idiomas seleccionados
            '&foto=' . urlencode($foto_temporal); // Codificar el nombre del archivo de foto
        header("Location: $url"); // Redirigir a resultado.php
        exit;
    }
}

// Limpiar todos los valores
if (isset($_POST['limpiar'])) {
    $_POST = []; // Esto limpia todo el formulario al presionar el botón de "limpiar".
    $foto_temporal = '';
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Ampliado</title>
    <style>
        .errores { color: red; }
        .exito { color: green; }
    </style>
</head>
<body>

<h1>Formulario Ampliado</h1>

<!-- Mostrar errores si los hay -->
<?php if (!empty($errores)): ?>
    <div class="errores">
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php elseif (isset($_POST['validar']) && empty($errores)): ?>
    <!-- Mensaje de éxito si el formulario es válido -->
    <div class="exito">Formulario validado correctamente</div>
    <?php if (!empty($foto_temporal)): ?>
        <p>Foto subida:</p>
        <img src="temp/<?= htmlspecialchars($foto_temporal) ?>" alt="Foto subida" width="200">
    <?php endif; ?>
<?php endif; ?>

<!-- Formulario -->
<form action="" method="post" enctype="multipart/form-data">
    <!-- Campos visibles -->
    <label for="nombre">Nombre completo:</label>
    <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>">
    <br>

    <label for="contraseña">Contraseña:</label>
    <input type="password" id="contraseña" name="contraseña" value="<?= htmlspecialchars($_POST['contraseña'] ?? '') ?>">
    <br>

    <label for="nivel_estudios">Nivel de estudios:</label>
    <select id="nivel_estudios" name="nivel_estudios">
        <option value="">Seleccione</option>
        <option value="Sin estudios" <?= ($_POST['nivel_estudios'] ?? '') === 'Sin estudios' ? 'selected' : '' ?>>Sin estudios</option>
        <option value="ESO" <?= ($_POST['nivel_estudios'] ?? '') === 'ESO' ? 'selected' : '' ?>>ESO</option>
        <option value="Bachillerato" <?= ($_POST['nivel_estudios'] ?? '') === 'Bachillerato' ? 'selected' : '' ?>>Bachillerato</option>
        <option value="FP" <?= ($_POST['nivel_estudios'] ?? '') === 'FP' ? 'selected' : '' ?>>FP</option>
        <option value="Universitarios" <?= ($_POST['nivel_estudios'] ?? '') === 'Universitarios' ? 'selected' : '' ?>>Universitarios</option>
    </select>
    <br>

    <label for="nacionalidad">Nacionalidad:</label>
    <input type="radio" id="nacionalidad_española" name="nacionalidad" value="Española" <?= ($_POST['nacionalidad'] ?? '') === 'Española' ? 'checked' : '' ?>> Española
    <input type="radio" id="nacionalidad_otra" name="nacionalidad" value="Otra" <?= ($_POST['nacionalidad'] ?? '') === 'Otra' ? 'checked' : '' ?>> Otra
    <br>

    <label for="idiomas">Idiomas:</label>
    <input type="checkbox" name="idiomas[]" value="Español" <?= in_array('Español', $_POST['idiomas'] ?? []) ? 'checked' : '' ?>> Español
    <input type="checkbox" name="idiomas[]" value="Inglés" <?= in_array('Inglés', $_POST['idiomas'] ?? []) ? 'checked' : '' ?>> Inglés
    <input type="checkbox" name="idiomas[]" value="Francés" <?= in_array('Francés', $_POST['idiomas'] ?? []) ? 'checked' : '' ?>> Francés
    <input type="checkbox" name="idiomas[]" value="Alemán" <?= in_array('Alemán', $_POST['idiomas'] ?? []) ? 'checked' : '' ?>> Alemán
    <input type="checkbox" name="idiomas[]" value="Italiano" <?= in_array('Italiano', $_POST['idiomas'] ?? []) ? 'checked' : '' ?>> Italiano
    <br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
    <br>

    <label for="foto">Adjuntar foto:</label>
    <input type="file" id="foto" name="foto">
    <input type="hidden" name="foto_temporal" value="<?= htmlspecialchars($foto_temporal) ?>">
    <br>

    <button type="submit" name="limpiar">Limpiar</button>
    <button type="submit" name="validar">Validar</button>
    <button type="submit" name="enviar">Enviar</button>
</form>

</body>
</html>
