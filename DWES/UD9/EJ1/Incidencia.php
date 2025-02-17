<?php

/**
 * Clase Incidencia que gestiona el CRUD de incidencias en la BD.
 * 
 * @author Adrián López Pascual
 */
include_once "traitDB.php";

class Incidencia {
    use traitDB;

    private $codigo;
    private $descripcion;
    private $estado;
    private $solucion;

    /**
     * Constructor de la clase Incidencia.
     */
    public function __construct($codigo, $descripcion, $estado = "Pendiente", $solucion = "") {
        $this->codigo = $codigo;
        $this->descripcion = $descripcion;
        $this->estado = $estado;
        $this->solucion = $solucion;
    }

    /** Getters y Setters */
    public function getCodigo() {
        return $this->codigo;
    }
    
    public function getDescripcion() {
        return $this->descripcion;
    }
    
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
    
    public function getEstado() {
        return $this->estado;
    }
    
    public function setEstado($estado) {
        $this->estado = $estado;
    }
    
    public function getSolucion() {
        return $this->solucion;
    }
    
    public function setSolucion($solucion) {
        $this->solucion = $solucion;
    }

    /**
     * Crea una nueva incidencia en la base de datos.
     */
    public static function creaIncidencia($codigo, $descripcion) {
        $sql = "INSERT INTO INCIDENCIA (codigo, descripcion, estado, solucion) VALUES (?, ?, 'Pendiente', '')";
        self::queryPreparadaDB($sql, [$codigo, $descripcion]);
        return new self($codigo, $descripcion);
    }

    /**
     * Marca una incidencia como resuelta con una solución.
     */
    public function resuelve($solucion) {
        $sql = "UPDATE INCIDENCIA SET estado = 'Resuelta', solucion = ? WHERE codigo = ?";
        self::queryPreparadaDB($sql, [$solucion, $this->codigo]);
        $this->setEstado("Resuelta");
        $this->setSolucion($solucion);
    }

    /**
     * Obtiene el número de incidencias pendientes.
     */
    public static function getPendientes() {
        $sql = "SELECT COUNT(*) as total FROM INCIDENCIA WHERE estado = 'Pendiente'";
        $resultado = self::queryPreparadaDB($sql, []);
        return $resultado[0]['total'];
    }

    /**
     * Lee una incidencia específica.
     */
    public static function leeIncidencia($codigo) {
        $sql = "SELECT * FROM INCIDENCIA WHERE codigo = ?";
        $resultado = self::queryPreparadaDB($sql, [$codigo]);
        return $resultado ? new self($resultado[0]['codigo'], $resultado[0]['descripcion'], $resultado[0]['estado'], $resultado[0]['solucion']) : null;
    }

    /**
     * Lista todas las incidencias.
     */
    public static function leeTodasIncidencias() {
        $sql = "SELECT * FROM INCIDENCIA";
        return self::queryPreparadaDB($sql, []);
    }

    /**
     * Actualiza la información de una incidencia.
     */
    public function actualizaIncidencia($descripcion, $solucion) {
        $sql = "UPDATE INCIDENCIA SET descripcion = ?, solucion = ? WHERE codigo = ?";
        self::queryPreparadaDB($sql, [$descripcion, $solucion, $this->codigo]);
        $this->setDescripcion($descripcion);
        $this->setSolucion($solucion);
    }

    /**
     * Elimina una incidencia de la base de datos.
     */
    public function borraIncidencia() {
        $sql = "DELETE FROM INCIDENCIA WHERE codigo = ?";
        self::queryPreparadaDB($sql, [$this->codigo]);
    }

    /**
     * Devuelve la incidencia en formato de texto.
     */
    public function __toString() {
        return "Incidencia " . $this->getCodigo() . ": " . $this->getDescripcion() . " (" . $this->getEstado() . ") - Solución: " . $this->getSolucion() . "\n";
    }
}
