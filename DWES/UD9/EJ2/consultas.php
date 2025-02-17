<?php
/**
 * @author Adrián López Pascual
 * Ejercicio 2. Consultas
 */
include_once '../traitDB.php';

header('Content-Type: application/json; charset=UTF-8');

class Consultas {
    use traitDB;

    public static function ejecutarConsulta() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $pdo = self::connectDB2();
            $tipoConsulta = $_POST['tipoConsulta'] ?? '';
            $parametro = $_POST['parametro'] ?? '';
            $resultado = [];

            switch ($tipoConsulta) {
                // Consultas de Clientes
                case 'ClientePorDni':
                    $stmt = $pdo->prepare("SELECT * FROM CLIENTE WHERE DNI = ? ORDER BY DNI");
                    $stmt->execute([$parametro]);
                    $resultado = $stmt->fetchAll();
                    break;

                case 'ListadoClientes':
                    $stmt = $pdo->query("SELECT * FROM CLIENTE ORDER BY DNI");
                    $resultado = $stmt->fetchAll();
                    break;

                case 'ClientesDadapoblacion':
                    $stmt = $pdo->prepare("SELECT * FROM CLIENTE WHERE POBLACION = ? ORDER BY DNI");
                    $stmt->execute([$parametro]);
                    $resultado = $stmt->fetchAll();
                    break;

                case 'ListadoClientesPorPoblacion':
                    $stmt = $pdo->query("SELECT * FROM CLIENTE ORDER BY POBLACION");
                    $resultado = $stmt->fetchAll();
                    break;

                case 'NumeroClientesPorPoblacion':
                    $stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM CLIENTE WHERE POBLACION = ?");
                    $stmt->execute([$parametro]);
                    $resultado = $stmt->fetch();
                    break;

                case 'ListadoClientesConCompras':
                    $stmt = $pdo->query("SELECT DISTINCT C.* FROM CLIENTE C INNER JOIN COMPRA CO ON C.DNI = CO.CLIENTE ORDER BY C.DNI");
                    $resultado = $stmt->fetchAll();
                    break;

                case 'ListadoClientesSinCompras':
                    $stmt = $pdo->query("SELECT * FROM CLIENTE WHERE DNI NOT IN (SELECT CLIENTE FROM COMPRA) ORDER BY DNI");
                    $resultado = $stmt->fetchAll();
                    break;

                case 'ListadoProveedores':
                    $stmt = $pdo->query("SELECT * FROM PROVEEDOR ORDER BY NIF");
                    $resultado = $stmt->fetchAll();
                    break;

                case 'ProductoPorCodProd':
                    $stmt = $pdo->prepare("SELECT * FROM PRODUCTO WHERE COD_PROD = ? ORDER BY COD_PROD");
                    $stmt->execute([$parametro]);
                    $resultado = $stmt->fetchAll();
                    break;

                case 'ListadoProductos':
                    $stmt = $pdo->query("SELECT * FROM PRODUCTO ORDER BY COD_PROD");
                    $resultado = $stmt->fetchAll();
                    break;

                case 'ProductosPvpMenorOIgual100':
                    $stmt = $pdo->query("SELECT * FROM PRODUCTO WHERE PVP <= 100 ORDER BY COD_PROD");
                    $resultado = $stmt->fetchAll();
                    break;

                case 'ProductosPVPMayorPromedio':
                    $stmt = $pdo->query("SELECT * FROM PRODUCTO WHERE PVP > (SELECT AVG(PVP) FROM PRODUCTO) ORDER BY COD_PROD");
                    $resultado = $stmt->fetchAll();
                    break;

                case 'ListadoCompras':
                    $stmt = $pdo->query("
                        SELECT C.DNI, C.NOMBRE AS CLIENTE, C.APELLIDOS, 
                               P.COD_PROD, P.NOMBRE AS PRODUCTO, PR.NOMBRE AS PROVEEDOR,
                               CO.FECHA, CO.UDES
                        FROM COMPRA CO
                        JOIN CLIENTE C ON CO.CLIENTE = C.DNI
                        JOIN PRODUCTO P ON CO.PRODUCTO = P.COD_PROD
                        JOIN PROVEEDOR PR ON P.PROVEEDOR = PR.NIF
                        ORDER BY C.DNI, P.COD_PROD
                    ");
                    $resultado = $stmt->fetchAll();
                    break;

                case 'ComprasDeAnyo':
                    $stmt = $pdo->prepare("SELECT * FROM COMPRA WHERE YEAR(FECHA) = ? ORDER BY FECHA");
                    $stmt->execute([$parametro]);
                    $resultado = $stmt->fetchAll();
                    break;

                case 'ComprasDeCliente':
                    $stmt = $pdo->prepare("SELECT * FROM COMPRA WHERE CLIENTE = ? ORDER BY CLIENTE");
                    $stmt->execute([$parametro]);
                    $resultado = $stmt->fetchAll();
                    break;

                case 'ComprasDeProducto':
                    $stmt = $pdo->prepare("SELECT * FROM COMPRA WHERE PRODUCTO = ? ORDER BY PRODUCTO");
                    $stmt->execute([$parametro]);
                    $resultado = $stmt->fetchAll();
                    break;

                case 'ComprasDeProveedor':
                    $stmt = $pdo->prepare("
                        SELECT CO.* FROM COMPRA CO 
                        JOIN PRODUCTO P ON CO.PRODUCTO = P.COD_PROD 
                        WHERE P.PROVEEDOR = ? ORDER BY P.PROVEEDOR
                    ");
                    $stmt->execute([$parametro]);
                    $resultado = $stmt->fetchAll();
                    break;

                case 'ComprasConIgualOMasDe2Unidades':
                    $stmt = $pdo->query("SELECT * FROM COMPRA WHERE UDES >= 2 ORDER BY CLIENTE");
                    $resultado = $stmt->fetchAll();
                    break;

                default:
                    $resultado = ['error' => 'Consulta no válida'];
                    break;
            }

            echo json_encode($resultado, JSON_PRETTY_PRINT);
        }
    }
}

