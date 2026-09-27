<?php
/**
 * Cybersecurity Cryptography Lab - Funciones Vigenère
 * 
 * Implementación del algoritmo de cifrado Vigenère.
 * Cifrado polialfabético con clave de texto.
 * 
 * @package CryptoLab
 * @subpackage Vigenere
 */

// Constantes del algoritmo
define('VIGENERE_ALFABETO', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
define('VIGENERE_TAM', 26);

/**
 * Cifra un texto utilizando el algoritmo Vigenère.
 * 
 * Fórmula: C = (P + K) mod 26
 * 
 * @param string $texto Texto a cifrar
 * @param string $clave Clave de cifrado (solo letras)
 * @return string Texto cifrado
 */
function cifrarVigenere(string $texto, string $clave): string {
    $resultado = '';
    $clave = strtoupper($clave);
    $longitudTexto = strlen($texto);
    $longitudClave = strlen($clave);
    $indiceClave = 0; // Índice para recorrer la clave
    
    for ($i = 0; $i < $longitudTexto; $i++) {
        $caracter = $texto[$i];
        $ascii = ord($caracter);
        
        // Verificar si es una letra
        if (($ascii >= 65 && $ascii <= 90) || ($ascii >= 97 && $ascii <= 122)) {
            // Es una letra - procesar con Vigenère
            $esMayuscula = ($ascii >= 65 && $ascii <= 90);
            
            // Obtener posición del texto (0-25)
            if ($esMayuscula) {
                $posicionTexto = $ascii - 65; // A=0
            } else {
                $posicionTexto = $ascii - 97; // a=0
            }
            
            // Obtener valor de la clave (0-25)
            $letraClave = $clave[$indiceClave % $longitudClave];
            $posicionClave = ord($letraClave) - 65;
            
            // Aplicar fórmula de cifrado
            $nuevaPosicion = ($posicionTexto + $posicionClave) % VIGENERE_TAM;
            
            // Convertir de nuevo a carácter
            if ($esMayuscula) {
                $resultado .= chr($nuevaPosicion + 65);
            } else {
                $resultado .= chr($nuevaPosicion + 97);
            }
            
            // Avanzar el índice de la clave
            $indiceClave++;
        } else {
            // No es letra - mantener sin cambios y NO avanzar la clave
            $resultado .= $caracter;
        }
    }
    
    return $resultado;
}

/**
 * Descifra un texto cifrado con Vigenère.
 * 
 * Fórmula: P = (C - K + 26) mod 26
 * 
 * @param string $textoCifrado Texto cifrado a descifrar
 * @param string $clave Clave de descifrado
 * @return string Texto descifrado
 */
function descifrarVigenere(string $textoCifrado, string $clave): string {
    $resultado = '';
    $clave = strtoupper($clave);
    $longitudTexto = strlen($textoCifrado);
    $longitudClave = strlen($clave);
    $indiceClave = 0;
    
    for ($i = 0; $i < $longitudTexto; $i++) {
        $caracter = $textoCifrado[$i];
        $ascii = ord($caracter);
        
        // Verificar si es una letra
        if (($ascii >= 65 && $ascii <= 90) || ($ascii >= 97 && $ascii <= 122)) {
            // Es una letra - procesar con Vigenère
            $esMayuscula = ($ascii >= 65 && $ascii <= 90);
            
            // Obtener posición del texto cifrado (0-25)
            if ($esMayuscula) {
                $posicionTexto = $ascii - 65;
            } else {
                $posicionTexto = $ascii - 97;
            }
            
            // Obtener valor de la clave (0-25)
            $letraClave = $clave[$indiceClave % $longitudClave];
            $posicionClave = ord($letraClave) - 65;
            
            // Aplicar fórmula de descifrado (sumar 26 para evitar negativos)
            $nuevaPosicion = ($posicionTexto - $posicionClave + VIGENERE_TAM) % VIGENERE_TAM;
            
            // Convertir de nuevo a carácter
            if ($esMayuscula) {
                $resultado .= chr($nuevaPosicion + 65);
            } else {
                $resultado .= chr($nuevaPosicion + 97);
            }
            
            // Avanzar el índice de la clave
            $indiceClave++;
        } else {
            // No es letra - mantener sin cambios
            $resultado .= $caracter;
        }
    }
    
    return $resultado;
}

/**
 * Genera la tabla de pasos para visualizar el proceso Vigenère.
 * 
 * @param string $texto Texto original
 * @param string $clave Clave utilizada
 * @param string $accion 'cifrar' o 'descifrar'
 * @return array Array con los pasos del proceso
 */
function generarPasosVigenere(string $texto, string $clave, string $accion): array {
    $pasos = [];
    $clave = strtoupper($clave);
    $longitudTexto = strlen($texto);
    $longitudClave = strlen($clave);
    $indiceClave = 0;
    $posicion = 1;
    
    for ($i = 0; $i < $longitudTexto; $i++) {
        $caracter = $texto[$i];
        $ascii = ord($caracter);
        
        // Verificar si es una letra
        if (($ascii >= 65 && $ascii <= 90) || ($ascii >= 97 && $ascii <= 122)) {
            // Es una letra
            $esMayuscula = ($ascii >= 65 && $ascii <= 90);
            
            // Obtener posición del texto
            if ($esMayuscula) {
                $posicionTexto = $ascii - 65;
            } else {
                $posicionTexto = $ascii - 97;
            }
            
            // Obtener letra y valor de la clave
            $letraClave = $clave[$indiceClave % $longitudClave];
            $valorClave = ord($letraClave) - 65;
            
            // Calcular resultado según la acción
            if ($accion === 'cifrar') {
                $nuevaPosicion = ($posicionTexto + $valorClave) % VIGENERE_TAM;
                $letraResultado = chr($nuevaPosicion + ($esMayuscula ? 65 : 97));
            } else {
                $nuevaPosicion = ($posicionTexto - $valorClave + VIGENERE_TAM) % VIGENERE_TAM;
                $letraResultado = chr($nuevaPosicion + ($esMayuscula ? 65 : 97));
            }
            
            $pasos[] = [
                'posicion' => $posicion,
                'texto' => $caracter,
                'valor_texto' => $posicionTexto,
                'letra_clave' => $letraClave,
                'valor_clave' => $valorClave,
                'resultado' => $letraResultado,
                'es_letra' => true
            ];
            
            // Avanzar índice de clave
            $indiceClave++;
        } else {
            // No es letra
            $pasos[] = [
                'posicion' => $posicion,
                'texto' => $caracter,
                'valor_texto' => '-',
                'letra_clave' => '-',
                'valor_clave' => '-',
                'resultado' => $caracter,
                'es_letra' => false
            ];
        }
        
        $posicion++;
    }
    
    return $pasos;
}

/**
 * Valida que una clave sea válida para Vigenère.
 * 
 * @param string $clave Clave a validar
 * @return string|true Mensaje de error o true si es válida
 */
function validarClaveVigenere(string $clave) {
    if (empty(trim($clave))) {
        return 'La clave no puede estar vacía.';
    }
    
    if (!preg_match('/^[a-zA-Z]+$/', $clave)) {
        return 'La clave solo debe contener letras (A-Z, a-z).';
    }
    
    if (strlen($clave) < 1) {
        return 'La clave debe tener al menos 1 carácter.';
    }
    
    return true;
}
