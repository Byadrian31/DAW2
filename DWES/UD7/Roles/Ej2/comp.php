<?php
/**
 * @author Adrián López Pascual
 */
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['enviar'])) {
    $_SESSION['nombre'] = $_POST['nombre'];
    $_SESSION['apellido'] = $_POST['apellido'];
    $_SESSION['asignatura'] = $_POST['asignatura'];
    $_SESSION['grupo'] = $_POST['grupo'];
    $_SESSION['edad'] = $_POST['edad'];
    $_SESSION['cargo'] = $_POST['cargo'];

    // Redirigir según acl
    if ($_SESSION['cargo'] == 'si'  && $_SESSION['edad'] == 'mayor') {
        header("Location: director.php");
        exit();
    } elseif ($_SESSION['cargo'] == 'no' && $_SESSION['edad'] == 'mayor') {
        header("Location: profesor.php");
        exit();
    } elseif ($_SESSION['cargo'] == 'si' && $_SESSION['edad'] == 'menor') {
        header("Location: delegado.php");
        exit();
    }  elseif ($_SESSION['cargo'] == 'no' && $_SESSION['edad'] == 'menor') {
        header("Location: estudiante.php");
        exit();
    } else {
        session_destroy();
        header("Location: 2.php");
        exit();
    }


}

// Si alguien intenta acceder a `comp.php` sin enviar datos, redirigir al formulario
header("Location: 2.php");
exit();