// Ejecutar la consulta automáticamente si se accede al script
Consultas::ejecutarConsulta();
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ejercicios Consulta</title>
</head>

<body>
    <h1>Consultas de la BD Empresa</h1>
    <form action="consultas.php" method="post">
        <label for="tipoConsulta">Tipo de consulta:</label>
        <select name="tipoConsulta" id="tipoConsulta">
            <option value="ClientePorDni">Cliente dado dni</option>
            <option value="ListadoClientes">Listado clientes</option>
            <option value="ClientesDadapoblacion">Clientes de una población</option>
            <option value="ListadoClientesPorPoblacion">Listado de clientes por población</option>
            <option value="NumeroClientesPorPoblacion">Número de clientes por población</option>
            <option value="ListadoClientesConCompras">Clientes con compras</option>
            <option value="ListadoClientesSinCompras">Clientes sin compras</option>
            <option value="ListadoClientesConComprasDadaPoblacion">Clientes con compras de una población</option>
            <option value="ListadoClientesSinComprasDadaPoblacion">Clientes sin compras de una población</option>
            <option value="ListadoClientesConComprasValencia">Clientes con compras de Valencia</option>
            <option value="ListadoClientesConTresOMasCompras">Clientes con 3 compras o más</option>
            <option value="ListadoClientesConTresComprasOMasPorPoblacion">Clientes con 3 compras o más de una población</option>
            <option value="ProveedorPorNif">Proveedor dado NIF</option>
            <option value="ListadoProveedores">Listado de proveedores</option>
            <option value="ProveedoresEmpiezanPorTexto">Proveedores que empiezan por un texto</option>
            <option value="ProveedoresProductosPvpMayor1000">Proveedores con productos con precio mayor a 1000€</option>
            <option value="ProductoPorCodProd">Producto dado codigo</option>
            <option value="ListadoProductos">Listado de productos</option>
            <option value="ProductosPvpMenorOIgual100">Productos con precio menor a 100</option>
            <option value="ProductosPVPMayorPromedio">Productos con precio mayor al promedio</option>
            <option value="PvpMaximoProductos">PVP máximo de los productos</option>
            <option value="PvpMinimoProductos">PVP mínimo de los productos</option>
            <option value="PvpPromedioProductos">PVP promedio de los productos</option>
            <option value="ProductosNombreContieneTexto">Productos cuyo nombre contiene un texto</option>
            <option value="ListadoCompras">Listado de compras</option>
            <option value="ComprasDeAnyo">Compras a partir de un año dado</option>
            <option value="ComprasDeCliente">Compras de un cliente dado</option>
            <option value="ComprasDeProducto">Compras de un producto dado</option>
            <option value="ComprasDeProveedor">Compras de un proveedor dado</option>
            <option value="ComprasDePoblacion">Compras de una población dada</option>
            <option value="ComprasDeClientesValencia">Compras con algún cliente de la población de Valencia</option>
            <option value="ComprasConIgualOMasDe2Unidades">Compras con 2 unidades o más</option>
            <option value="ComprasConMasDe3productos">Compras con más de 3 productos</option>
            <option value="ComprasMinimo10Unidades">Compras con un mínimo de 10 unidades</option>
        </select>
        
        <label for="parametro">Parámetro de consulta:</label>
        <input type="text" name="parametro" id="parametro">
        <br>
        <input type="submit" value="Consultar">
    </form>


