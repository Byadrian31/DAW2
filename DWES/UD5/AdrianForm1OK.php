<?php
if (isset($_GET['enviar'])) {
    echo "<h2>Datos Enviados:</h2>";
    echo "<p><i>Nombre:</i> <b> " . ($_GET['name']) . "</b></p>";
    echo "<p><i>Apellidos:</i> <b> " . ($_GET['ape']) . "</b></p>";
    echo "<p><i>Sexo:</i> <b> " . (isset($_GET['sexo']) ? ($_GET['sexo']) : 'No seleccionado') . "</b></p>";
    echo "<p><i>Correo electrónico:</i> <b> " . ($_GET['email']) . "</b></p>";
    echo "<p><i>Provincia:</i> <b> " . ($_GET['provincia']) . "</b></p>";
    echo "<p><i>Deseo recibir información:</i> <b> " . (isset($_GET['condiciones']) ? "Ha seleccionado recibir ofertas" : "No ha seleccionado recibir ofertas") . "</b> </p>";
    echo "<p><i>Condiciones:</i> <b> " . (isset($_GET['condiciones2']) ? "Ha aceptado las condiciones" : "No ha aceptado las condiciones") . "</b></p>";
 }
 ?>