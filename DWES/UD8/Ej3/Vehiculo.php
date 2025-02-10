<?php

/**
 * @author Adrián López Pascual
 */

/*
Crea la clase Vehiculo, que será la clase base para Bicicleta y Coche.
Define los atributos estáticos vehiculosCreados y kilometrosTotales para llevar el control
de los vehículos creados y la distancia total recorrida.
Cada vehículo tendrá su propio kilometraje con el atributo de instancia kilometrosRecorridos.
Se implementan métodos para avanzar, ver kilómetros recorridos y ver kilómetros totales.
*/

// Verifica que la clase no haya sido declarada previamente para evitar errores
if (!class_exists("Vehiculo")) {
    
    // Definición de la clase Vehiculo
    class Vehiculo {
        protected static $vehiculosCreados = 0; // Contador de vehículos creados
        protected static $kilometrosTotales = 0; // Contador de kilómetros totales de todos los vehículos
        protected $kilometrosRecorridos; // Kilómetros recorridos por cada vehículo

        // Constructor de la clase
        public function __construct() {
            self::$vehiculosCreados++; // Aumenta el número de vehículos creados
            $this->kilometrosRecorridos = 0; // Inicializa el contador de kilómetros recorridos
        }

        // Método para avanzar con el vehículo
        public function avanza($km) {
            $this->kilometrosRecorridos += $km; // Suma los kilómetros recorridos por este vehículo
            self::$kilometrosTotales += $km; // Suma los kilómetros al total global
        }

        // Método para ver los kilómetros recorridos por el vehículo
        public function verKMRecorridos() {
            return "Kilómetros recorridos: " . $this->kilometrosRecorridos . " km\n";
        }

        // Métodos estáticos para ver los kilómetros totales de todos los vehículos
        public static function verKMTotales() {
            return "Kilómetros totales de todos los vehículos: " . self::$kilometrosTotales . " km\n";
        }

        // Métodos estáticos para ver el número de vehículos creados
        public static function verVehiculosCreados() {
            return "Vehículos creados: " . self::$vehiculosCreados . "\n";
        }
    }
}
