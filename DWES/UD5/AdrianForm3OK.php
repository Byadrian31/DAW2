<?php
if (isset($_POST['enviar'])) {
    echo "<h2>Datos Enviados:</h2>";
    echo "<p><i>Nombre:</i> <b> " . strtoupper($_POST['name']) . "</b></p>";
    echo "<p><i>Apellidos:</i> <b> " . strtoupper($_POST['ape']) . "</b></p>";
    echo "<p><i>Correo electrónico:</i> <b> " . strtoupper($_POST['email']) . "</b></p>";
    echo "<p><i>Usuario:</i> <b> " . strtoupper($_POST['user']) . "</b></p>";
    echo "<p><i>Contraseña:</i> <b> " . strtoupper($_POST['pass']) . "</b></p>";
    echo "<p><i>Sexo:</i> <b> " . (isset($_POST['sexo']) ? strtoupper($_POST['sexo']) : 'No seleccionado') . "</b></p>";

    echo "<p><i>Provincia:</i> <b> " . strtoupper($_POST['provincia']) . "</b></p>";

    echo "<p><i>Horario de contacto:</i> <b> ";
    if (isset($_POST['horario'])) {
        echo strtoupper(implode(" – ", $_POST['horario']));
    } else {
        echo "No seleccionado";
    }
    echo "</b></p>";

    echo "<p><i>Cómo nos has conocido:</i> <b> ";
    echo isset($_POST['amigo']) ? "Ha seleccionado amigo. " : "No ha seleccionado amigo. ";
    echo isset($_POST['web']) ? "Ha seleccionado web. " : "No ha seleccionado web. ";
    echo isset($_POST['prensa']) ? "Ha seleccionado prensa. " : "No ha seleccionado prensa. ";
    echo isset($_POST['otros']) ? "Ha seleccionado otros. " : "No ha seleccionado otros. ";
    echo "</b></p>";

    echo "<p><i>Descripción de la incidencia:</i> <b> " . strtoupper($_POST['comentario']) . "</b></p>";

    echo "<p><i>Deseo recibir información:</i> <b> " . (isset($_POST['condiciones']) ? "Ha seleccionado recibir ofertas" : "No ha seleccionado
    recibir ofertas") . "</b></p>";
    echo "<p><i>Condiciones:</i> <b> " . (isset($_POST['condiciones2']) ? "Ha aceptado las condiciones" : "No ha aceptado las condiciones") . "</b></p>";
}

?>