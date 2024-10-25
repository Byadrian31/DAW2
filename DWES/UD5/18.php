<?php

/**
 * @author Adrián López Pascual
 */

function media($numeros)
{
    $total = 0;
    foreach ($numeros as $value) {
        $total += $value; // Acumula los valores
    }
    return $total / count($numeros); // Calcula la media
}

function moda($numeros)
{
    $moda = [];

    foreach ($numeros as $value) {
        if (!isset($moda[$value])) {
            $moda[$value] = 0; // Inicializar contador si no existe
        }
        $moda[$value]++;
    }

    $max = max($moda); // Encuentra la frecuencia máxima
    $resultados = array_keys($moda, $max); // Encuentra los números con la frecuencia máxima

    return $resultados; // Retorna los números que son moda
}

function mediana($numeros)
{
    // Ordenar el array
    
    $count = count($numeros);

    // Calcular el índice medio
    $indice = floor($count / 2);

    if ($count % 2 == 1) {
        // Cantidad impar: retorna el número del medio
        return $numeros[$indice];
    } else {
        // Cantidad par: retorna los dos números centrales
        return [$numeros[$indice - 1], $numeros[$indice]];
    }
}

$cantidad = isset($_POST['cant']) ? intval($_POST['cant']) : 0; // Manejo de cantidad
?>

<form action="" method="post">
    <fieldset>
        <legend>Media/Moda/Mediana</legend>
        <label for="cant">Cantidad:</label>
        <input type="text" name="cant"><br>

        <?php if ($cantidad > 0) { ?>
            <?php for ($i = 0; $i < $cantidad; $i++) { ?>
                <label for="numero<?php echo $i; ?>">Número <?php echo $i + 1; ?>:</label>
                <input type="number" name="numeros[]" id="numero<?php echo $i; ?>" required><br>
            <?php }; ?>
            Media:<input type="checkbox" name="media">
            Moda:<input type="checkbox" name="moda">
            Mediana:<input type="checkbox" name="mediana">
        <?php }; ?>


        <input type="submit" value="Enviar" name="enviar">
    </fieldset>
</form>

<?php
if (isset($_POST['enviar'])) {
    $numeros = $_POST['numeros'];

    if (isset($_POST["media"])) {
        $media = media($numeros);
        printf("<p>La media de todos los números es %.2f </p>", $media);
    }

    if (isset($_POST["moda"])) {
        $moda = moda($numeros);
        printf("<p>La moda de todos los números es: %s </p>", implode(", ", $moda));
    }

    if (isset($_POST["mediana"])) {
        $mediana = mediana($numeros);
        if (is_array($mediana)) {
            echo "La mediana es: [" . implode(", ", $mediana) . "]";
        } else {
            echo "La mediana es: " . $mediana;
        }
    }
}
?>