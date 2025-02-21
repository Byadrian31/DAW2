<?php
include_once '../db.php';

// Función para obtener la conexión a la base de datos
function conectarDB()
{
    try {
        $dsn = "mysql:host=" . HOST . ";dbname=EMPRESA;charset=utf8";
        $conexion = new PDO($dsn, MYSQL_ROOT, MYSQL_ROOT_PASSWORD);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexion;
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
}

// Obtener datos para los selectores
$conexion = conectarDB();

// Obtener DNIs
$stmt = $conexion->query("SELECT DISTINCT DNI FROM CLIENTE ORDER BY DNI");
$dnis = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener poblaciones
$stmt = $conexion->query("SELECT DISTINCT POBLACION FROM CLIENTE WHERE POBLACION IS NOT NULL ORDER BY POBLACION");
$poblaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener proveedores
$stmt = $conexion->query("SELECT DISTINCT NIF FROM PROVEEDOR ORDER BY NIF");
$proveedores = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener productos
$stmt = $conexion->query("SELECT DISTINCT COD_PROD FROM PRODUCTO ORDER BY COD_PROD");
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        // Determina el tipo de consulta
        $tipoConsulta = $_POST['tipoConsulta'];
        $parametro = isset($_POST['parametro']) ? $_POST['parametro'] : '';

        switch ($tipoConsulta) {
                //Consultas con clientes
            case 'ClientePorDni':
                //Datos de cliente por DNI
                $consulta = "SELECT * FROM CLIENTE WHERE DNI = :dni";
                $parametros = [':dni' => $_POST['dni']];
                break;

            case 'ListadoClientes':
                //Listado de todos los clientes ordenados por dni de cliente
                $consulta = "SELECT * FROM CLIENTE ORDER BY DNI";
                $parametros = [];
                break;

            case 'ClientesDadapoblacion':
                //Datos de Clientes de una Población seleccionada ordenados por dni de cliente
                $consulta = "SELECT * FROM CLIENTE WHERE POBLACION = :poblacion ORDER BY DNI";
                $parametros = [':poblacion' => $_POST['poblacion']];
                break;

            case 'ListadoClientesPorPoblacion':
                //Listado de Clientes de una población seleccionada ordenados por población
                $consulta = "SELECT POBLACION, COUNT(*) as total FROM CLIENTE GROUP BY POBLACION ORDER BY POBLACION";
                $parametros = [];
                break;

            case 'NumeroClientesPorPoblacion':
                //Listado de Clientes de una población seleccionada ordenados por población
                $consulta = "SELECT POBLACION, COUNT(*) as numero FROM CLIENTE GROUP BY POBLACION ORDER BY POBLACION";
                $parametros = [];
                break;

            case 'ListadoClientesConCompras':
                //Datos de Clientes que han realizado compras ordenados por dni de cliente
                $consulta = "SELECT DISTINCT c.* FROM CLIENTE c 
                            INNER JOIN COMPRA co ON c.DNI = co.CLIENTE 
                            ORDER BY c.DNI";
                $parametros = [];
                break;

            case 'ListadoClientesSinCompras':
                //Datos de Clientes que no han realizado compras ordenados por dni de cliente
                $consulta = "SELECT c.* FROM CLIENTE c 
                            LEFT JOIN COMPRA co ON c.DNI = co.CLIENTE 
                            WHERE co.PRODUCTO IS NULL 
                            ORDER BY c.DNI";
                $parametros = [];
                break;

            case 'ListadoClientesConComprasDadaPoblacion':
                //Datos de Clientes que han realizado compras de una población seleccionada ordenados por dni de cliente
                $consulta = "SELECT DISTINCT c.* FROM CLIENTE c 
                            INNER JOIN COMPRA co ON c.DNI = co.CLIENTE 
                            WHERE c.POBLACION = :poblacion 
                            ORDER BY c.DNI";
                $parametros = [':poblacion' => $_POST['poblacion']];
                break;

            case 'ListadoClientesSinComprasDadaPoblacion':
                //Datos de Clientes que no han realizado compras de una población seleccionada ordenados por dni de cliente
                $consulta = "SELECT c.* FROM CLIENTE c 
                            LEFT JOIN COMPRA co ON c.DNI = co.CLIENTE 
                            WHERE co.PRODUCTO IS NULL AND c.POBLACION = :poblacion 
                            ORDER BY c.DNI";
                $parametros = [':poblacion' => $_POST['poblacion']];
                break;

            case 'ListadoClientesConComprasValencia':
                //Datos de Clientes que han realizado compras con algún cliente de la población de Valencia ordenados por dni de cliente
                $consulta = "SELECT DISTINCT c.* FROM CLIENTE c 
                            INNER JOIN COMPRA co ON c.DNI = co.CLIENTE 
                            WHERE c.POBLACION = 'Valencia' 
                            ORDER BY c.DNI";
                $parametros = [];
                break;

            case 'ListadoClientesConTresOMasCompras':
                //Listado de clientes que han realizado 3 o más compras ordenados por dni de cliente
                $consulta = "SELECT c.*, COUNT(co.PRODUCTO) as total_compras 
                            FROM CLIENTE c 
                            INNER JOIN COMPRA co ON c.DNI = co.CLIENTE 
                            GROUP BY c.DNI 
                            HAVING total_compras >= 3 
                            ORDER BY c.DNI";
                $parametros = [];
                break;

            case 'ListadoClientesConTresComprasOMasPorPoblacion':
                //Listado de clientes que han realizado 3 compras o más de una población seleccionada ordenados por dni de cliente
                $consulta = "SELECT c.*, COUNT(co.PRODUCTO) as total_compras 
                                FROM CLIENTE c 
                                INNER JOIN COMPRA co ON c.DNI = co.CLIENTE 
                                GROUP BY c.DNI 
                                HAVING total_compras >= 3 
                                ORDER BY c.DNI";
                $parametros = [':poblacion' => $_POST['poblacion']];
                break;

                //Consultas con proveedores
            case 'ProveedorPorNif':
                //Datos de proveedor por NIF
                $consulta = "SELECT * FROM PROVEEDOR WHERE NIF = :nif";
                $parametros = [':nif' => $_POST['proveedor']];
                break;

            case 'ListadoProveedores':
                //Listado de todos los proveedores ordenados por nif de proveedor
                $consulta = "SELECT * FROM PROVEEDOR ORDER BY NIF";
                $parametros = [];
                break;

            case 'ProveedoresEmpiezanPorTexto':
                //Datos de proveedores que empiezan por un texto seleccionado ordenados por nif de proveedor
                $consulta = "SELECT * FROM PROVEEDOR WHERE NOMBRE LIKE :texto ORDER BY NIF";
                $parametros = [':texto' => $parametro . '%'];
                break;

            case 'ProveedoresProductosPvpMayor1000':
                //Datos de proveedores con productos con precio mayor a 1000€ ordenados por nif de proveedor
                $consulta = "SELECT DISTINCT pr.* FROM PROVEEDOR pr 
                            INNER JOIN PRODUCTO p ON pr.NIF = p.PROVEEDOR 
                            WHERE p.PVP > 1000 
                            ORDER BY pr.NIF";
                $parametros = [];
                break;

                //Consultas con productos
            case 'ProductoPorCodProd':
                //Datos de producto por COD_PROD
                $consulta = "SELECT * FROM PRODUCTO WHERE COD_PROD = :cod_prod";
                $parametros = [':cod_prod' => $_POST['producto']];
                break;

            case 'ListadoProductos':
                //Listado de todos los productos ordenados por codigo de producto
                $consulta = "SELECT * FROM PRODUCTO ORDER BY COD_PROD";
                $parametros = [];
                break;

            case 'ProductosPvpMenorOIgual100':
                //Datos de productos con precio menor a 100 ordenados por codigo de producto
                $consulta = "SELECT * FROM PRODUCTO WHERE PVP <= 100 ORDER BY COD_PROD";
                $parametros = [];
                break;

            case 'ProductosPVPMayorPromedio':
                //Productos con precio mayor al promedio ordenados por codigo de producto
                $consulta = "SELECT * FROM PRODUCTO WHERE PVP > (SELECT AVG(PVP) FROM PRODUCTO) ORDER BY COD_PROD";
                $parametros = [];
                break;

            case 'PvpMaximoProductos':
                //PVP máximo de los productos
                $consulta = "SELECT MAX(PVP) as pvp_maximo FROM PRODUCTO";
                $parametros = [];
                break;

            case 'PvpMinimoProductos':
                //PVP mínimo de los productos
                $consulta = "SELECT MIN(PVP) as pvp_minimo FROM PRODUCTO";
                $parametros = [];
                break;

            case 'PvpPromedioProductos':
                //PVP promedio de los productos
                $consulta = "SELECT AVG(PVP) as pvp_promedio FROM PRODUCTO";
                $parametros = [];
                break;

            case 'ProductosNombreContieneTexto':
                //Productos cuyo nombre contiene un texto dado ordenados por codigo de producto
                $consulta = "SELECT * FROM PRODUCTO WHERE NOMBRE LIKE :texto ORDER BY COD_PROD";
                $parametros = [':texto' => '%' . $parametro . '%'];
                break;

                //consultas con compras
            case 'ListadoCompras':
                //Listado de todas las compras mostrando nombre y apellidos de cliente, código y nombre de producto, nombre de proveedor, fecha y unidades ordenados por dni de cliente y código de producto
                $consulta = "SELECT c.NOMBRE as cliente_nombre, c.APELLIDOS, p.COD_PROD, p.NOMBRE as producto_nombre, 
                            pr.NOMBRE as proveedor_nombre, co.FECHA, co.UDES
                            FROM COMPRA co
                            INNER JOIN CLIENTE c ON co.CLIENTE = c.DNI
                            INNER JOIN PRODUCTO p ON co.PRODUCTO = p.COD_PROD
                            INNER JOIN PROVEEDOR pr ON p.PROVEEDOR = pr.NIF
                            ORDER BY c.DNI, p.COD_PROD";
                $parametros = [];
                break;

            case 'ComprasDeAnyo':
                //Datos de compras a partir de un año dado ordenados por fecha
                $consulta = "SELECT c.NOMBRE as cliente_nombre, c.APELLIDOS, p.COD_PROD, p.NOMBRE as producto_nombre,
                            pr.NOMBRE as proveedor_nombre, co.FECHA, co.UDES
                            FROM COMPRA co
                            INNER JOIN CLIENTE c ON co.CLIENTE = c.DNI
                            INNER JOIN PRODUCTO p ON co.PRODUCTO = p.COD_PROD
                            INNER JOIN PROVEEDOR pr ON p.PROVEEDOR = pr.NIF
                            WHERE YEAR(co.FECHA) >= :anyo
                            ORDER BY co.FECHA";
                $parametros = [':anyo' => $parametro];
                break;

            case 'ComprasDeCliente':
                //Datos de compras de un cliente dado ordenados por dni de cliente
                $consulta = "SELECT c.NOMBRE as cliente_nombre, c.APELLIDOS, p.COD_PROD, p.NOMBRE as producto_nombre,
                            pr.NOMBRE as proveedor_nombre, co.FECHA, co.UDES
                            FROM COMPRA co
                            INNER JOIN CLIENTE c ON co.CLIENTE = c.DNI
                            INNER JOIN PRODUCTO p ON co.PRODUCTO = p.COD_PROD
                            INNER JOIN PROVEEDOR pr ON p.PROVEEDOR = pr.NIF
                            WHERE c.DNI = :dni
                            ORDER BY c.DNI";
                $parametros = [':dni' => $_POST['dni']];
                break;

            case 'ComprasDeProducto':
                //Datos de compras de un producto dado ordenados por código de producto
                $consulta = "SELECT c.NOMBRE as cliente_nombre, c.APELLIDOS, p.COD_PROD, p.NOMBRE as producto_nombre,
                                pr.NOMBRE as proveedor_nombre, co.FECHA, co.UDES
                                FROM COMPRA co
                                INNER JOIN CLIENTE c ON co.CLIENTE = c.DNI
                                INNER JOIN PRODUCTO p ON co.PRODUCTO = p.COD_PROD
                                INNER JOIN PROVEEDOR pr ON p.PROVEEDOR = pr.NIF
                                WHERE p.COD_PROD = :cod_prod
                                ORDER BY p.COD_PROD";
                $parametros = [':cod_prod' => $_POST['producto']];
                break;

            case 'ComprasDeProveedor':
                //Datos de compras de un proveedor dado ordenados por nif de proveedor
                $consulta = "SELECT c.NOMBRE as cliente_nombre, c.APELLIDOS, p.COD_PROD, p.NOMBRE as producto_nombre,
                            pr.NOMBRE as proveedor_nombre, co.FECHA, co.UDES
                            FROM COMPRA co
                            INNER JOIN CLIENTE c ON co.CLIENTE = c.DNI
                            INNER JOIN PRODUCTO p ON co.PRODUCTO = p.COD_PROD
                            INNER JOIN PROVEEDOR pr ON p.PROVEEDOR = pr.NIF
                            WHERE pr.NIF = :nif
                            ORDER BY pr.NIF";
                $parametros = [':nif' => $_POST['proveedor']];
                break;

            case 'ComprasDePoblacion':
                //Datos de compras de una población dada ordenados por población
                $consulta = "SELECT c.NOMBRE as cliente_nombre, c.APELLIDOS, p.COD_PROD, p.NOMBRE as producto_nombre,
                            pr.NOMBRE as proveedor_nombre, co.FECHA, co.UDES
                            FROM COMPRA co
                            INNER JOIN CLIENTE c ON co.CLIENTE = c.DNI
                            INNER JOIN PRODUCTO p ON co.PRODUCTO = p.COD_PROD
                            INNER JOIN PROVEEDOR pr ON p.PROVEEDOR = pr.NIF
                            WHERE c.POBLACION = :poblacion
                            ORDER BY c.POBLACION";
                $parametros = [':poblacion' => $_POST['poblacion']];
                break;

            case 'ComprasDeClientesValencia':
                //Datos de compras con algún cliente de la población de Valencia ordenados por dni de cliente    
                $consulta = "SELECT c.CLIENTE, c.PRODUCTO, c.FECHA, c.UDES, 
                                 cl.NOMBRE as cliente_nombre, cl.APELLIDOS, 
                                 p.NOMBRE as producto_nombre, pr.NOMBRE as proveedor_nombre
                                 FROM COMPRA c
                                 INNER JOIN CLIENTE cl ON c.CLIENTE = cl.DNI
                                 INNER JOIN PRODUCTO p ON c.PRODUCTO = p.COD_PROD
                                 INNER JOIN PROVEEDOR pr ON p.PROVEEDOR = pr.NIF
                                 WHERE cl.POBLACION = 'Valencia'
                                 ORDER BY c.CLIENTE";
                $parametros = [];
                break;

            case 'ComprasConIgualOMasDe2Unidades':
                //Datos de compras con igual o más de 2 unidades ordenados por dni de cliente
                $consulta = "SELECT c.CLIENTE, c.PRODUCTO, c.FECHA, c.UDES,
                                 cl.NOMBRE as cliente_nombre, cl.APELLIDOS,
                                 p.NOMBRE as producto_nombre, pr.NOMBRE as proveedor_nombre
                                 FROM COMPRA c
                                 INNER JOIN CLIENTE cl ON c.CLIENTE = cl.DNI
                                 INNER JOIN PRODUCTO p ON c.PRODUCTO = p.COD_PROD
                                 INNER JOIN PROVEEDOR pr ON p.PROVEEDOR = pr.NIF
                                 WHERE c.UDES >= 2
                                 ORDER BY c.CLIENTE";
                $parametros = [];
                break;

            case 'ComprasConMasDe3productos':
                //Datos de compras con más de 3 productos ordenados por dni de cliente
                $consulta = "SELECT cl.DNI, cl.NOMBRE as cliente_nombre, cl.APELLIDOS,
                                 COUNT(c.PRODUCTO) as num_productos
                                 FROM CLIENTE cl
                                 INNER JOIN COMPRA c ON cl.DNI = c.CLIENTE
                                 GROUP BY cl.DNI, cl.NOMBRE, cl.APELLIDOS
                                 HAVING COUNT(c.PRODUCTO) > 3
                                 ORDER BY cl.DNI";
                $parametros = [];
                break;

            case 'ComprasMinimo10Unidades':
                //Datos de compras con un mínimo de 10 unidades ordenados por dni de cliente
                $consulta = "SELECT cl.DNI, cl.NOMBRE as cliente_nombre, cl.APELLIDOS,
                                 SUM(c.UDES) as total_unidades
                                 FROM CLIENTE cl
                                 INNER JOIN COMPRA c ON cl.DNI = c.CLIENTE
                                 GROUP BY cl.DNI, cl.NOMBRE, cl.APELLIDOS
                                 HAVING SUM(c.UDES) >= 10
                                 ORDER BY cl.DNI";
                $parametros = [];
                break;

            default:
                $consulta = null;
                $parametros = [];
                break;
        }

        // Ejecuta la consulta si está definida
        if (isset($consulta)) {
            $stmt = $conexion->prepare($consulta);
            $stmt->execute($parametros);
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Configura la cabecera para JSON
            header('Content-Type: application/json; charset=UTF-8');

            // Devuelve los resultados como JSON
            echo json_encode($resultados, JSON_PRETTY_PRINT);
        }

        // Cierra la conexión
        $conexion = null;
    } catch (PDOException $e) {
        // En caso de error, devuelve mensaje de error en formato JSON
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode(['error' => $e->getMessage()]);
    }
}
?>


