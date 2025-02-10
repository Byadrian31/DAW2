<?php

/**
 * @author Adrián López Pascual
 */
include "Vehiculo.php"; // Incluye la clase Vehiculo

class Coche extends Vehiculo { // Clase Coche que hereda de Vehiculo
    // Método para llenar el depósito del coche.
    public function llenarDeposito() {
        return "⛽ Has llenado el depósito del coche.\n";
    }
    // Método para quemar rueda con el coche.
    public function quemaRueda() {
        echo "🔥 ¡El coche está quemando rueda! 🔥\n";
    }
    // Método para ver los kilómetros recorridos con el coche.
    public function verKMRecorridos() {
        return "🚗 Coche - " . parent::verKMRecorridos();
    }
}
