<?php
/**
 * @author Adrián López Pascual
 */
session_start();
 /* 
Crea un token de formulario para el formulario del ejercicio 2 de Roles (Delegado, Estudiante,
Profesor y Director) de modo que se pueda asegurar la sesión de cada usuario desde la página
del formulario a la página personalizada de cada uno. Debes comprobar el resultado avisando
en caso de que el token no coincida. Puedes añadir un botón cambiar SID que generará un
nuevo token en la sesión y así comprobar que detecta si la SID no coincide.
 */

 // Si no hay un token en la sesión, crearlo
if (!isset($_SESSION["token"])) {
    $_SESSION["token"] = bin2hex(random_bytes(24));
}

// Mostrar mensaje de error si hay
if (isset($_SESSION['frase'])) {
    echo $_SESSION['frase'];
    unset($_SESSION['frase']);
}

// Manejar el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['enviar'])) {
        $_SESSION['usuario'] = $_POST['nombre'];
        $_SESSION['apellido'] = $_POST['apellido'];
        $_SESSION['asignatura'] = $_POST['asignatura'];
        $_SESSION['grupo'] = $_POST['grupo'];
        $_SESSION['edad'] = $_POST['edad'];
        $_SESSION['cargo'] = $_POST['cargo'];
        $_SESSION['form_token'] = $_POST['token']; // Guardar el token enviado
        header("Location: ./comp.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adrián López Pascual</title>
</head>

<body>
    <h1>Adrián López Pascual</h1>
    <form action="" method="post">
    <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
        <fieldset>
            <legend>Datos personales</legend>
            <label for="nombre">Nombre:</label> <br>
            <input type="text" name="nombre" id="nombre" required>
            <br>
            <label for="apellido">Apellido:</label> <br>
            <input type="text" name="apellido" id="apellido" required>
            <br>
            <label for="asignatura">Asignatura:</label> <br>
            <input type="text" name="asignatura" id="asignatura" required>
            <br>
            <label for="grupo">Grupo:</label> <br>
            <input type="text" name="grupo" id="grupo" required>
            <br>
            <label for="edad">Edad:</label> <br>
            <input type="radio" name="edad" value="mayor" required> Mayor de edad
            <input type="radio" name="edad" value="menor" required> Menor de edad
            <br>
            <label for="cargo">Cargo:</label> <br>
            <input type="radio" name="cargo" value="si" required> Sí
            <input type="radio" name="cargo" value="no" required> No
            <br>
            
            <input type="submit" value="Enviar" name="enviar">
        </fieldset>
    </form>
</body>

</html>