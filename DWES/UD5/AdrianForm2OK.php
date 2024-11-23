<?php

/**
 * @author Adrián López Pascual
 */

if (isset($_POST['enviar'])) {
    echo "<h2>Datos Enviados:</h2>";
    echo "<p><i>Nombre:</i> <b> " . ($_POST['name']) . "</b></p>";
    echo "<p><i>Apellidos:</i> <b> " . ($_POST['ape']) . "</b></p>";
    echo "<p><i>Correo electrónico:</i> <b> " . ($_POST['email']) . "</b></p>";
    echo "<p><i>Usuario:</i> <b> " . ($_POST['user']) . "</b></p>";
    echo "<p><i>Contraseña:</i> <b> " . ($_POST['pass']) . "</b></p>";
    echo "<p><i>Sexo:</i> <b> " . (isset($_POST['sexo']) ? ($_POST['sexo']) : 'No seleccionado') . "</b></p>";

    echo "<p><i>Provincia:</i> <b> " . ($_POST['provincia']) . "</b></p>";

    echo "<p><i>Situación:</i> <b> ";
    if (isset($_POST['situacion'])) {
        echo (implode(" – ", $_POST['situacion']));
    } else {
        echo "No seleccionado";
    }
    echo "</b></p>";

    echo "<p><i>Descripción de la incidencia:</i> <b> " . ($_POST['comentario']) . "</b></p>";
    echo "<p><i>Deseo recibir información:</i> <b> " . (isset($_POST['condiciones']) ? "Ha seleccionado recibir ofertas" : "No ha seleccionado
    recibir ofertas") . "</b></p>";
    echo "<p><i>Condiciones:</i> <b> " . (isset($_POST['condiciones2']) ? "Ha aceptado las condiciones" : "No ha aceptado las condiciones") . "</b></p>";
}

?>