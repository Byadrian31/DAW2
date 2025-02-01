<?php

/**
 * @author Adrián López Pascual
 */
session_start();
include 'functions.php';

$empleados = $_SESSION['empleados'];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['sal'])) {
    echo "<h1>Sindicalista - {$_SESSION['usuario']}</h1>";
    echo "<p>Salario medio: " . salarioMedio($empleados) . "</p>";
} elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['cerrar'])) {
    header("Location: logout.php");
}

if (isset($_POST['sid'])) {
    $_SESSION["token"] = bin2hex(random_bytes(24)); // Regenerar el token
}

// Comprobar si el token coincide
if (!hash_equals($_SESSION['token'], $_SESSION['form_token'])) {
    $_SESSION['frase'] = "<h1 style='color:red;'>Token incorrecto. Posible ataque CSRF.</h1>";
    header("Location: 1.php");
    exit();
}

?>
<form action="" method="post">
    <fieldset>
        <label for="elegir">Elige que ver:</label> <br>
        <input type="checkbox" name="sal" value="min"> Salario medio <br>
        <input type="submit" value="Enviar" name="enviar">
        <input type="submit" value="Cerrar" name="cerrar">
        <input type="submit" value="Cambiar SID" name="sid">
    </fieldset>
</form>