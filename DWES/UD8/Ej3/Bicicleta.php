<?php

/**
 * @author Adrián López Pascual
 */
include "Vehiculo.php"; // Se incluye la clase base Vehiculo

// Clase Bicicleta que hereda de Vehiculo
class Bicicleta extends Vehiculo {
    
    // Método para realizar un caballito con la bicicleta.
    public function hacerCaballito() {
        echo "🎉 ¡Estás haciendo un caballito con la bicicleta! 🎉\n";
    }

    // Método para poner la cadena en la bicicleta.
    public function ponerCadena() {
        echo "🔧 Has puesto la cadena correctamente en la bicicleta.\n";
    }

    
    // Método que redefine la visualización de kilómetros recorridos.
    public function verKMRecorridos() {
        return "🚴 Bicicleta - " . parent::verKMRecorridos();
    }
}
