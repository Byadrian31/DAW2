<?php
    if (isset($_GET['enviar'])) {
        echo "<h2>Datos Enviados:</h2>";
        echo "<p><i>Nombre:</i> <b> " . ($_GET['name']) . "</b></p>";
        echo "<p><i>Apellidos:</i> <b> " . ($_GET['ape']) . "</b></p>";
        echo "<p><i>Correo electrónico:</i> <b> " . ($_GET['email']) . "</b></p>";
        echo "<p><i>Usuario:</i> <b> " . ($_GET['user']) . "</b></p>";
        echo "<p><i>Contraseña:</i> <b> " . ($_GET['pass']) . "</b></p>";
        echo "<p><i>Sexo:</i> <b> " . (isset($_GET['sexo']) ? ($_GET['sexo']) : 'No seleccionado') . "</b></p>";
        
        echo "<p><i>Provincia:</i> <b> " . ($_GET['provincia']) . "</b></p>";

        echo "<p><i>Horario de contacto:</i> <b> ";
        if (isset($_GET['horario'])) {
            echo (implode(" – ", $_GET['horario']));
        } else {
            echo "No seleccionado";
        }
        echo "</b></p>";

        echo "<p><i>Cómo nos has conocido:</i> <b> ";
        echo isset($_GET['amigo']) ? "Ha seleccionado amigo. " : "No ha seleccionado amigo. ";
        echo isset($_GET['web']) ? "Ha seleccionado web. " : "No ha seleccionado web. ";
        echo isset($_GET['prensa']) ? "Ha seleccionado prensa. " : "No ha seleccionado prensa. ";
        echo isset($_GET['otros']) ? "Ha seleccionado otros. " : "No ha seleccionado otros. ";
        echo "</b></p>";

        echo "<p><i>Tipo de incidencia:</i> <b> " . ($_GET['incidencia']) . "</b></p>";
        echo "<p><i>Descripción de la incidencia:</i> <b> " . ($_GET['comentario']) . "</b></p>";


    }

?>