<?php

/**
 * @author Adrián López Pascual
 */
session_start();
include 'functions.php';

if (!isset($_SESSION['nombre']) || $_SESSION['perfil'] !== 'g') {
    header("Location: ./1.php");
    exit();
}

$empleados = $_SESSION['empleados'];
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['sal'])) {
    echo "<h1>Gerente - {$_SESSION['nombre']}</h1>";
    foreach ($_POST['sal'] as $value) {
        switch ($value) {
            case 'min':
                echo "<p>Salario mínimo: " . salarioMin($empleados) . "</p>";
                break;
            case 'med':
                echo "<p>Salario medio: " . salarioMedio($empleados) . "</p>";
                break;
            case 'max':
                echo "<p>Salario.maxcdn: " . salarioMax($empleados) . "</p>";
                break;
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['cerrar'])) {
    header("Location: logout.php");
}
?>
<form action="" method="post">
    <fieldset>
            <label for="elegir">Elige que ver:</label> <br>
            <input type="checkbox" name="sal[]" value="min"> Salario mínimo <br>
            <input type="checkbox" name="sal[]" value="med"> Salario medio <br>
            <input type="checkbox" name="sal[]" value="max"> Salario máximo <br>
            <input type="submit" value="Enviar" name="enviar">
            <input type="submit" value="Cerrar" name="cerrar">
    </fieldset>
</form>