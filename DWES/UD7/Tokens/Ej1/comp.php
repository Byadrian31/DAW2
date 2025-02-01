<?php
/**
 * @author Adrián López Pascual
 */
session_start();

// Verificar si el usuario ha pasado por el formulario
if (!isset($_SESSION['usuario']) || !isset($_SESSION['perfil']) || !isset($_SESSION['form_token'])) {
    $_SESSION['frase'] = "<h1 style='color:red;'>Acceso denegado. Por favor, inicia sesión.</h1>";
    header("Location: index.php");
    exit();
}


// Redirigir según el perfil
switch ($_SESSION['perfil']) {
    case 'g': // Gerente
        header("Location: gerente.php");
        exit();
    case 's': // Sindicalista
        header("Location: sindicalista.php");
        exit();
    case 'r': // Responsable de Nóminas
        header("Location: responsable.php");
        exit();
    default:
        session_destroy();
        header("Location: index.php");
        exit();
}
?>
