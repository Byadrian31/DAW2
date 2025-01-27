<?php

/**
 * @author Adrián López Pascual
 * Mejoras implementadas:
 *  - Campo email cambiado por text
 *  - Campo tamaño de foto cambiado por hidden
 *  - Validación escalonada según la interacción del usuario
 *  - Control de flujo para validar solo o validar y enviar
 *  - Nombre del archivo de foto es el nombre del usuario
 *  - Comentarios adicionales agregados
 */

// Inicializar un array para almacenar errores de validación
$errores = [];
// Variable para guardar temporalmente el nombre del archivo subido
$foto_temporal = '';
// Directorio temporal donde se almacenarán las fotos subidas
$directorio_temporal = 'temp/';

// Verificar si el formulario ha sido enviado o si se ha pulsado el botón de validar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar el nombre
    if (empty($_POST['nombre'])) {
        $errores['nombre'] = 'El nombre completo es obligatorio';
    } elseif (ctype_alpha(str_replace(' ', '', $_POST['nombre'])) === false) {
        $errores['nombre'] = 'El nombre completo debe contener solo letras y espacios';
    } {

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

    // Validar formato del email (ahora texto libre)
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
            $foto_temporal = $_POST['nombre'] . '_' . uniqid() . '.' . $extension; // Usar el nombre del usuario
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
            'nombre=' . urlencode($_POST['nombre']) .
            '&contraseña=' . urlencode($_POST['contraseña']) .
            '&nivel_estudios=' . urlencode($_POST['nivel_estudios']) .
            '&nacionalidad=' . urlencode($_POST['nacionalidad']) .
            '&email=' . urlencode($_POST['email']) .
            '&idiomas=' . urlencode(implode(',', $_POST['idiomas'])) .
            '&foto=' . urlencode($foto_temporal);
        header("Location: $url");
        exit;
    }
}

// Limpiar todos los valores
if (isset($_POST['limpiar'])) {
    $_POST = [];
    $foto_temporal = '';
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adrián López Pascual</title>
    <style>
        .errores { color: red; }
        .exito { color: green; }
    </style>
</head>
<body>

<h1>Formulario</h1>

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
<form action="" method="post" enctype="multipart/form-data"> <!-- enctype permite la carga de archivos -->
    <!-- Campo para el nombre completo -->
    <label for="nombre">Nombre completo:</label>
    <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>"> <!-- Escapa caracteres especiales y mantiene el valor tras envío -->
    <br>

    <!-- Campo para la contraseña -->
    <label for="contraseña">Contraseña:</label>
    <input type="password" id="contraseña" name="contraseña" value="<?= htmlspecialchars($_POST['contraseña'] ?? '') ?>"> <!-- Mantiene el valor tras envío de forma segura -->
    <br>

    <!-- Selección de nivel de estudios -->
    <label for="nivel_estudios">Nivel de estudios:</label>
    <select id="nivel_estudios" name="nivel_estudios">
        <option value="">Seleccione</option>
        <option value="Sin estudios" <?= ($_POST['nivel_estudios'] ?? '') === 'Sin estudios' ? 'selected' : '' ?>>Sin estudios</option> <!-- Marca la opción seleccionada si coincide -->
        <option value="ESO" <?= ($_POST['nivel_estudios'] ?? '') === 'ESO' ? 'selected' : '' ?>>ESO</option> <!-- Marca la opción seleccionada si coincide -->
        <option value="Bachillerato" <?= ($_POST['nivel_estudios'] ?? '') === 'Bachillerato' ? 'selected' : '' ?>>Bachillerato</option> <!-- Marca la opción seleccionada si coincide -->
        <option value="FP" <?= ($_POST['nivel_estudios'] ?? '') === 'FP' ? 'selected' : '' ?>>FP</option> <!-- Marca la opción seleccionada si coincide -->
        <option value="Universitarios" <?= ($_POST['nivel_estudios'] ?? '') === 'Universitarios' ? 'selected' : '' ?>>Universitarios</option> <!-- Marca la opción seleccionada si coincide -->
    </select>
    <br>

    <!-- Selección de nacionalidad -->
    <label for="nacionalidad">Nacionalidad:</label>
    <input type="radio" id="nacionalidad_española" name="nacionalidad" value="Española" <?= ($_POST['nacionalidad'] ?? '') === 'Española' ? 'checked' : '' ?>> Española <!-- Marca la opción seleccionada si coincide -->
    <input type="radio" id="nacionalidad_otra" name="nacionalidad" value="Otra" <?= ($_POST['nacionalidad'] ?? '') === 'Otra' ? 'checked' : '' ?>> Otra <!-- Marca la opción seleccionada si coincide -->
    <br>

    <!-- Selección de idiomas -->
    <label for="idiomas">Idiomas:</label>
    <input type="checkbox" name="idiomas[]" value="Español" <?= in_array('Español', $_POST['idiomas'] ?? []) ? 'checked' : '' ?>> Español <!-- Marca la opción seleccionada si coincide -->
    <input type="checkbox" name="idiomas[]" value="Inglés" <?= in_array('Inglés', $_POST['idiomas'] ?? []) ? 'checked' : '' ?>> Inglés <!-- Marca la opción seleccionada si coincide -->
    <input type="checkbox" name="idiomas[]" value="Francés" <?= in_array('Francés', $_POST['idiomas'] ?? []) ? 'checked' : '' ?>> Francés <!-- Marca la opción seleccionada si coincide -->
    <input type="checkbox" name="idiomas[]" value="Alemán" <?= in_array('Alemán', $_POST['idiomas'] ?? []) ? 'checked' : '' ?>> Alemán <!-- Marca la opción seleccionada si coincide -->
    <input type="checkbox" name="idiomas[]" value="Italiano" <?= in_array('Italiano', $_POST['idiomas'] ?? []) ? 'checked' : '' ?>> Italiano <!-- Marca la opción seleccionada si coincide -->
    <br>

    <!-- Campo para el email -->
    <label for="email">Email:</label>
    <input type="text" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"> <!-- Escapa caracteres especiales para evitar ataques XSS -->
    <br>

    <!-- Campo para subir foto -->
    <label for="foto">Adjuntar foto:</label>
    <input type="file" id="foto" name="foto"> <!-- Permite cargar un archivo -->
    <input type="hidden" name="foto_temporal" value="<?= htmlspecialchars($foto_temporal) ?>"> <!-- Campo oculto para mantener el nombre de la foto temporal -->
    <br>

    <!-- Botones para interactuar con el formulario -->
    <button type="submit" name="limpiar">Limpiar</button> <!-- Limpia los campos del formulario -->
    <button type="submit" name="validar">Validar</button> <!-- Valida los datos ingresados -->
    <button type="submit" name="enviar">Enviar</button> <!-- Envía los datos si son válidos -->
</form>

</body>
</html>