<html>

<head>
    <meta charset="UTF-8">
    <title>Ejercicios Consulta</title>
</head>

<body>
    <h1>Consultas de la BD Empresa</h1>
    <form action="" method="post">
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

        <label for="dni">dni:</label>
        <select name="dni" id="dni">
            <?php foreach ($dnis as $dni): ?>
                <option value="<?php echo htmlspecialchars($dni['DNI']); ?>">
                    <?php echo htmlspecialchars($dni['DNI']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="poblacion">población:</label>
        <select name="poblacion" id="poblacion">
            <?php foreach ($poblaciones as $poblacion): ?>
                <option value="<?php echo htmlspecialchars($poblacion['POBLACION']); ?>">
                    <?php echo htmlspecialchars($poblacion['POBLACION']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="proveedor">proveedor:</label>
        <select name="proveedor" id="proveedor">
            <?php foreach ($proveedores as $proveedor): ?>
                <option value="<?php echo htmlspecialchars($proveedor['NIF']); ?>">
                    <?php echo htmlspecialchars($proveedor['NIF']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="producto">producto:</label>
        <select name="producto" id="producto">
            <?php foreach ($productos as $producto): ?>
                <option value="<?php echo htmlspecialchars($producto['COD_PROD']); ?>">
                    <?php echo htmlspecialchars($producto['COD_PROD']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="parametro">Parámetro de consulta:</label>
        <input type="text" name="parametro" id="parametro">
        <br>
        <input type="submit" value="Consultar">
    </form>
</body>

</html>