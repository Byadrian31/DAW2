<?php

/**
 * @author Adrián López Pascual
 */

// Inicializar un array para almacenar errores de validación
$errores = [];
// Variable para guardar temporalmente el nombre del archivo subido
$foto_temporal = '';
// Directorio temporal donde se almacenarán las fotos subidas
$directorio_temporal = 'img/';

// Verificar si el formulario ha sido enviado o si se ha pulsado el botón de validar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validar el nombre
    if (empty($_POST['nombre'])) {
        $errores['nombre'] = 'El nombre completo es obligatorio';
    } elseif (ctype_alpha(str_replace(' ', '', $_POST['nombre'])) === false) {
        $errores['nombre'] = 'El nombre completo debe contener solo letras y espacios';
    }

    // Validar formato del email
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errores['email'] = 'El email no es válido';
    }

    // Validar el user
    if (empty($_POST['user'])) {
        $errores['user'] = 'El usuario completo es obligatorio';
    }

    // Validar la contraseña (mínimo 6 caracteres)
    if (empty($_POST['contraseña'])) {
        $errores['contraseña'] = 'La contraseña es obligatoria';
    } elseif (strlen($_POST['contraseña']) < 6) {
        $errores['contraseña'] = 'La contraseña debe tener al menos 6 caracteres';
    }

    // Validar trabajo
    if (empty($_POST['trabajo'])) {
        $errores['trabajo'] = 'Debe seleccionar una trabajo';
    }

    // Validar selección de poblacion 
    if (empty($_POST['poblacion'])) {
        $errores['poblacion'] = 'Debe seleccionar al menos una población';
    }

    // Validar selección de elementos afectados
    if (empty($_POST['material'])) {
        $errores['material'] = 'Debe seleccionar al menos un elemento afectado';
    }

    // Validar selección de elementos afectados
    if (empty($_POST['necesidad'])) {
        $errores['necesidad'] = 'Debe seleccionar al menos una necesidad';
    }

    // Validar LOPDGDD
    if (empty($_POST['respuesta'])) {
        $errores['respuesta'] = 'Debe elegir si acepta o no LOPDGDD';
    }



    // Validar subida de foto
    if (isset($_FILES['foto']['name'])) {
        $archivo = $_FILES['foto'];
        $max_file_size = intval($_POST['MAX_FILE_SIZE']); // Tamaño máximo desde el formulario (en bytes)
        $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION); // Obtener la extensión
        $extensiones_permitidas = 'png'; // Extensiones válidas

        // Verificar errores de subida
        if ($archivo['error'] !== UPLOAD_ERR_OK) {
            $errores['foto'] = 'El archivo supera los 100KB.';
        }

        // Validar extensión
        elseif (strtolower($extension) != $extensiones_permitidas) {
            $errores['foto'] = 'La foto debe ser PNG';
        }

        // Si no hay errores, mover el archivo a la carpeta temporal
        else {
            if (!is_dir($directorio_temporal)) {
                mkdir($directorio_temporal, 0777, true); // Crear directorio si no existe
            }

            $foto_temporal = $_POST['nombre'] . '.' . $extension; // Usar el nombre del usuario
            move_uploaded_file($archivo['tmp_name'], $directorio_temporal . $foto_temporal);
        }
    }

    // Si no se subió una nueva foto, usar la foto temporal anterior
    else {
        if (isset($_POST['foto_temporal']) && !empty($_POST['foto_temporal'])) {
            $foto_temporal = $_POST['foto_temporal'];
        } else {
            $errores['foto'] = 'La foto debe ser PNG';
        }
    }
    // Si se presionó enviar y no hay errores, redirigir a AdrianLopez_ok.php con los datos
    if (isset($_POST['enviar']) && empty($errores)) {
        if ($_POST['respuesta'] == 'No aceptar LOPDGDD') {
            echo "<p style='color:red'> Debes aceptar LOPDGDD</p>";
        } else {
            $url = 'AdrianLopez_ok.php?' .
            'nombre=' . urlencode($_POST['nombre']) .
            '&email=' . urlencode($_POST['email']) .
            '&user=' . urlencode($_POST['user']) .
            '&contraseña=' . urlencode($_POST['contraseña']) .
            '&trabajo=' . urlencode($_POST['trabajo']) .
            '&poblacion=' . urlencode($_POST['poblacion']) .
            '&material=' . urlencode(implode(',', $_POST['material'])) .
            '&necesidades=' . urlencode(implode(',', $_POST['necesidades'])) .
            '&respuesta=' . urlencode($_POST['respuesta']) .
            '&foto=' . urlencode($foto_temporal);
            header("Location: $url");

        exit;
        }
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
        .errores {
            color: red;
        }

        .exito {
            color: green;
        }
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
            <img src="img/<?= htmlspecialchars($foto_temporal) ?>" alt="Foto subida" width="200">
        <?php endif; ?>
    <?php endif; ?>

    <!-- Formulario -->
    <form action="" method="post" enctype="multipart/form-data">
        <fieldset>
            <!-- Datos personales (input) -->
            <label for="name">Nombre</label><br>
            <input type="text" name="nombre" value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>"><br>
            <label for="correo">Email</label><br>
            <input type="text" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"><br>
            <label for="usu">Usuario</label><br>
            <input type="text" name="user" value="<?= htmlspecialchars($_POST['user'] ?? '') ?>"><br>
            <label for="name">Password</label><br>
            <input type="password" name="contraseña" value="<?= htmlspecialchars($_POST['contraseña'] ?? '') ?>"><br>

            <!-- Trabajo (radio) -->
            <label for="trabajo">Trabajo:</label>
            <input type="radio" id="tr_particular" name="trabajo" value="Particular" <?= ($_POST['trabajo'] ?? '') === 'Particular' ? 'checked' : '' ?>> Particular
            <input type="radio" id="tr_empresa" name="trabajo" value="Empresa" <?= ($_POST['trabajo'] ?? '') === 'Empresa' ? 'checked' : '' ?>> Empresa
            <br>

            <!-- Población afectada (select) -->
            <label for="poblacion">Población afectada: </label>
            <select name="poblacion" id="poblacion">
                <option value="">Seleccione...</option>
                <option value="Aldaia" <?= ($_POST['poblacion'] ?? '') === 'Aldaia' ? 'selected' : '' ?>>Aldaia</option>
                <option value="Catarroja" <?= ($_POST['poblacion'] ?? '') === 'Catarroja' ? 'selected' : '' ?>>Catarroja</option>
                <option value="Paiporta" <?= ($_POST['poblacion'] ?? '') === 'Paiporta' ? 'selected' : '' ?>>Paiporta</option>
                <option value="Picaña" <?= ($_POST['poblacion'] ?? '') === 'Picaña' ? 'selected' : '' ?>>Picaña</option>
                <option value="Sedaví" <?= ($_POST['poblacion'] ?? '') === 'Sedaví' ? 'selected' : '' ?>>Sedaví</option>
            </select>
            <br>

            <!-- Elementos afectados (select múltiple) -->
            <label for="bienes">Elementos afectados: </label>
            <select name="material[]" id="material" multiple>
                <option value="">Seleccione...</option>
                <option value="Casa" <?= isset($_POST['material']) && in_array('Casa', $_POST['material']) ? 'selected' : '' ?>>Casa</option>
                <option value="Bajo" <?= isset($_POST['material']) && in_array('Bajo', $_POST['material']) ? 'selected' : '' ?>>Bajo</option>
                <option value="Comercial" <?= isset($_POST['material']) && in_array('Comercial', $_POST['material']) ? 'selected' : '' ?>>Comercial</option>
                <option value="Sótanos" <?= isset($_POST['material']) && in_array('Sótanos', $_POST['material']) ? 'selected' : '' ?>>Sótanos</option>
                <option value="Garaje" <?= isset($_POST['material']) && in_array('Garaje', $_POST['material']) ? 'selected' : '' ?>>Garaje</option>
                <option value="Trastero" <?= isset($_POST['material']) && in_array('Trastero', $_POST['material']) ? 'selected' : '' ?>>Trastero</option>
                <option value="Vehículo" <?= isset($_POST['material']) && in_array('Vehículo', $_POST['material']) ? 'selected' : '' ?>>Vehículo</option>
            </select>
            <br>

            <!-- Necesidades (checkbox) -->
            <label for="necesidad">Necesidades:</label>
            <input type="checkbox" name="necesidad[]" value="Extracción de lodo" <?= in_array('Extracción de lodo', $_POST['necesidad'] ?? []) ? 'checked' : '' ?>> Extracción de lodo
            <input type="checkbox" name="necesidad[]" value="Limpieza" <?= in_array('Limpieza', $_POST['necesidad'] ?? []) ? 'checked' : '' ?>> Limpieza
            <input type="checkbox" name="necesidad[]" value="Desinfección y secado" <?= in_array('Desinfección y secado', $_POST['necesidad'] ?? []) ? 'checked' : '' ?>> Desinfección y secado
            <input type="checkbox" name="necesidad[]" value="Revisión de Estructura" <?= in_array('Revisión de Estructura', $_POST['necesidad'] ?? []) ? 'checked' : '' ?>> Revisión de Estructura
            <input type="checkbox" name="necesidad[]" value="Tareas reconstrucción" <?= in_array('Tareas reconstrucción', $_POST['necesidad'] ?? []) ? 'checked' : '' ?>> Tareas reconstrucción
            <input type="checkbox" name="necesidad[]" value="Excarcelación de coches" <?= in_array('Excarcelación de coches', $_POST['necesidad'] ?? []) ? 'checked' : '' ?>> Excarcelación de coches
            <br>

            <!-- LOPDGDD (radio) -->
            <label for="acepta">LOPDGDD:</label>
            <input type="radio" name="respuesta" value="Aceptar LOPDGDD" <?= ($_POST['resultado'] ?? '') === 'Aceptar LOPDGDD' ? 'checked' : '' ?>> Aceptar LOPDGDD
            <input type="radio" name="respuesta" value="No aceptar LOPDGDD" <?= ($_POST['resultado'] ?? '') === 'No aceptar LOPDGDD' ? 'checked' : '' ?>> No aceptar LOPDGDD
            <br>

            <!-- Campo para subir foto -->
            <input type="hidden" name="MAX_FILE_SIZE" value="100000">
            <label for="foto">Adjuntar foto:</label>
            <input type="file" id="foto" name="foto"> <!-- Permite cargar un archivo -->
            <input type="hidden" name="foto_temporal" value="<?= htmlspecialchars($foto_temporal) ?>"> <!-- Campo oculto para mantener el nombre de la foto temporal -->

            <br>

            <!-- Botones para interactuar con el formulario -->
            <button type="submit" name="limpiar">Limpiar</button> <!-- Limpia los campos del formulario -->
            <button type="submit" name="validar">Validar</button> <!-- Valida los datos ingresados -->
            <button type="submit" name="enviar">Enviar</button> <!-- Envía los datos si son válidos -->
        </fieldset>
    </form>