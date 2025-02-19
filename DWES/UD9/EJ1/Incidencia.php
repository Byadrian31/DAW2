<?php
/**
 * Clase Incidencia para gestionar incidencias en la BD INCIDENCIAS
 * @author Adrián López Pascual
 */
include_once "../traitDB.php";

class Incidencia {
    use traitDB;

    private $codigo;
    private $estado;
    private $puesto;
    private $problema;
    private $resolucion;

    public function __construct($codigo, $estado, $puesto, $problema, $resolucion = "") {
        $this->codigo = $codigo;
        $this->estado = $estado;
        $this->puesto = $puesto;
        $this->problema = $problema;
        $this->resolucion = $resolucion;
    }

    // Getters y Setters
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

    public static function resetearBD() {
        $pdo = self::connectDB();
        $pdo->exec("DELETE FROM INCIDENCIA;");
    }

    public static function creaIncidencia($puesto, $problema) {
        $pdo = self::connectDB();
        $codigo = rand(1000, 9999);
        $stmt = $pdo->prepare("INSERT INTO INCIDENCIA (CODIGO, ESTADO, PUESTO, PROBLEMA) VALUES (?, 'PENDIENTE', ?, ?)");
        if ($stmt->execute([$codigo, $puesto, $problema])) {
            return new Incidencia($codigo, 'PENDIENTE', $puesto, $problema);
        }
        return null;
    }

    public function resuelve($resolucion) {
        $pdo = self::connectDB();
        $stmt = $pdo->prepare("UPDATE INCIDENCIA SET ESTADO = 'RESUELTA', RESOLUCION = ? WHERE CODIGO = ?");
        if ($stmt->execute([$resolucion, $this->codigo])) {
            $this->setEstado('RESUELTA');
            $this->setResolucion($resolucion);
        }
    }

    public function actualizaIncidencia($estado, $problema, $puesto, $resolucion) {
        $pdo = self::connectDB();
        $stmt = $pdo->prepare("UPDATE INCIDENCIA SET ESTADO = COALESCE(NULLIF(?, ''), ESTADO), PROBLEMA = COALESCE(NULLIF(?, ''), PROBLEMA), PUESTO = COALESCE(NULLIF(?, ''), PUESTO), RESOLUCION = COALESCE(NULLIF(?, ''), RESOLUCION) WHERE CODIGO = ?");
        $stmt->execute([$estado, $problema, $puesto, $resolucion, $this->codigo]);
    }

    public static function leeIncidencia($codigo) {
        $pdo = self::connectDB();
        $stmt = $pdo->prepare("SELECT * FROM INCIDENCIA WHERE CODIGO = ?");
        $stmt->execute([$codigo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function leeTodasIncidencias() {
        $pdo = self::connectDB();
        $stmt = $pdo->query("SELECT * FROM INCIDENCIA");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getPendientes() {
        $pdo = self::connectDB();
        $stmt = $pdo->query("SELECT COUNT(*) FROM INCIDENCIA WHERE ESTADO = 'PENDIENTE'");
        return $stmt->fetchColumn();
    }

    public function borraIncidencia() {
        $pdo = self::connectDB();
        $stmt = $pdo->prepare("DELETE FROM INCIDENCIA WHERE CODIGO = ?");
        $stmt->execute([$this->codigo]);
    }

    public function __toString() {
        return "Incidencia #{$this->getCodigo()} en puesto {$this->getPuesto()}: {$this->getProblema()} - Estado: {$this->getEstado()}. " . ($this->getResolucion() ? "Resolución: {$this->getResolucion()}" : "") . "\n";
    }
}
?>
