<?php
session_start();

// Verificar si el usuario ha pasado por el formulario
if (!isset($_SESSION['usuario']) || !isset($_SESSION['form_token']) || !isset($_SESSION['edad']) || !isset($_SESSION['cargo'])) {
    $_SESSION['frase'] = "<h1 style='color:red;'>Acceso denegado. Por favor, inicia sesión.</h1>";
    header("Location: 2.php");
    exit();
}

// Redirigir según la lógica
if ($_SESSION['cargo'] == 'si'  && $_SESSION['edad'] == 'mayor') {
    header("Location: director.php");
    exit();
} elseif ($_SESSION['cargo'] == 'no' && $_SESSION['edad'] == 'mayor') {
    header("Location: profesor.php");
    exit();
} elseif ($_SESSION['cargo'] == 'si' && $_SESSION['edad'] == 'menor') {
    header("Location: delegado.php");
    exit();
} elseif ($_SESSION['cargo'] == 'no' && $_SESSION['edad'] == 'menor') {
    header("Location: estudiante.php");
    exit();
} else {
    session_destroy();
    header("Location: 2.php");
    exit();
}
