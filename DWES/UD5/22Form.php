<?php

/**
 * @author Adrián López Pascual
 */


if (isset($_POST['enviar'])) {
    $email = $_POST['email'];
    $acceptsAds = isset($_POST['cond']) ? 'Has aceptado la publicidad' : 'No has aceptado la publicidad';

    // Validar el correo
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo $email;
    echo "<br>";
    echo $acceptsAds;
    } else {
        echo "<p>Correo inválido</p>";
    }
}


?>
