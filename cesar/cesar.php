<?php
/**
 * Cybersecurity Cryptography Lab - Funciones César
 * 
 * Implementación del algoritmo de cifrado César mejorado.
 * Utiliza el rango completo de caracteres ASCII imprimibles (32-126).
 * 
 * @package CryptoLab
 * @subpackage Cesar
 */

// Constantes del algoritmo
define('ASCII_INICIO', 32);  // Primer carácter imprimible (espacio)
define('ASCII_FIN', 126);    // Último carácter imprimible (~)
define('TAM_ALFABETO', 95);  // 126 - 32 + 1 = 95 caracteres

/**
 * Cifra un texto utilizando el algoritmo César con ASCII imprimible.
 * 
 * Fórmula: nuevoAscii = ((posicion + desplazamiento) % 95) + 32
 * 
 * @param string $texto Texto a cifrar
 * @param int $desplazamiento Número de posiciones a desplazar (0-94)
 * @return string Texto cifrado
 */
function cifrarCesar(string $texto, int $desplazamiento): string {
    $resultado = '';
    $longitud = strlen($texto);
    
    for ($i = 0; $i < $longitud; $i++) {
        $caracter = $texto[$i];
        $ascii = ord($caracter);
        
        // Solo procesar caracteres imprimibles (32-126)
        if ($ascii >= ASCII_INICIO && $ascii <= ASCII_FIN) {
            // Paso 1: Obtener posición en el alfabeto (0-94)
            $posicion = $ascii - ASCII_INICIO;
            
            // Paso 2: Aplicar desplazamiento con módulo
            $nuevaPosicion = ($posicion + $desplazamiento) % TAM_ALFABETO;
            
            // Paso 3: Convertir de nuevo a ASCII
            $nuevoAscii = $nuevaPosicion + ASCII_INICIO;
            
            // Paso 4: Obtener el carácter resultante
            $resultado .= chr($nuevoAscii);
        } else {
            // Carácter fuera del rango imprimible, mantenerlo igual
            $resultado .= $caracter;
        }
    }
    
    return $resultado;
}

/**
 * Descifra un texto cifrado con el algoritmo César.
 * 
 * Fórmula: nuevoAscii = ((posicion - desplazamiento + 95) % 95) + 32
 * 
 * @param string $textoCifrado Texto cifrado a descifrar
 * @param int $desplazamiento Número de posiciones que se cifró (0-94)
 * @return string Texto descifrado
 */
function descifrarCesar(string $textoCifrado, int $desplazamiento): string {
    $resultado = '';
    $longitud = strlen($textoCifrado);
    
    for ($i = 0; $i < $longitud; $i++) {
        $caracter = $textoCifrado[$i];
        $ascii = ord($caracter);
        
        // Solo procesar caracteres imprimibles (32-126)
        if ($ascii >= ASCII_INICIO && $ascii <= ASCII_FIN) {
            // Paso 1: Obtener posición en el alfabeto (0-94)
            $posicion = $ascii - ASCII_INICIO;
            
            // Paso 2: Aplicar descifrado con módulo (sumar TAM_ALFABETO para evitar negativos)
            $nuevaPosicion = ($posicion - $desplazamiento + TAM_ALFABETO) % TAM_ALFABETO;
            
            // Paso 3: Convertir de nuevo a ASCII
            $nuevoAscii = $nuevaPosicion + ASCII_INICIO;
            
            // Paso 4: Obtener el carácter resultante
            $resultado .= chr($nuevoAscii);
        } else {
            // Carácter fuera del rango imprimible, mantenerlo igual
            $resultado .= $caracter;
        }
    }
    
    return $resultado;
}

/**
 * Genera la tabla de pasos para visualizar el proceso de cifrado/descifrado.
 * 
 * @param string $texto Texto original
 * @param int $desplazamiento Desplazamiento utilizado
 * @param string $accion 'cifrar' o 'descifrar'
 * @return array Array con los pasos del proceso
 */
