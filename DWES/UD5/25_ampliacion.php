<?php

/**
 * @author Adrián López Pascual
 */

/*
25. Crea una Web para obtener los siguientes datos: Nombre completo, Contraseña (mínimo 6 
caracteres), Nivel de Estudios(Sin estudios, Educación Secundaria Obligatoria, Bachillerato, 
Formación Profesional, Estudios Universitarios), Nacionalidad (Española, Otra), Idiomas 
(Español, Inglés, Francés, Alemán Italiano), Email, Adjuntar Foto (sólo extensiones jpg, gif y 
png, tamaño máximo 50 KB). Además de las comprobaciones de validación, se debe comprobar 
que sube fichero, que el fichero tiene extensión (puedes usar explode()) y ésta es válida, que hay 
directorio donde guardarlo y que se genera con nombre único. Si todo ha ido bien, redirige al 
usuario a una página donde se le indique que se ha procesado con éxito e incluye tu nombre y 
grupo de clase.
*/

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
            move_uploaded_file($_FILES['foto']['tmp_name'], $directorio . $nombre_archivo_unico);
        }
    } else {
        $errores['foto'] = 'Debe seleccionar una foto';
    }

    // Si no hay errores, redirige a la página de éxito con los datos necesarios
    if (empty($errores)) {
        $nombre = urlencode($_POST['nombre']);  // Codifica el nombre para que no haya problemas con caracteres especiales
        header("Location: exito.php?nombre=$nombre");  // Pasa el nombre como parámetro GET
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
        <label for="nombre">Nombre Completo:</label>
        <input type="text" name="nombre" id="nombre" value="<?= isset($_POST['nombre']) ? $_POST['nombre'] : '' ?>"><br>
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
        <input type="email" name="email" id="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>"><br>
        <?php if (isset($errores['email'])): ?>
            <span style="color:red;"><?= $errores['email'] ?></span><br>
        <?php endif; ?>

        <label for="foto">Adjuntar Foto (jpg, gif, png máximo 50KB):</label>
        <input type="file" name="foto" id="foto"><br>
        <?php if (isset($errores['foto'])): ?>
            <span style="color:red;"><?= $errores['foto'] ?></span><br>
        <?php endif; ?>
        <input type="reset" value="Limpiar">
        <input type="button" value="Validar" name="validar">
        <input type="submit" value="Enviar" name="enviar">
    </form>
</body>
</html>