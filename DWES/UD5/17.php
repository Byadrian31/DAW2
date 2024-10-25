<?php
/**
 * @author Adrián López Pascual
 */

/*
17. Escribe un programa que dadas 10 palabras en inglés muestre su traducción al castellano a su 
derecha en una tabla. El usuario debe seleccionar la/s palabra/s a traducir (podría 
seleccionarlas todas)
*/
$palabras = [
    "apple" => "manzana",
    "red" => "rojo",
    "hello" => "hola",
    "sun" => "sol"
];

if (isset($_POST['enviar'])) {
    $words = $_POST["words"];
    // Mostrar las traducciones solo de las palabras seleccionadas
    if (!empty($words)) {
        foreach ($words as $ingles) {
            // Obtener la traducción
            $trad = $palabras[$ingles];
            echo $ingles . " = " . $trad . "<br>";
        }
    } else {
        echo "No se seleccionó ninguna palabra.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adrián López Pascual</title>
</head>
<body>
    <h1>Adrián López Pascual</h1>
    <form action="" method="post">
        <fieldset>
            <legend>Traducción:</legend>
            <select name="words[]" multiple>
                <?php
                // Cambiar el valor a la palabra en inglés
                foreach ($palabras as $ingles => $trad) {
                    ?>
                    <option value="<?php echo $ingles ?>"><?php echo $ingles ?></option>
                    <?php
                }
                ?>
            </select>
            <br>
            <input type="submit" value="Enviar" name="enviar">
        </fieldset>
    </form>
</body>
</html>
