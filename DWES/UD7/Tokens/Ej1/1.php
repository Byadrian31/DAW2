<?php
/**
 * @author Adrián López Pascual
 */

/*
Crea un token de formulario para el formulario del ejercicio 1 de Roles (Gerente, Sindicalista y
Responsable de Nóminas) de modo que se pueda asegurar la sesión de cada usuario desde la
página del formulario a la página personalizada de cada uno. Debes comprobar el resultado
avisando en caso de que el token no coincida. Puedes añadir un botón cambiar SID que
generará un nuevo token en la sesión y así comprobar que detecta si la SID no coincide.
*/

session_start();

// Inicializar la lista de empleados
$_SESSION['empleados'] = [
    "Alejandro" => 2000,
    "Peter" => 1400,
    "Silvia" => 1200,
    "Adriana" => 1000
];

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
        $_SESSION['perfil'] = $_POST['perfil'];
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autenticación - Adrián López Pascual</title>
</head>
<body>
    <h1>Autenticación de Usuario</h1>
    <form action="" method="post">
        <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
        <fieldset>
            <legend>Datos personales</legend>
            <label for="nombre">Nombre:</label><br>
            <input type="text" name="nombre" id="nombre" required>
            <br><br>
            <label for="perfil">Perfil:</label><br>
            <select name="perfil" id="perfil">
                <option value="g">Gerente</option>
                <option value="s">Sindicalista</option>
                <option value="r">Responsable de Nóminas</option>
            </select>
            <br><br>
            <input type="submit" value="Enviar" name="enviar">
        </fieldset>
    </form>
</body>
</html>
