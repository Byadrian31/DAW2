<?php
/**
 * @author Adrián López Pascual
 */
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['enviar'])) {
    $_SESSION['nombre'] = $_POST['nombre'];
    $_SESSION['perfil'] = $_POST['perfil'];

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
            header("Location: 1.php");
            exit();
    }
}

// Si alguien intenta acceder a `comp.php` sin enviar datos, redirigir al formulario
header("Location: 1.php");
exit();
