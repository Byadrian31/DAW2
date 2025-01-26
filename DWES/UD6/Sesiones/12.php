<?php

/**
 * @author Adrián López Pascual
 */

/*
Aplica la sesión en el ejercicio 24 de la UD5 para poder pasar los datos en lugar de construir la
url para enviarlos.
*/

session_start(); // Iniciar sesión

// Inicia el almacenamiento de errores
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

    if (empty($_POST['peso']) || !is_numeric($_POST['peso']) || $_POST['peso'] < 10 || $_POST['peso'] > 150) {
        $errores['peso'] = 'El peso es obligatorio y debe ser un número entre 10 y 150';
    }

    if (empty($_POST['sexo'])) {
        $errores['sexo'] = 'El sexo es obligatorio';
    }

    if (empty($_POST['estado'])) {
        $errores['estado'] = 'El estado civil es obligatorio';
    }

    if (empty($_POST['aficion'])) {
        $errores['aficion'] = 'Debe seleccionar al menos una afición';
    }

    // Si no hay errores, guardar los datos en la sesión y redirigir
    if (empty($errores)) {
        $_SESSION['datos'] = $_POST; // Guardar los datos en la sesión
        header('Location: 12Datos.php'); // Redirigir a la segunda página
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
            
            <label for="apellido">Apellidos: </label>
            <input type="text" name="apellido" id="apellido" value="<?= isset($_POST['apellido']) ? htmlspecialchars($_POST['apellido']) : '' ?>">
            <?php if (isset($errores['apellido'])): ?>
                <span style="color:red;"><?= $errores['apellido'] ?></span>
            <?php endif; ?><br>
            
            <label for="edad">Edad: </label>
            <input type="number" name="edad" id="edad" value="<?= isset($_POST['edad']) ? htmlspecialchars($_POST['edad']) : '' ?>">
            <?php if (isset($errores['edad'])): ?>
                <span style="color:red;"><?= $errores['edad'] ?></span>
            <?php endif; ?><br>

            <label for="peso">Peso: </label>
            <input type="number" name="peso" id="peso" placeholder="entre 10 y 150" value="<?= isset($_POST['peso']) ? htmlspecialchars($_POST['peso']) : '' ?>">
            <?php if (isset($errores['peso'])): ?>
                <span style="color:red;"><?= $errores['peso'] ?></span>
            <?php endif; ?><br>

            <label for="sexo">Sexo:</label>
            <input type="radio" name="sexo" value="Masculino" <?= isset($_POST['sexo']) && $_POST['sexo'] === 'Masculino' ? 'checked' : '' ?>> Masculino
            <input type="radio" name="sexo" value="Femenino" <?= isset($_POST['sexo']) && $_POST['sexo'] === 'Femenino' ? 'checked' : '' ?>> Femenino
            <?php if (isset($errores['sexo'])): ?>
                <span style="color:red;"><?= $errores['sexo'] ?></span>
            <?php endif; ?><br>
            
            <label for="estado">Estado civil: </label>
            <select name="estado" id="estado">
                <option value="">Seleccione una opción</option>
                <option value="soltero" <?= isset($_POST['estado']) && $_POST['estado'] === 'soltero' ? 'selected' : '' ?>>Soltero</option>
                <option value="casado" <?= isset($_POST['estado']) && $_POST['estado'] === 'casado' ? 'selected' : '' ?>>Casado</option>
                <option value="viudo" <?= isset($_POST['estado']) && $_POST['estado'] === 'viudo' ? 'selected' : '' ?>>Viudo</option>
                <option value="divorciado" <?= isset($_POST['estado']) && $_POST['estado'] === 'divorciado' ? 'selected' : '' ?>>Divorciado</option>
                <option value="otro" <?= isset($_POST['estado']) && $_POST['estado'] === 'otro' ? 'selected' : '' ?>>Otro</option>
            </select>
            <?php if (isset($errores['estado'])): ?>
                <span style="color:red;"><?= $errores['estado'] ?></span>
            <?php endif; ?><br>
            
            <label for="aficion">Aficiones: </label>
            <select name="aficion[]" id="aficion" multiple>
                <option value="cine" <?= isset($_POST['aficion']) && in_array('cine', $_POST['aficion']) ? 'selected' : '' ?>>Cine</option>
                <option value="deporte" <?= isset($_POST['aficion']) && in_array('deporte', $_POST['aficion']) ? 'selected' : '' ?>>Deporte</option>
                <option value="literatura" <?= isset($_POST['aficion']) && in_array('literatura', $_POST['aficion']) ? 'selected' : '' ?>>Literatura</option>
                <option value="musica" <?= isset($_POST['aficion']) && in_array('musica', $_POST['aficion']) ? 'selected' : '' ?>>Música</option>
                <option value="comics" <?= isset($_POST['aficion']) && in_array('comics', $_POST['aficion']) ? 'selected' : '' ?>>Cómics</option>
                <option value="series" <?= isset($_POST['aficion']) && in_array('series', $_POST['aficion']) ? 'selected' : '' ?>>Series</option>
                <option value="videojuegos" <?= isset($_POST['aficion']) && in_array('videojuegos', $_POST['aficion']) ? 'selected' : '' ?>>Videojuegos</option>
            </select>
            <?php if (isset($errores['aficion'])): ?>
                <span style="color:red;"><?= $errores['aficion'] ?></span>
            <?php endif; ?><br>

            <input type="submit" value="Enviar" name="enviar">
            <input type="reset" value="Borrar" name="borrar">
        </fieldset>
    </form>
</body>
</html>
