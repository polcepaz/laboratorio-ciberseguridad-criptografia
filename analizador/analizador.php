<?php
/**
 * Cybersecurity Cryptography Lab - Funciones de Análisis
 * 
 * Funciones para criptoanálisis de algoritmos clásicos.
 * Análisis de frecuencia y utilidades de detección.
 * 
 * @package CryptoLab
 * @subpackage Analizador
 */

/**
 * Analiza la frecuencia de caracteres en un texto.
 * 
 * @param string $texto Texto a analizar
 * @return array Datos de frecuencia ordenados
 */
function analizarFrecuencia(string $texto): array {
    $frecuencias = [];
    $total = strlen($texto);
    
    if ($total === 0) {
        return [
            'total_caracteres' => 0,
            'caracteres_unicos' => 0,
            'mas_frecuente' => 'N/A',
            'frecuencias' => []
        ];
    }
    
    // Contar frecuencia de cada carácter
    for ($i = 0; $i < $total; $i++) {
        $caracter = $texto[$i];
        $ascii = ord($caracter);
        
        if (!isset($frecuencias[$caracter])) {
            $frecuencias[$caracter] = [
                'caracter' => $caracter,
                'ascii' => $ascii,
                'frecuencia' => 0
            ];
        }
        
        $frecuencias[$caracter]['frecuencia']++;
    }
    
    // Calcular porcentajes y ordenar por frecuencia
    $resultado = [];
    foreach ($frecuencias as $dato) {
        $dato['porcentaje'] = ($dato['frecuencia'] / $total) * 100;
        $resultado[] = $dato;
    }
    
    // Ordenar por frecuencia (mayor a menor)
    usort($resultado, function($a, $b) {
        return $b['frecuencia'] <=> $a['frecuencia'];
    });
    
    // Encontrar el más frecuente
    $masFrecuente = $resultado[0]['caracter'] ?? 'N/A';
    
    return [
        'total_caracteres' => $total,
        'caracteres_unicos' => count($frecuencias),
        'mas_frecuente' => $masFrecuente,
        'frecuencias' => array_slice($resultado, 0, 30) // Limitar a 30 para la tabla
    ];
}

/**
 * Analiza si un texto podría estar en español basándose en frecuencia de letras.
 * 
 * @param string $texto Texto a analizar
 * @return array Resultado del análisis
 */
function analizarIdioma(string $texto): array {
    $total = strlen($texto);
    if ($total === 0) {
        return ['probabilidad' => 0, 'idioma' => 'desconocido'];
    }
    
    // Frecuencias esperadas en español (en porcentaje)
    $frecuenciaEsperadaEs = [
        'a' => 12.5, 'b' => 1.4, 'c' => 4.6, 'd' => 5.9, 'e' => 13.7,
        'f' => 0.7, 'g' => 1.0, 'h' => 0.7, 'i' => 6.9, 'j' => 0.5,
        'k' => 0.1, 'l' => 4.5, 'm' => 3.2, 'n' => 7.0, 'ñ' => 0.3,
        'o' => 8.8, 'p' => 2.5, 'q' => 0.9, 'r' => 6.0, 's' => 6.5,
        't' => 5.5, 'u' => 3.2, 'v' => 1.1, 'w' => 0.0, 'x' => 0.2,
        'y' => 1.0, 'z' => 0.5
    ];
    
    // Frecuencias esperadas en inglés
    $frecuenciaEsperadaEn = [
        'a' => 8.2, 'b' => 1.5, 'c' => 2.8, 'd' => 4.3, 'e' => 12.7,
        'f' => 2.2, 'g' => 2.0, 'h' => 6.1, 'i' => 7.0, 'j' => 0.1,
        'k' => 0.8, 'l' => 4.0, 'm' => 2.4, 'n' => 6.7, 'o' => 7.5,
        'p' => 1.9, 'q' => 0.1, 'r' => 6.0, 's' => 6.3, 't' => 9.1,
        'u' => 2.8, 'v' => 1.0, 'w' => 2.4, 'x' => 0.2, 'y' => 2.0,
        'z' => 0.1
    ];
    
    // Contar letras
    $letras = [];
    $totalLetras = 0;
    
    for ($i = 0; $i < $total; $i++) {
        $caracter = strtolower($texto[$i]);
        if (ctype_alpha($caracter)) {
            if (!isset($letras[$caracter])) {
                $letras[$caracter] = 0;
            }
            $letras[$caracter]++;
            $totalLetras++;
        }
    }
    
    if ($totalLetras === 0) {
        return ['probabilidad' => 0, 'idioma' => 'sin letras'];
    }
    
    // Calcular diferencia con español
    $diferenciaEs = 0;
    foreach ($frecuenciaEsperadaEs as $letra => $esperada) {
        $real = isset($letras[$letra]) ? ($letras[$letra] / $totalLetras) * 100 : 0;
        $diferenciaEs += abs($esperada - $real);
    }
    
    // Calcular diferencia con inglés
    $diferenciaEn = 0;
    foreach ($frecuenciaEsperadaEn as $letra => $esperada) {
        $real = isset($letras[$letra]) ? ($letras[$letra] / $totalLetras) * 100 : 0;
        $diferenciaEn += abs($esperada - $real);
    }
    
    // Determinar idioma más probable
    if ($diferenciaEs < $diferenciaEn) {
        $probabilidad = max(0, 100 - ($diferenciaEs / 2));
        $idioma = 'español';
    } else {
        $probabilidad = max(0, 100 - ($diferenciaEn / 2));
        $idioma = 'inglés';
    }
    
    return [
        'probabilidad' => round($probabilidad, 2),
        'idioma' => $idioma,
        'diferencia_es' => round($diferenciaEs, 2),
        'diferencia_en' => round($diferenciaEn, 2)
    ];
}

/**
 * Cuenta caracteres por categoría.
 * 
 * @param string $texto Texto a analizar
 * @return array Conteo por categoría
 */
function contarCategorias(string $texto): array {
    $categorias = [
        'letras' => 0,
        'numeros' => 0,
        'espacios' => 0,
        'puntuacion' => 0,
        'otros' => 0
    ];
    
    $total = strlen($texto);
    
    for ($i = 0; $i < $total; $i++) {
        $caracter = $texto[$i];
        $ascii = ord($caracter);
        
        if (ctype_alpha($caracter)) {
            $categorias['letras']++;
        } elseif (ctype_digit($caracter)) {
            $categorias['numeros']++;
        } elseif ($ascii === 32) {
            $categorias['espacios']++;
        } elseif (in_array($ascii, array_map('ord', str_split('.,;:!?-()[]{}`\'"')))) {
            $categorias['puntuacion']++;
        } else {
            $categorias['otros']++;
        }
    }
    
    // Calcular porcentajes
    $resultado = [];
    foreach ($categorias as $categoria => $cantidad) {
        $resultado[$categoria] = [
            'cantidad' => $cantidad,
            'porcentaje' => $total > 0 ? ($cantidad / $total) * 100 : 0
        ];
    }
    
    return $resultado;
}
