<?php

/**
 * @author Adrián López Pascual
 */

/* 
Crea una clase llamada Persona con los atributos nombre, edad, DNI, sexo (H hombre, M
mujer), peso y altura. Define las siguientes constantes de clase: INFRAPESO (valor -1),
PESO_IDEAL (valor 0) y SOBREPESO (valor 1);
Se implementarán varios constructores:
    • En el constructor por defecto, todos los atributos excepto el DNI serán valores por
defecto según su tipo (0 números, cadena vacía para String, etc.). Sexo tendrá el valor
hombre”H” por defecto, se deberá comprobar con la función correspondiente su valor
“H” o “M”.
    • Un “constructor” con el nombre, edad y sexo, el resto por defecto.
    • Un “constructor” con todos los atributos como parámetro.
Los métodos que se implementarán son:
    • getters y setters necesarios
    • comprobarSexo($sexo): comprueba que el sexo introducido por el usuario es “H” o
“M”. Si no es correcto, asignará “H” por defecto. Sólo debe ser visible en la clase.
    • strIMC(): llamará a calcularIMC y devolverá un string con el nombre de la persona y si
está por debajo de su peso, si está en su peso ideal o si tiene sobrepeso en función de las
constantes de la clase.
    • calcularIMC(): calculará si la persona está en su peso ideal (kg/m²). Si el resultado es un
valor menor que 20, la función devuelve INFRAPESO, si el resultado es un número
entre 20 y 25 (incluidos), significa que está por debajo de su peso ideal y la función
devuelve PESO_IDEAL y si el resultado es mayor que 25 la función devuelve
SOBREPESO.
    • esMayorDeEdad(): indica si es mayor de edad, devuelve un booleano.
    • MostrarIMC(): devuelve el String generado por la función strIMC
    • __toString(): devuelve toda la información del objeto en un String.
Se creará un trait para usar en la clase Persona con dos funciones:
    • generarDNI(): función pública que genera un número aleatorio de 8 cifras, y calcula el
resto de su división por 23. Luego llamará a una función generaLetraDNI($idLetra) del
mismo trait para obtener la letra. Debe devolver el número DNI obtenido junto con su
letra correspondiente. Este método sera invocado en el constructor de Persona.
    • generaLetraDNI($idLetra): devuelve la letra en la posición indicada ('T', 'R', 'W', 'A', 'G',
'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E'). No debe ser visible
fuera de la clase
*/

// Trait para generar el DNI de forma automática
trait GeneradorDNI {
    // Genera un DNI con un número aleatorio y su correspondiente letra
    public function generarDNI() {
        $numero = str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT); // Genera un número de 8 dígitos
        $letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E']; // Lista de letras para calcular el DNI
        $letra = $this->generaLetraDNI($numero % 23); // Obtiene la letra correspondiente
        return $numero . $letra; // Retorna el DNI completo
    }

    // Obtiene la letra correspondiente al DNI según el índice calculado
    private function generaLetraDNI($idLetra) {
        $letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E'];
        return $letras[$idLetra]; // Retorna la letra correspondiente
    }
}

// Definición de la clase Persona
class Persona {
    use GeneradorDNI; // Uso del trait para generar el DNI

    // Definición de constantes para el cálculo del IMC
    const INFRAPESO = -1;
    const PESO_IDEAL = 0;
    const SOBREPESO = 1;

    // Atributos privados de la clase
    private $nombre;
    private $edad;
    private $DNI;
    private $sexo;
    private $peso;
    private $altura;

    // Constructor por defecto, inicializa valores predeterminados
    public function __construct() {
        $this->nombre = ""; // Nombre vacío por defecto
        $this->edad = 0; // Edad por defecto en 0
        $this->DNI = $this->generarDNI(); // Genera un DNI aleatorio
        $this->sexo = "H"; // Por defecto, el sexo es "H"
        $this->peso = 0; // Peso en 0 kg
        $this->altura = 0; // Altura en 0 metros
    }

    // Constructor que recibe nombre, edad y sexo
    public static function consNomEdSex($nombre, $edad, $sexo) {
        $instancia = new self();
        $instancia->nombre = $nombre;
        $instancia->edad = $edad;
        $instancia->sexo = $instancia->comprobarSexo($sexo); // Verifica que el sexo sea válido
        return $instancia;
    }

    // Constructor que recibe todos los atributos
    public static function consFull($nombre, $edad, $sexo, $peso, $altura) {
        $instancia = new self();
        $instancia->nombre = $nombre;
        $instancia->edad = $edad;
        $instancia->DNI = $instancia->generarDNI(); // Genera un DNI nuevo
        $instancia->sexo = $instancia->comprobarSexo($sexo); // Verifica el sexo
        $instancia->peso = $peso;
        $instancia->altura = $altura;
        return $instancia;
    }

    // Métodos getters para obtener los atributos
    public function getNombre() { return $this->nombre; }
    public function getEdad() { return $this->edad; }
    public function getDNI() { return $this->DNI; }
    public function getSexo() { return $this->sexo; }
    public function getPeso() { return $this->peso; }
    public function getAltura() { return $this->altura; }

    // Métodos setters para modificar los atributos
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setEdad($edad) { $this->edad = $edad; }
    public function setPeso($peso) { $this->peso = $peso; }
    public function setAltura($altura) { $this->altura = $altura; }
    public function setSexo($sexo) { $this->sexo = $this->comprobarSexo($sexo); } // Usa comprobarSexo antes de asignarlo

    // Método privado para verificar que el sexo sea "H" o "M", si no, asigna "H"
    private function comprobarSexo($sexo) {
        return ($sexo == "H" || $sexo == "M") ? $sexo : "H";
    }

    // Calcula el Índice de Masa Corporal (IMC) y devuelve la categoría correspondiente
    public function calcularIMC() {
        if ($this->altura == 0) {
            return "Error: Altura no puede ser 0"; // Evita la división por 0
        }
        $imc = $this->peso / ($this->altura * $this->altura); // Fórmula del IMC
        if ($imc < 20) {
            return self::INFRAPESO; // Retorna -1 si está por debajo del peso ideal
        } elseif ($imc >= 20 && $imc <= 25) {
            return self::PESO_IDEAL; // Retorna 0 si está en el peso ideal
        } else {
            return self::SOBREPESO; // Retorna 1 si tiene sobrepeso
        }
    }

    // Devuelve un mensaje indicando el estado del IMC de la persona
    public function strIMC() {
        $resultadoIMC = $this->calcularIMC();
        if ($resultadoIMC === self::INFRAPESO) {
            return "$this->nombre está por debajo de su peso ideal.\n";
        } elseif ($resultadoIMC === self::PESO_IDEAL) {
            return "$this->nombre está en su peso ideal.\n";
        } else {
            return "$this->nombre tiene sobrepeso.\n";
        }
    }

    // Verifica si la persona es mayor de edad (18 años o más)
    public function esMayorDeEdad() {
        return $this->edad >= 18;
    }

    // Devuelve el mensaje del IMC
    public function mostrarIMC() {
        return $this->strIMC();
    }

    // Devuelve una representación en texto del objeto Persona
    public function __toString() {
        return "Nombre: $this->nombre\n" .
               "Edad: $this->edad\n" .
               "DNI: $this->DNI\n" .
               "Sexo: $this->sexo\n" .
               "Peso: $this->peso kg\n" .
               "Altura: $this->altura m\n";
    }
}

?>
