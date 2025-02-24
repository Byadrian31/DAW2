<?php
/**
 * Clase Incidencia para gestionar incidencias en la BD INCIDENCIAS
 * @author Adrián López Pascual
 */
include_once "../traitDB.php";

class Incidencia {
    use traitDB; // Uso del trait para la conexión con la base de datos

    public static $ultimoCodigo = 1;  // Contador para generar códigos únicos
    public static $pendientes = 1;    // Contador para incidencias pendientes
    private $codigo;
    private $estado;
    private $puesto;
    private $problema;
    private $resolucion;

    // Constructor por defecto que inicializa una nueva incidencia con estado "PENDIENTE"
    public function __construct() {
        $this->codigo = ++self::$ultimoCodigo;
        $this->estado = "PENDIENTE";
        $this->puesto = "";
        $this->problema = "";
        $this->resolucion = "";
        self::$pendientes++; // Corregido: acceso estático a propiedad estática
    }

    // Métodos getter y setter para acceder y modificar las propiedades de la incidencia
    public function getCodigo() {
        return $this->codigo;
    }
    public function getEstado() {
        return $this->estado;
    }
    public function setEstado($estado) {
        $this->estado = $estado;
    }
    public function getPuesto() {
        return $this->puesto;
    }
    public function setPuesto($puesto) {
        $this->puesto = $puesto;
    }
    public function getProblema() {
        return $this->problema;
    }
    public function setProblema($problema) {
        $this->problema = $problema;
    }
    public function getResolucion() {
        return $this->resolucion;
    }
    public function setResolucion($resolucion) {
        $this->resolucion = $resolucion;
    }

    /**
     * Resetea la base de datos eliminando todas las incidencias registradas.
     */
    public static function resetearBD() {
        $pdo = self::connectDB();
        $pdo->exec("DELETE FROM INCIDENCIA;");
        self::$pendientes = 1; // Reiniciar contador de pendientes
        self::$ultimoCodigo = 1; // Reiniciar contador de códigos
    }

/**
 * Crea una nueva incidencia en la base de datos.
 * @param string $puesto    Ubicación del problema.
 * @param string $problema  Descripción del problema.
 * @return Incidencia|null  Devuelve la incidencia creada o null si falla la inserción.
 */
public static function creaIncidencia($puesto, $problema) {
    $incidencia = new self();
    $incidencia->setPuesto($puesto);
    $incidencia->setProblema($problema);
    
    $pdo = self::connectDB();
    $stmt = $pdo->prepare("INSERT INTO INCIDENCIA (CODIGO, ESTADO, PUESTO, PROBLEMA) VALUES (?, 'PENDIENTE', ?, ?)");
    if ($stmt->execute([$incidencia->getCodigo(), $puesto, $problema])) {
        echo "La incidencia con código {$incidencia->getCodigo()} se ha creado correctamente.\n";
        // Obtener y mostrar la incidencia creada usando leeIncidencia
        self::leeIncidencia($incidencia->getCodigo());
        return $incidencia;
    }
    
    echo "No se ha podido crear la incidencia.\n";
    return null;
}

    /**
     * Marca la incidencia como resuelta y actualiza su resolución en la base de datos.
     * @param string $resolucion Descripción de la solución aplicada.
     */
    public function resuelve($resolucion) {
        $pdo = self::connectDB();
        $stmt = $pdo->prepare("UPDATE INCIDENCIA SET ESTADO = 'RESUELTA', RESOLUCION = ? WHERE CODIGO = ?");
        if ($stmt->execute([$resolucion, $this->codigo])) {
            $this->setEstado('RESUELTA');
            $this->setResolucion($resolucion);
            if (self::$pendientes > 0) {
                self::$pendientes--; // Decrementar el contador de pendientes
            }
        }
    }

/**
 * Actualiza la información de una incidencia en la base de datos.
 * Si un campo está vacío, conserva su valor anterior.
 * @param string $estado Estado de la incidencia
 * @param string $problema Descripción del problema
 * @param string $puesto Ubicación del problema
 * @param string $resolucion Descripción de la solución aplicada
 * @return bool Verdadero si se actualizó correctamente, falso en caso contrario
 */
public function actualizaIncidencia($estado, $problema, $puesto, $resolucion) {
    $pdo = self::connectDB();
    $estadoAnterior = $this->getEstado();
    $estado = $estado ? : $this->getEstado();
    $problema = $problema ? : $this->getProblema();
    $puesto = $puesto ? : $this->getPuesto();
    $resolucion = $resolucion ? : $this->getResolucion();
    $stmt = $pdo->prepare("UPDATE INCIDENCIA SET ESTADO = ?, PROBLEMA = ?, PUESTO = ?, RESOLUCION = ? WHERE CODIGO = ?");
    
    if ($stmt->execute([$estado, $problema, $puesto, $resolucion, $this->getCodigo()])) {
        // Actualizar contadores si cambia el estado
        if ($estadoAnterior == 'PENDIENTE' && $estado == 'RESUELTA') {
            if (self::$pendientes > 0) {
                self::$pendientes--;
            }
        } else if ($estadoAnterior == 'RESUELTA' && $estado == 'PENDIENTE') {
            self::$pendientes++;
        }
        
        $this->setEstado($estado);
        $this->setProblema($problema);
        $this->setPuesto($puesto);
        $this->setResolucion($resolucion);
        
        echo "La incidencia con código {$this->getCodigo()} se ha modificado correctamente.\n";
        echo "Detalles de la incidencia modificada:\n";
        
        // Usar el método leeIncidencia para mostrar la información actualizada
        self::leeIncidencia($this->getCodigo());
        
        return true;
    } else {
        echo "No se ha podido modificar la incidencia con código {$this->getCodigo()}.\n";
        return false;
    }
}

