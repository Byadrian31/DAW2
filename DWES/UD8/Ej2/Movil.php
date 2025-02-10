<?php

/**
 * @author Adrián López Pascual
 */

 /*
 Implementa la clase Movil como subclase de Terminal (con atributos número y tiempo de
conversación y el método llama($terminal,$segundosDeLlamada) donde se pasa el terminal al
que se llama y se actualiza el tiempo de conversación para el terminal que llama y el llamado).
Cada móvil lleva asociada una tarifa que puede ser “rata”, “mono” o “bisonte”. El coste por
minuto es de 6, 12 y 30 céntimos respectivamente. Se tarifican los segundos exactos.
Obviamente, cuando un móvil llama a otro, se le cobra al que llama, no al que recibe la llamada.
 */

// Clase Terminal, representa un teléfono básico
class Terminal {
    protected $numero; // Número de teléfono del terminal
    protected $tiempoDeConversacion; // Tiempo total de conversación en segundos

    // Constructor de la clase Terminal
    public function __construct($numero) {
        $this->numero = $numero;
        $this->tiempoDeConversacion = 0;
    }

    // Método para realizar una llamada desde el terminal
    public function llama(Terminal $terminal, $segundosDeLlamada) {
        $this->tiempoDeConversacion += $segundosDeLlamada;
        $terminal->tiempoDeConversacion += $segundosDeLlamada;
    }

    // Método para formatear el tiempo en minutos y segundos
    protected function formatearTiempo($segundos) {
        $minutos = floor($segundos / 60); // Calcula los minutos completos
        $segundos = $segundos % 60; // Calcula los segundos restantes
        return "$minutos m y $segundos s"; // Retorna el tiempo formateado
    }

    // Método __toString()
    public function __toString() {
        return "Nº " . $this->numero . " – " . $this->formatearTiempo($this->tiempoDeConversacion) . " de conversación en total";
    }
}

// Clase Movil, extiende Terminal y añade funcionalidades adicionales
class Movil extends Terminal {
    private $tarifa; // Tarifa del móvil (rata, mono o bisonte)
    private $costeTotal; // Coste total de llamadas realizadas
    private $tiempoTarificado; // Tiempo de llamadas iniciadas por este móvil

    // Tarifa en céntimos por minuto
    private static $tarifas = [
        "rata" => 0.06,     // 6 céntimos por minuto
        "mono" => 0.12,     // 12 céntimos por minuto
        "bisonte" => 0.30   // 30 céntimos por minuto
    ];

    // Constructor de la clase Movil
    public function __construct($numero, $tarifa) {
        parent::__construct($numero); // Llama al constructor de la clase padre (Terminal)
        $this->tarifa = strtolower($tarifa); // Convierte la tarifa a minúsculas
        $this->costeTotal = 0; // Inicializa el coste total de llamadas en 0
        $this->tiempoTarificado = 0; // Inicializa el tiempo tarificado en 0
    }

    // Método para realizar una llamada desde el móvil
    public function llama(Terminal $terminal, $segundosDeLlamada) {
        parent::llama($terminal, $segundosDeLlamada); // Llama al método de la clase padre

        // Registra el tiempo solo si este móvil es el que hace la llamada
        $this->tiempoTarificado += $segundosDeLlamada;

        // Calcula el coste de la llamada en euros si la tarifa existe
        if (isset(self::$tarifas[$this->tarifa])) {
            $this->costeTotal += (self::$tarifas[$this->tarifa] / 60) * $segundosDeLlamada;
        }
    }

    // Metodo __toString()
    public function __toString() {
        return parent::__toString() . 
               " - tarificados " . $this->formatearTiempo($this->tiempoTarificado) .
               " por un importe de " . number_format($this->costeTotal, 2) . " euros";
    }
}
