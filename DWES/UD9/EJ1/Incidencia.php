<?php
/**
 * Clase Incidencia para gestionar incidencias en la BD INCIDENCIAS
 * @author Adrián López Pascual
 */
include_once "../traitDB.php";

class Incidencia {
    use traitDB; // Uso del trait para la conexión con la base de datos

    public static $ultimoCodigo = 0;  // Contador para generar códigos únicos
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
            return $incidencia;
        }
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
        }
    }

    /**
     * Actualiza la información de una incidencia en la base de datos.
     * Si un campo está vacío, conserva su valor anterior.
     */
    public function actualizaIncidencia($estado, $problema, $puesto, $resolucion) {
        $pdo = self::connectDB();
        $stmt = $pdo->prepare("UPDATE INCIDENCIA SET ESTADO = COALESCE(NULLIF(?, ''), ESTADO), PROBLEMA = COALESCE(NULLIF(?, ''), PROBLEMA), PUESTO = COALESCE(NULLIF(?, ''), PUESTO), RESOLUCION = COALESCE(NULLIF(?, ''), RESOLUCION) WHERE CODIGO = ?");
        $stmt->execute([$estado, $problema, $puesto, $resolucion, $this->codigo]);
    }

    /**
     * Obtiene los datos de una incidencia específica por su código.
     * @param int $codigo  Código de la incidencia.
     * @return array|null  Devuelve un array con la información de la incidencia o null si no existe.
     */
    public static function leeIncidencia($codigo) {
        $pdo = self::connectDB();
        $stmt = $pdo->prepare("SELECT * FROM INCIDENCIA WHERE CODIGO = ?");
        $stmt->execute([$codigo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene todas las incidencias registradas en la base de datos.
     * @return array Lista de incidencias.
     */
    public static function leeTodasIncidencias() {
        $pdo = self::connectDB();
        $stmt = $pdo->query("SELECT * FROM INCIDENCIA");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene el número de incidencias que aún están en estado "PENDIENTE".
     * @return int Número de incidencias pendientes.
     */
    public static function getPendientes() {
        $pdo = self::connectDB();
        $stmt = $pdo->query("SELECT COUNT(*) FROM INCIDENCIA WHERE ESTADO = 'PENDIENTE'");
        return $stmt->fetchColumn();
    }

    /**
     * Borra una incidencia de la base de datos.
     */
    public function borraIncidencia() {
        $pdo = self::connectDB();
        $stmt = $pdo->prepare("DELETE FROM INCIDENCIA WHERE CODIGO = ?");
        $stmt->execute([$this->codigo]);
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