    /**
     * Obtiene y muestra los datos de una incidencia específica por su código.
     * @param int $codigo  Código de la incidencia.
     * @return array|null  Devuelve un array con la información de la incidencia o null si no existe.
     */
    public static function leeIncidencia($codigo) {
        $pdo = self::connectDB();
        $stmt = $pdo->prepare("SELECT * FROM INCIDENCIA WHERE CODIGO = ?");
        $stmt->execute([$codigo]);
        $incidencia = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($incidencia) {
            echo "Detalles de la incidencia #{$incidencia['CODIGO']}:\n";
            echo "--------------------------\n";
            echo "Código: {$incidencia['CODIGO']}\n";
            echo "Estado: {$incidencia['ESTADO']}\n";
            echo "Puesto: {$incidencia['PUESTO']}\n";
            echo "Problema: {$incidencia['PROBLEMA']}\n";
            if (!empty($incidencia['RESOLUCION'])) {
                echo "Resolución: {$incidencia['RESOLUCION']}\n";
            }
            echo "--------------------------\n";
        } else {
            echo "No se encontró ninguna incidencia con el código $codigo\n";
        }
        
        return $incidencia;
    }

    /**
     * Obtiene y muestra todas las incidencias registradas en la base de datos.
     * @return array Lista de incidencias.
     */
    public static function leeTodasIncidencias() {
        $pdo = self::connectDB();
        $stmt = $pdo->query("SELECT * FROM INCIDENCIA");
        $incidencias = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($incidencias)) {
            echo "No hay incidencias registradas en la base de datos.\n";
        } else {
            echo "Listado de todas las incidencias:\n";
            foreach ($incidencias as $inc) {
                echo "Código: {$inc['CODIGO']}, Estado: {$inc['ESTADO']}, ";
                echo "Puesto: {$inc['PUESTO']}, Problema: {$inc['PROBLEMA']}\n";
                if (!empty($inc['RESOLUCION'])) {
                    echo "Resolución: {$inc['RESOLUCION']}\n";
                }
                echo "------------------------\n";
            }
        }
        
        return $incidencias;
    }

    /**
     * Obtiene el número de incidencias que aún están en estado "PENDIENTE".
     * @return int Número de incidencias pendientes.
     */
    public static function getPendientes() {
        // Podemos usar el contador estático o consultar la BD
        // Para mayor precisión, usamos la consulta a BD
        $pdo = self::connectDB();
        $stmt = $pdo->query("SELECT COUNT(*) FROM INCIDENCIA WHERE ESTADO = 'PENDIENTE'");
        return $stmt->fetchColumn();
    }

/**
 * Borra una incidencia de la base de datos y muestra todas las incidencias restantes.
 * @return bool Verdadero si se borró correctamente, falso en caso contrario.
 */
public function borraIncidencia() {
    $pdo = self::connectDB();
    $stmt = $pdo->prepare("DELETE FROM INCIDENCIA WHERE CODIGO = ?");
    $codigo = $this->codigo;
    
    // Verificar estado antes de borrar para actualizar contador
    if ($this->estado == 'PENDIENTE' && self::$pendientes > 0) {
        self::$pendientes--;
    }
    
    if ($stmt->execute([$codigo])) {
        echo "La incidencia con código {$codigo} se ha borrado correctamente.\n";
        
        // Mostrar todas las incidencias después del borrado
        echo "Listado de todas las incidencias restantes:\n";
        self::leeTodasIncidencias();
        
        return true;
    } else {
        echo "No se ha podido borrar la incidencia con código {$codigo}.\n";
        return false;
    }
}

    /**
     * Devuelve una representación en string de la incidencia.
     * @return string Descripción de la incidencia.
     */
    public function __toString() {
        return "Incidencia #{$this->getCodigo()} en puesto {$this->getPuesto()}: {$this->getProblema()} - Estado: {$this->getEstado()}. " . ($this->getResolucion() ? "Resolución: {$this->getResolucion()}" : "") . "\n";
    }
}
?>