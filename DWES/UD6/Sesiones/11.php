<?php

/**
 * @author Adrián López Pascual
 */

/*
Aplica la sesión en el ejercicio 23 de la UD5 para poder pasar los datos en lugar de construir la
url para enviarlos.
 */

session_start(); // Iniciar sesión

// Inicializa el almacenamiento de errores
$errores = [];

// Verifica si el formulario ha sido enviado
if (isset($_POST['enviar'])) {
    // Validación de datos
    if (empty($_POST['nombre']) || !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/', $_POST['nombre'])) {
        $errores['nombre'] = 'El nombre es obligatorio y tiene que ser válido';
    }

    if (empty($_POST['apellido']) || !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/', $_POST['apellido'])) {
        $errores['apellido'] = 'El apellido es obligatorio y tiene que ser válido';
    }

    if (empty($_POST['edad']) || !is_numeric($_POST['edad']) || $_POST['edad'] <= 0) {
        $errores['edad'] = 'La edad es obligatoria y debe ser un número positivo';
    }

    if (empty($_POST['estudios'])) {
        $errores['estudios'] = 'El nivel de estudios es obligatorio';
    }

    if (empty($_POST['situacion'])) {
        $errores['situacion'] = 'Debe seleccionar al menos una situación';
    }

    if (empty($_POST['hobbies'])) {
        $errores['hobbies'] = 'Debe seleccionar al menos un hobby';
    }

    // Si no hay errores, guarda los datos en la sesión y redirige
    if (empty($errores)) {
        $_SESSION['datos'] = $_POST; // Guardar los datos en la sesión
        header('Location: 11Datos.php'); // Redirigir a la segunda página
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Recogida de Datos</title>
</head>
<body>
    <h1>Adrián López Pascual</h1>
    <h1>Formulario de Datos Personales</h1>
    <form action="" method="post">
        <fieldset>
            <legend>Datos personales</legend>
            
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" id="nombre" value="<?= isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : '' ?>">
            <?php if (isset($errores['nombre'])): ?>
                <span style="color:red;"><?= $errores['nombre'] ?></span>
            <?php endif; ?><br>
            
            <label for="apellido">Apellido: </label>
            <input type="text" name="apellido" id="apellido" value="<?= isset($_POST['apellido']) ? htmlspecialchars($_POST['apellido']) : '' ?>">
            <?php if (isset($errores['apellido'])): ?>
                <span style="color:red;"><?= $errores['apellido'] ?></span>
            <?php endif; ?><br>
            
            <label for="edad">Edad: </label>
            <input type="number" name="edad" id="edad" value="<?= isset($_POST['edad']) ? htmlspecialchars($_POST['edad']) : '' ?>">
            <?php if (isset($errores['edad'])): ?>
                <span style="color:red;"><?= $errores['edad'] ?></span>
            <?php endif; ?><br>
            
            <label for="estudios">Nivel de estudios: </label>
            <select name="estudios" id="estudios">
                <option value="">Seleccione una opción</option>
                <option value="bachillerato" <?= isset($_POST['estudios']) && $_POST['estudios'] === 'bachillerato' ? 'selected' : '' ?>>Bachillerato</option>
                <option value="fp" <?= isset($_POST['estudios']) && $_POST['estudios'] === 'fp' ? 'selected' : '' ?>>Formación Profesional</option>
                <option value="universidad" <?= isset($_POST['estudios']) && $_POST['estudios'] === 'universidad' ? 'selected' : '' ?>>Universidad</option>
            </select>
            <?php if (isset($errores['estudios'])): ?>
                <span style="color:red;"><?= $errores['estudios'] ?></span>
            <?php endif; ?><br>
            
            <label for="situacion">Situación actual: </label>
            <select name="situacion[]" id="situacion" multiple>
                <option value="estudiando" <?= isset($_POST['situacion']) && in_array('estudiando', $_POST['situacion']) ? 'selected' : '' ?>>Estudiando</option>
                <option value="trabajando" <?= isset($_POST['situacion']) && in_array('trabajando', $_POST['situacion']) ? 'selected' : '' ?>>Trabajando</option>
                <option value="buscandoEmpleo" <?= isset($_POST['situacion']) && in_array('buscandoEmpleo', $_POST['situacion']) ? 'selected' : '' ?>>Buscando Empleo</option>
                <option value="desempleado" <?= isset($_POST['situacion']) && in_array('desempleado', $_POST['situacion']) ? 'selected' : '' ?>>Desempleado</option>
            </select>
            <?php if (isset($errores['situacion'])): ?>
                <span style="color:red;"><?= $errores['situacion'] ?></span>
            <?php endif; ?><br>
            
            <label for="hobbies">Hobbies: </label>
            <select name="hobbies[]" id="hobbies" multiple>
                <option value="deporte" <?= isset($_POST['hobbies']) && in_array('deporte', $_POST['hobbies']) ? 'selected' : '' ?>>Deporte</option>
                <option value="lectura" <?= isset($_POST['hobbies']) && in_array('lectura', $_POST['hobbies']) ? 'selected' : '' ?>>Lectura</option>
                <option value="musica" <?= isset($_POST['hobbies']) && in_array('musica', $_POST['hobbies']) ? 'selected' : '' ?>>Música</option>
                <option value="otro" <?= isset($_POST['hobbies']) && in_array('otro', $_POST['hobbies']) ? 'selected' : '' ?>>Otro</option>
            </select>
            <input type="text" name="hobbiesOtro" id="hobbiesOtro" placeholder="Otro" value="<?= isset($_POST['hobbiesOtro']) ? htmlspecialchars($_POST['hobbiesOtro']) : '' ?>"><br>
            <?php if (isset($errores['hobbies'])): ?>
                <span style="color:red;"><?= $errores['hobbies'] ?></span>
            <?php endif; ?><br>

            <input type="submit" value="Enviar" name="enviar">
        </fieldset>
    </form>
</body>
</html>
