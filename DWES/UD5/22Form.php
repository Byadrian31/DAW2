<?php

    $email = htmlspecialchars(urldecode($_GET['email']));
    // Verifica si el checkbox 'cond' está presente y si su valor es '1'
    $acceptsAds = isset($_GET['cond']) && $_GET['cond'] === '1' ? 'Sí' : 'No'; 
    echo "Tu correo es: " . $email;
    echo "<br>";
    if ($acceptsAds === "No") {
        echo "No has aceptado recibir publicidad";
    } else {
        echo "Has aceptado recibir publicidad";
    }


?>
