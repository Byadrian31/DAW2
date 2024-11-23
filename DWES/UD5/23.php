<?php

/**
 * @author Adrián López Pascual
 */

/*
23. Escribe un formulario de recogida de datos que conste de dos páginas: En la primera página 
se solicitan los datos y se muestran errores tras validarlos. En la segunda página se muestra toda 
la información introducida por el usuario si no hay errores errores. Los datos a recoger son datos 
personales, nivel de estudios (desplegable), situación actual (selección múltiple: estudiando, 
trabajando, buscando empleo, desempleado) y hobbies (marcar de varios mostrados y poner otro 
con opción a introducir texto)
*/

// Inicia el almacenamiento de errores
$errores = [];

// Verifica si el formulario ha sido enviado
if (isset($_GET['enviar'])) {
    // Validación de datos
    if (empty($_GET['nombre']) || !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/', $_GET['nombre'])) {
        $errores['nombre'] = 'El nombre es obligatorio y tiene que ser válido';
    }

    if (empty($_GET['apellido']) || !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/', $_GET['apellido'])) {
        $errores['apellido'] = 'El apellido es obligatorio y tiene que ser válido';
    }

    if (empty($_GET['edad']) || !is_numeric($_GET['edad']) || $_GET['edad'] <= 0) {
        $errores['edad'] = 'La edad es obligatoria y debe ser un número positivo';
    }

    if (empty($_GET['estudios'])) {
        $errores['estudios'] = 'El nivel de estudios es obligatorio';
    }

    if (empty($_GET['situacion'])) {
        $errores['situacion'] = 'Debe seleccionar al menos una situación';
    }

    if (empty($_GET['hobbies'])) {
        $errores['hobbies'] = 'Debe seleccionar al menos un hobby';
    }

    // Si no hay errores, redirige a la segunda página con los datos en la URL
    if (empty($errores)) {
        header('Location: 23Datos.php?' . http_build_query($_GET)); 
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
    <form action="" method="get">
        <fieldset>
            <legend>Datos personales</legend>
            
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" id="nombre" value="<?= isset($_GET['nombre']) ? $_GET['nombre'] : '' ?>">
            <?php if (isset($errores['nombre'])): ?>
                <span style="color:red;"><?= $errores['nombre'] ?></span>
            <?php endif; ?><br>
            
            <label for="apellido">Apellido: </label>
            <input type="text" name="apellido" id="apellido" value="<?= isset($_GET['apellido']) ? $_GET['apellido'] : '' ?>">
            <?php if (isset($errores['apellido'])): ?>
                <span style="color:red;"><?= $errores['apellido'] ?></span>
            <?php endif; ?><br>
            
            <label for="edad">Edad: </label>
            <input type="number" name="edad" id="edad" value="<?= isset($_GET['edad']) ? $_GET['edad'] : '' ?>">
            <?php if (isset($errores['edad'])): ?>
                <span style="color:red;"><?= $errores['edad'] ?></span>
            <?php endif; ?><br>
            
            <label for="estudios">Nivel de estudios: </label>
            <select name="estudios" id="estudios">
                <option value="">Seleccione una opción</option>
                <option value="bachillerato" <?= isset($_GET['estudios']) && $_GET['estudios'] === 'bachillerato' ? 'selected' : '' ?>>Bachillerato</option>
                <option value="fp" <?= isset($_GET['estudios']) && $_GET['estudios'] === 'fp' ? 'selected' : '' ?>>Formación Profesional</option>
                <option value="universidad" <?= isset($_GET['estudios']) && $_GET['estudios'] === 'universidad' ? 'selected' : '' ?>>Universidad</option>
            </select>
            <?php if (isset($errores['estudios'])): ?>
                <span style="color:red;"><?= $errores['estudios'] ?></span>
            <?php endif; ?><br>
            
            <label for="situacion">Situación actual: </label>
            <select name="situacion[]" id="situacion" multiple>
                <option value="estudiando" <?= isset($_GET['situacion']) && in_array('estudiando', $_GET['situacion']) ? 'selected' : '' ?>>Estudiando</option>
                <option value="trabajando" <?= isset($_GET['situacion']) && in_array('trabajando', $_GET['situacion']) ? 'selected' : '' ?>>Trabajando</option>
                <option value="buscandoEmpleo" <?= isset($_GET['situacion']) && in_array('buscandoEmpleo', $_GET['situacion']) ? 'selected' : '' ?>>Buscando Empleo</option>
                <option value="desempleado" <?= isset($_GET['situacion']) && in_array('desempleado', $_GET['situacion']) ? 'selected' : '' ?>>Desempleado</option>
            </select>
            <?php if (isset($errores['situacion'])): ?>
                <span style="color:red;"><?= $errores['situacion'] ?></span>
            <?php endif; ?><br>
            
            <label for="hobbies">Hobbies: </label>
            <select name="hobbies[]" id="hobbies" multiple>
                <option value="deporte" <?= isset($_GET['hobbies']) && in_array('deporte', $_GET['hobbies']) ? 'selected' : '' ?>>Deporte</option>
                <option value="lectura" <?= isset($_GET['hobbies']) && in_array('lectura', $_GET['hobbies']) ? 'selected' : '' ?>>Lectura</option>
                <option value="musica" <?= isset($_GET['hobbies']) && in_array('musica', $_GET['hobbies']) ? 'selected' : '' ?>>Música</option>
                <option value="otro" <?= isset($_GET['hobbies']) && in_array('otro', $_GET['hobbies']) ? 'selected' : '' ?>>Otro</option>
            </select>
            <input type="text" name="hobbiesOtro" id="hobbiesOtro" placeholder="Otro" value="<?= isset($_GET['hobbiesOtro']) ? $_GET['hobbiesOtro'] : '' ?>"><br>
            <?php if (isset($errores['hobbies'])): ?>
                <span style="color:red;"><?= $errores['hobbies'] ?></span>
            <?php endif; ?><br>

            <input type="submit" value="Enviar" name="enviar">
        </fieldset>
    </form>
</body>
</html>