<?php
// Conectar a la base de datos
$pdo = Consultas::connectDB2();

// Obtener DNIs de clientes
$stmt = $pdo->query("SELECT DNI FROM CLIENTE ORDER BY DNI");
$dnis = $stmt->fetchAll();

// Obtener poblaciones de clientes
$stmt = $pdo->query("SELECT DISTINCT POBLACION FROM CLIENTE ORDER BY POBLACION");
$poblaciones = $stmt->fetchAll();

// Obtener NIFs de proveedores
$stmt = $pdo->query("SELECT NIF FROM PROVEEDOR ORDER BY NIF");
$proveedores = $stmt->fetchAll();

// Obtener códigos de productos
$stmt = $pdo->query("SELECT COD_PROD FROM PRODUCTO ORDER BY COD_PROD");
$productos = $stmt->fetchAll();
?>

<form action="consultas.php" method="post">
    <label for="dni">DNI:</label>
    <select name="dni" id="dni">
        <?php
        // Muestra los DNIs en un select
        foreach ($dnis as $dni) {
            echo "<option value='{$dni['DNI']}'>{$dni['DNI']}</option>";
        }
        ?>
    </select>

    <label for="poblacion">Población:</label>
    <select name="poblacion" id="poblacion">
        <?php
        // Muestra las poblaciones en un select
        foreach ($poblaciones as $poblacion) {
            echo "<option value='{$poblacion['POBLACION']}'>{$poblacion['POBLACION']}</option>";
        }
        ?>
    </select>

    <label for="proveedor">Proveedor:</label>
    <select name="proveedor" id="proveedor">
        <?php
        // Muestra los NIFs de proveedores en un select
        foreach ($proveedores as $proveedor) {
            echo "<option value='{$proveedor['NIF']}'>{$proveedor['NIF']}</option>";
        }
        ?>
    </select>

    <label for="producto">Producto:</label>
    <select name="producto" id="producto">
        <?php
        // Muestra los códigos de productos en un select
        foreach ($productos as $producto) {
            echo "<option value='{$producto['COD_PROD']}'>{$producto['COD_PROD']}</option>";
        }
        ?>
    </select>

    <label for="parametro">Parámetro de consulta:</label>
    <input type="text" name="parametro" id="parametro">
    <br>
    <input type="submit" value="Consultar">
</form>

</body>


</html>