function generarPasosCesar(string $texto, int $desplazamiento, string $accion): array {
    $pasos = [];
    $longitud = strlen($texto);
    
    for ($i = 0; $i < $longitud; $i++) {
        $caracter = $texto[$i];
        $ascii = ord($caracter);
        
        // Solo procesar caracteres imprimibles (32-126)
        if ($ascii >= ASCII_INICIO && $ascii <= ASCII_FIN) {
            // Paso 1: Obtener posición
            $posicion = $ascii - ASCII_INICIO;
            
            // Paso 2: Calcular nueva posición
            if ($accion === 'cifrar') {
                $nuevaPosicion = ($posicion + $desplazamiento) % TAM_ALFABETO;
            } else {
                $nuevaPosicion = ($posicion - $desplazamiento + TAM_ALFABETO) % TAM_ALFABETO;
            }
            
            // Paso 3: Obtener nuevo ASCII
            $nuevoAscii = $nuevaPosicion + ASCII_INICIO;
            
            // Paso 4: Obtener carácter resultado
            $resultado = chr($nuevoAscii);
            
            $pasos[] = [
                'original' => $caracter,
                'ascii' => $ascii,
                'posicion' => $posicion,
                'nueva_posicion' => $nuevaPosicion,
                'nuevo_ascii' => $nuevoAscii,
                'resultado' => $resultado
            ];
        } else {
            // Carácter fuera de rango, se mantiene igual
            $pasos[] = [
                'original' => $caracter,
                'ascii' => $ascii,
                'posicion' => 'N/A',
                'nueva_posicion' => 'N/A',
                'nuevo_ascii' => $ascii,
                'resultado' => $caracter
            ];
        }
    }
    
    return $pasos;
}

/**
 * Realiza fuerza bruta sobre un texto cifrado con César.
 * Prueba todos los desplazamientos posibles (0-94).
 * 
 * @param string $textoCifrado Texto cifrado a analizar
 * @return array Array con todos los intentos
 */
function fuerzaBrutaCesar(string $textoCifrado): array {
    $intentos = [];
    
    for ($desplazamiento = 0; $desplazamiento < TAM_ALFABETO; $desplazamiento++) {
        $textoDescifrado = descifrarCesar($textoCifrado, $desplazamiento);
        
        // Calcular puntuación de legibilidad
        $puntuacion = calcularPuntuacionLegibilidad($textoDescifrado);
        
        $intentos[] = [
            'desplazamiento' => $desplazamiento,
            'texto' => $textoDescifrado,
            'puntuacion' => $puntuacion,
            'es_posible' => $puntuacion > 50
        ];
    }
    
    // Ordenar por puntuación (mayor a menor)
    usort($intentos, function($a, $b) {
        return $b['puntuacion'] <=> $a['puntuacion'];
    });
    
    return $intentos;
}

/**
 * Calcula una puntuación de legibilidad para un texto.
 * Evalúa la presencia de caracteres comunes en español/inglés.
 * 
 * @param string $texto Texto a evaluar
 * @return int Puntuación de 0 a 100
 */
function calcularPuntuacionLegibilidad(string $texto): int {
    $puntuacion = 0;
    $longitud = strlen($texto);
    
    if ($longitud === 0) return 0;
    
    // Frecuencia aproximada de letras en español
    $frecuenciaEsperada = [
        'a' => 12.5, 'e' => 13.7, 'i' => 6.9, 'o' => 8.8, 'u' => 3.2,
        'n' => 7.0, 's' => 6.5, 'r' => 6.0, 't' => 5.5, 'l' => 4.5
    ];
    
    // Contar frecuencia de caracteres
    $frecuencia = array_count_values(str_split(strtolower($texto)));
    
    // Evaluar vocales
    $vocales = ['a', 'e', 'i', 'o', 'u'];
    foreach ($vocales as $vocal) {
        $porcentaje = isset($frecuencia[$vocal]) ? ($frecuencia[$vocal] / $longitud) * 100 : 0;
        if ($porcentaje > 5 && $porcentaje < 20) {
            $puntuacion += 10;
        }
    }
    
    // Evaluar consonantes comunes
    $consonantes = ['n', 's', 'r', 't', 'l'];
    foreach ($consonantes as $consonante) {
        $porcentaje = isset($frecuencia[$consonante]) ? ($frecuencia[$consonante] / $longitud) * 100 : 0;
        if ($porcentaje > 2 && $porcentaje < 12) {
            $puntuacion += 5;
        }
    }
    
    // Penalizar caracteres muy raros
    $caracteresRaros = ['q', 'x', 'z', 'j'];
    foreach ($caracteresRaros as $raro) {
        $porcentaje = isset($frecuencia[$raro]) ? ($frecuencia[$raro] / $longitud) * 100 : 0;
        if ($porcentaje > 5) {
            $puntuacion -= 10;
        }
    }
    
    // Bonificar espacios (los textos legibles los tienen)
    $porcentajeEspacios = isset($frecuencia[' ']) ? ($frecuencia[' '] / $longitud) * 100 : 0;
    if ($porcentajeEspacios > 5 && $porcentajeEspacios < 25) {
        $puntuacion += 20;
    }
    
    // Bonificar números y puntuación
    if (preg_match('/[0-9]/', $texto)) {
        $puntuacion += 5;
    }
    if (preg_match('/[.,;:!?]/', $texto)) {
        $puntuacion += 5;
    }
    
    // Asegurar que esté entre 0 y 100
    return max(0, min(100, $puntuacion));
}
