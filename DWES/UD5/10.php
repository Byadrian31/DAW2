<?php

/**
 * @author Adrián López Pascual
 */

/*
10. Ejercicio 23 Dado un vector asociativo de trabajadores con su salario, crea usando funciones 
y a criterio del usuario, el salario máximo, el salario mínimo y el salario medio. (puede elegir uno 
de ellos, varios o todos)
*/

 // Función para sacar el salario máximo
 function salarioMax($trabajadores) {
    $max = 0;
    foreach ($trabajadores as $salario) {
        if ($salario > $max) {
            $max = $salario;
        }
    }
    return $max;
}

// Función para sacar el salario mínimo
function salarioMin($trabajadores) {
    $min = salarioMax($trabajadores);
    foreach ($trabajadores as $salario) {
        if ($salario < $min) {
            $min = $salario;
        }
    }
    return $min;
}

// Función para sacar el salario medio
function salarioMedio($trabajadores) {
    $media = 0;
    foreach ($trabajadores as $salario) {
        $media += $salario;
    }
    $media = $media / count($trabajadores);
    return $media;
}



function elegir($op,$trabajadores) {
    switch ($op) {
        case 'max':
            printf("El salario máximo es %.2f <br>", salarioMax($trabajadores));
            break;
        
        case 'min':
            printf("El salario mínimo es %.2f <br>", salarioMin($trabajadores));
            break;
        
        case 'med':
            printf("El salario medio es %.2f <br>", salarioMedio($trabajadores));
            break;

        default:
            # code...
            break;
    }
}

if (isset($_POST['enviar'])) {
    // Creo el array con trabajadores y sus respectivos salarios
    $trabajadores = [
        "Alejandro" => 2000,
        "Peter" => 1400,
        "Silvia" => 1200,
        "Adriana" => 1000
    ];

    $op = $_POST['opcion'];
    
    // Bucle para mostrar la lista de trabajadores
    echo "La lista de trabajadores: <br>";
    echo "-------------------------- <br>";
    foreach ($trabajadores as $trabajador => $salario) {
        echo "$trabajador: $salario <br>";
    }
    echo "-------------------------- <br>";
    
    // Bucle para mostrar los valores que el usuario desee
    foreach ($op as $value) {
        echo "<p>" . elegir($value, $trabajadores,) . "</p>";
    }
    
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adrián López Pascual</title>
</head>

<body>
    <h1>Adrián López Pascual</h1>
    <form action="" method="post">
        <fieldset>
            <legend>Salarios trabajadores</legend>
            <select name="opcion[]" multiple >
                <option value="max">Salario máximo</option>
                <option value="min">Salario mínimo</option>
                <option value="med">Salario medio</option>
            </select>
            
            <input type="submit" value="Enviar" name="enviar">
        </fieldset>
    </form>
</body>

</html>