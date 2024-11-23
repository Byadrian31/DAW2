<?php

/**
 * @author Adrián López Pascual
 */

/*
24. Escribe un formulario de recogida de datos que conste de dos páginas: En la primera página 
se solicitan los datos y se muestran errores tras validarlos. En la segunda página se muestra toda 
la información introducida por el usuario si no hay errores errores. Los datos a introducir son: 
Nombre, Apellidos, Edad, Peso (entre 10 y 150), Sexo, Estado Civil (Soltero, Casado, Viudo, 
Divorciado, Otro) Aficiones: Cine, Deporte, Literatura, Música, Cómics, Series, Videojuegos. 
Debe tener los botones de Enviar y Borrar
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
    if (empty($_GET['peso']) || !is_numeric($_GET['peso']) || $_GET['peso'] < 10 || $_GET['peso'] > 150) {
        $errores['peso'] = 'El peso es obligatorio y debe ser un número entre 10 y 150';
    }

    if (empty($_GET['sexo'])) {
        $errores['sexo'] = 'El sexo es obligatorio';
    }

    if (empty($_GET['estado'])) {
        $errores['estado'] = 'El estado civil es obligatorio';
    }

    if (empty($_GET['aficion'])) {
        $errores['aficion'] = 'Debe seleccionar al menos una afición';
    }

    // Si no hay errores, redirige a la segunda página con los datos en la URL
    if (empty($errores)) {
        header('Location: 24Datos.php?' . http_build_query($_GET)); 
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
            
            <label for="apellido">Apellidos: </label>
            <input type="text" name="apellido" id="apellido" value="<?= isset($_GET['apellido']) ? $_GET['apellido'] : '' ?>">
            <?php if (isset($errores['apellido'])): ?>
                <span style="color:red;"><?= $errores['apellido'] ?></span>
            <?php endif; ?><br>
            
            <label for="edad">Edad: </label>
            <input type="number" name="edad" id="edad" value="<?= isset($_GET['edad']) ? $_GET['edad'] : '' ?>">
            <?php if (isset($errores['edad'])): ?>
                <span style="color:red;"><?= $errores['edad'] ?></span>
            <?php endif; ?><br>

            <label for="peso">Peso: </label>
            <input type="number" name="peso" id="peso" placeholder="entre 10 y 150" value="<?= isset($_GET['peso']) ? $_GET['peso'] : '' ?>">
            <?php if (isset($errores['peso'])): ?>
                <span style="color:red;"><?= $errores['peso'] ?></span>
            <?php endif; ?><br>

            <label for="sexo">Sexo:</label>
            <input type="radio" name="sexo" value="Masculino" <?= isset($_GET['sexo']) && $_GET['sexo'] === 'Masculino' ? 'checked' : '' ?>> Masculino
            <input type="radio" name="sexo" value="Femenino" <?= isset($_GET['sexo']) && $_GET['sexo'] === 'Femenino' ? 'checked' : '' ?>> Femenino
            <?php if (isset($errores['sexo'])): ?>
                <span style="color:red;"><?= $errores['sexo'] ?></span>
            <?php endif; ?><br>
            
            <label for="estado">Estado civil: </label>
            <select name="estado" id="estado">
                <option value="">Seleccione una opción</option>
                <option value="soltero" <?= isset($_GET['estado']) && $_GET['estado'] === 'soltero' ? 'selected' : '' ?>>Soltero</option>
                <option value="casado" <?= isset($_GET['estado']) && $_GET['estado'] === 'casado' ? 'selected' : '' ?>>Casado</option>
                <option value="viudo" <?= isset($_GET['estado']) && $_GET['estado'] === 'viudo' ? 'selected' : '' ?>>Viudo</option>
                <option value="divorciado" <?= isset($_GET['estado']) && $_GET['estado'] === 'divorciado' ? 'selected' : '' ?>>Divorciado</option>
                <option value="otro" <?= isset($_GET['estado']) && $_GET['estado'] === 'otro' ? 'selected' : '' ?>>Otro</option>
            </select>
            <?php if (isset($errores['estado'])): ?>
                <span style="color:red;"><?= $errores['estado'] ?></span>
            <?php endif; ?><br>
            
            
            <label for="aficion">Aficiones: </label>
            <select name="aficion[]" id="aficion" multiple>
                <option value="cine" <?= isset($_GET['aficion']) && in_array('cine', $_GET['aficion']) ? 'selected' : '' ?>>Cine</option>
                <option value="deporte" <?= isset($_GET['aficion']) && in_array('deporte', $_GET['aficion']) ? 'selected' : '' ?>>Deporte</option>
                <option value="literatura" <?= isset($_GET['aficion']) && in_array('literatura', $_GET['aficion']) ? 'selected' : '' ?>>Literatura</option>
                <option value="musica" <?= isset($_GET['aficion']) && in_array('musica', $_GET['aficion']) ? 'selected' : '' ?>>Música</option>
                <option value="comics" <?= isset($_GET['aficion']) && in_array('comics', $_GET['aficion']) ? 'selected' : '' ?>>Cómics</option>
                <option value="series" <?= isset($_GET['aficion']) && in_array('series', $_GET['aficion']) ? 'selected' : '' ?>>Series</option>
                <option value="videojuegos" <?= isset($_GET['aficion']) && in_array('videojuegos', $_GET['aficion']) ? 'selected' : '' ?>>Videojuegos</option>
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
