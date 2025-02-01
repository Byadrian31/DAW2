<?php

/**
 * @author Adrián López Pascual
 */
session_start();
include 'functions.php';

if (!isset($_SESSION['nombre']) || $_SESSION['perfil'] !== 's') {
    header("Location: ./1.php");
    exit();
}

$empleados = $_SESSION['empleados'];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['sal'])) {
    echo "<h1>Sindicalista - {$_SESSION['nombre']}</h1>";
    echo "<p>Salario medio: " . salarioMedio($empleados) . "</p>";
} elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['cerrar'])) {
    header("Location: logout.php");
}


?>
<form action="" method="post">
    <fieldset>
        <label for="elegir">Elige que ver:</label> <br>
        <input type="checkbox" name="sal" value="min"> Salario medio <br>
        <input type="submit" value="Enviar" name="enviar">
        <input type="submit" value="Cerrar" name="cerrar">
    </fieldset>
</form>