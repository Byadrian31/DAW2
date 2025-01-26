<?php

/**
 * @author Adrián López Pascual
 */

/* 
 Aplica la sesión en el ejercicio 25 de la UD5 para poder pasar los datos en lugar de construir la
url para enviarlos (de la foto sólo enviaremos nombre, extensión, ruta y tamaño).
 */

session_start(); // Iniciar sesión

// Inicia el almacenamiento de errores
$errores = [];

// Verifica si el formulario ha sido enviado
if (isset($_POST['enviar'])) {
    // Validaciones de datos
    if (empty($_POST['nombre']) || !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/', $_POST['nombre'])) {
        $errores['nombre'] = 'El nombre completo es obligatorio';
    }

    if (strlen($_POST['contraseña']) < 6) {
        $errores['contraseña'] = 'La contraseña debe tener al menos 6 caracteres';
    }

    if (empty($_POST['nivel_estudios'])) {
        $errores['nivel_estudios'] = 'Debe seleccionar un nivel de estudios';
    }

    if (empty($_POST['nacionalidad'])) {
        $errores['nacionalidad'] = 'Debe seleccionar una nacionalidad';
    }

    if (empty($_POST['idiomas'])) {
        $errores['idiomas'] = 'Debe seleccionar al menos un idioma';
    }

    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errores['email'] = 'El email es obligatorio y debe tener un formato válido';
    }

    // Validación de archivo
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        $extensiones_validas = ['jpg', 'jpeg', 'gif', 'png'];
        $nombre_archivo = $_FILES['foto']['name'];
        $extension = strtolower(pathinfo($nombre_archivo, PATHINFO_EXTENSION));

        if (!in_array($extension, $extensiones_validas)) {
            $errores['foto'] = 'La imagen debe tener una extensión válida (jpg, gif, png)';
        }

        if ($_FILES['foto']['size'] > 51200) {  // 50 KB
            $errores['foto'] = 'El archivo debe pesar como máximo 50 KB';
        }

        // Si no hay errores y el archivo es válido
        if (empty($errores)) {
            // Directorio donde guardar las imágenes
            $directorio = 'uploads/';
            if (!is_dir($directorio)) {
                mkdir($directorio, 0777, true);  // Crear el directorio si no existe
            }

            // Generar un nombre único para el archivo
            $nombre_archivo_unico = uniqid('foto_', true) . '.' . $extension;

            // Mover el archivo al directorio
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $directorio . $nombre_archivo_unico)) {
                // Guardar información del archivo en la sesión
                $_SESSION['foto'] = [
                    'nombre' => $nombre_archivo_unico,
                    'extension' => $extension,
                    'ruta' => $directorio . $nombre_archivo_unico,
                    'tamaño' => $_FILES['foto']['size']
                ];
            } else {
                $errores['foto'] = 'Error al mover la foto al directorio de destino.';
            }
        }
    } else {
        $errores['foto'] = 'Debe seleccionar una foto';
    }

    // Si no hay errores, guardar los datos en la sesión y redirigir
    if (empty($errores)) {
        $_SESSION['datos'] = [
            'nombre' => $_POST['nombre'],
            'contraseña' => $_POST['contraseña'],
            'nivel_estudios' => $_POST['nivel_estudios'],
            'nacionalidad' => $_POST['nacionalidad'],
            'idiomas' => $_POST['idiomas'],
            'email' => $_POST['email'],
            'foto' => [
                'nombre' => $nombre_archivo_unico,
                'extension' => $extension,
                'ruta' => $directorio . $nombre_archivo_unico,
                'tamaño' => $_FILES['foto']['size']
            ]
        ];

        header("Location: 13Datos.php"); // Redirigir a la página de éxito
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
</head>

<body>
    <h1>Formulario de Registro</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <fieldset>
            <label for="nombre">Nombre Completo:</label>
            <input type="text" name="nombre" id="nombre" value="<?= isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : '' ?>"><br>
            <?php if (isset($errores['nombre'])): ?>
                <span style="color:red;"><?= $errores['nombre'] ?></span><br>
            <?php endif; ?>

            <label for="contraseña">Contraseña (mínimo 6 caracteres):</label>
            <input type="password" name="contraseña" id="contraseña"><br>
            <?php if (isset($errores['contraseña'])): ?>
                <span style="color:red;"><?= $errores['contraseña'] ?></span><br>
            <?php endif; ?>

            <label for="nivel_estudios">Nivel de Estudios:</label>
            <select name="nivel_estudios" id="nivel_estudios">
                <option value="">Seleccione...</option>
                <option value="sin_estudios" <?= isset($_POST['nivel_estudios']) && $_POST['nivel_estudios'] === 'sin_estudios' ? 'selected' : '' ?>>Sin estudios</option>
                <option value="secundaria" <?= isset($_POST['nivel_estudios']) && $_POST['nivel_estudios'] === 'secundaria' ? 'selected' : '' ?>>Educación Secundaria Obligatoria</option>
                <option value="bachillerato" <?= isset($_POST['nivel_estudios']) && $_POST['nivel_estudios'] === 'bachillerato' ? 'selected' : '' ?>>Bachillerato</option>
                <option value="fp" <?= isset($_POST['nivel_estudios']) && $_POST['nivel_estudios'] === 'fp' ? 'selected' : '' ?>>Formación Profesional</option>
                <option value="universidad" <?= isset($_POST['nivel_estudios']) && $_POST['nivel_estudios'] === 'universidad' ? 'selected' : '' ?>>Estudios Universitarios</option>
            </select><br>
            <?php if (isset($errores['nivel_estudios'])): ?>
                <span style="color:red;"><?= $errores['nivel_estudios'] ?></span><br>
            <?php endif; ?>

            <label for="nacionalidad">Nacionalidad:</label>
            <select name="nacionalidad" id="nacionalidad">
                <option value="espanola" <?= isset($_POST['nacionalidad']) && $_POST['nacionalidad'] === 'espanola' ? 'selected' : '' ?>>Española</option>
                <option value="otra" <?= isset($_POST['nacionalidad']) && $_POST['nacionalidad'] === 'otra' ? 'selected' : '' ?>>Otra</option>
            </select><br>
            <?php if (isset($errores['nacionalidad'])): ?>
                <span style="color:red;"><?= $errores['nacionalidad'] ?></span><br>
            <?php endif; ?>

            <label for="idiomas">Idiomas:</label><br>
            <input type="checkbox" name="idiomas[]" value="espanol" <?= isset($_POST['idiomas']) && in_array('espanol', $_POST['idiomas']) ? 'checked' : '' ?>> Español<br>
            <input type="checkbox" name="idiomas[]" value="ingles" <?= isset($_POST['idiomas']) && in_array('ingles', $_POST['idiomas']) ? 'checked' : '' ?>> Inglés<br>
            <input type="checkbox" name="idiomas[]" value="frances" <?= isset($_POST['idiomas']) && in_array('frances', $_POST['idiomas']) ? 'checked' : '' ?>> Francés<br>
            <input type="checkbox" name="idiomas[]" value="aleman" <?= isset($_POST['idiomas']) && in_array('aleman', $_POST['idiomas']) ? 'checked' : '' ?>> Alemán<br>
            <input type="checkbox" name="idiomas[]" value="italiano" <?= isset($_POST['idiomas']) && in_array('italiano', $_POST['idiomas']) ? 'checked' : '' ?>> Italiano<br>
            <?php if (isset($errores['idiomas'])): ?>
                <span style="color:red;"><?= $errores['idiomas'] ?></span><br>
            <?php endif; ?>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>"><br>
            <?php if (isset($errores['email'])): ?>
                <span style="color:red;"><?= $errores['email'] ?></span><br>
            <?php endif; ?>

            <label for="foto">Adjuntar Foto (jpg, gif, png máximo 50KB):</label>
            <input type="file" name="foto" id="foto"><br>
            <?php if (isset($errores['foto'])): ?>
                <span style="color:red;"><?= $errores['foto'] ?></span><br>
            <?php endif; ?>

            <input type="submit" value="Enviar" name="enviar">
        </fieldset>
    </form>
</body>

</html>