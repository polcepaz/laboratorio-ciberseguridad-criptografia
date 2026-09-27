<?php
/**
 * Cybersecurity Cryptography Lab - Procesamiento de Archivos
 * 
 * Funciones para validar y procesar archivos de texto.
 * 
 * @package CryptoLab
 * @subpackage Archivos
 */

/**
 * Valida un archivo subido.
 * 
 * @param array $archivo Array $_FILES['archivo']
 * @return string|true Mensaje de error o true si es válido
 */
function validarArchivo(array $archivo) {
    // Verificar que no haya error de upload
    if ($archivo['error'] !== UPLOAD_ERR_OK) {
        $errores = [
            UPLOAD_ERR_INI_SIZE => 'El archivo excede el tamaño máximo permitido por el servidor.',
            UPLOAD_ERR_FORM_SIZE => 'El archivo excede el tamaño máximo permitido en el formulario.',
            UPLOAD_ERR_PARTIAL => 'El archivo fue parcialmente subido.',
            UPLOAD_ERR_NO_FILE => 'No se subió ningún archivo.',
            UPLOAD_ERR_NO_TMP_DIR => 'Falta una carpeta temporal en el servidor.',
            UPLOAD_ERR_CANT_WRITE => 'Error al escribir el archivo en disco.',
            UPLOAD_ERR_EXTENSION => 'Una extensión del PHP detuvo la subida del archivo.'
        ];
        
        return $errores[$archivo['error']] ?? 'Error desconocido al subir el archivo.';
    }
    
    // Validar extensión
    $nombre = $archivo['name'];
    $extension = strtolower(pathinfo($nombre, PATHINFO_EXTENSION));
    
    if ($extension !== 'txt') {
        return 'Solo se permiten archivos con extensión .txt. Extensión detectada: .' . htmlspecialchars($extension);
    }
    
    // Validar MIME type (permitir text/plain y application/octet-stream para algunos navegadores)
    $mimePermitidos = ['text/plain', 'text/html', 'application/octet-stream'];
    if (!in_array($archivo['type'], $mimePermitidos) && !empty($archivo['type'])) {
        // Algunos navegadores no envían el MIME type correctamente, así que solo advertimos
        // No bloqueamos la operación
    }
    
    // Validar tamaño (máximo 100 KB)
    $tamMaximo = 100 * 1024; // 100 KB en bytes
    if ($archivo['size'] > $tamMaximo) {
        $tamMb = round($archivo['size'] / (1024 * 1024), 2);
        return "El archivo excede el tamaño máximo permitido (100 KB). Tamaño actual: {$tamMb} MB";
    }
    
    // Verificar que el archivo no esté vacío
    if ($archivo['size'] === 0) {
        return 'El archivo está vacío.';
    }
    
    // Intentar leer el contenido para verificar que es texto
    $contenido = file_get_contents($archivo['tmp_name']);
    if ($contenido === false) {
        return 'No se pudo leer el contenido del archivo.';
    }
    
    // Verificar que no contenga caracteres binarios (null bytes)
    if (strpos($contenido, "\0") !== false) {
        return 'El archivo parece contener datos binarios. Solo se permiten archivos de texto.';
    }
    
    return true;
}

/**
 * Obtiene información básica de un archivo.
 * 
 * @param array $archivo Array $_FILES['archivo']
 * @return array Información del archivo
 */
function obtenerInfoArchivo(array $archivo): array {
    return [
        'nombre' => $archivo['name'],
        'tamanio' => $archivo['size'],
        'tamanio_legible' => formatearTamano($archivo['size']),
        'tipo' => $archivo['type'],
        'extension' => strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION))
    ];
}

/**
 * Formatea un tamaño en bytes a una cadena legible.
 * 
 * @param int $bytes Tamaño en bytes
 * @return string Tamaño formateado
 */
function formatearTamano(int $bytes): string {
    $unidades = ['B', 'KB', 'MB', 'GB'];
    $indice = 0;
    $tamano = $bytes;
    
    while ($tamano >= 1024 && $indice < count($unidades) - 1) {
        $tamano /= 1024;
        $indice++;
    }
    
    return round($tamano, 2) . ' ' . $unidades[$indice];
}

/**
 * Genera un nombre de archivo para el resultado.
 * 
 * @param string $nombreOriginal Nombre original del archivo
 * @param string $accion 'cifrar' o 'descifrar'
 * @return string Nombre del archivo resultado
 */
function generarNombreResultado(string $nombreOriginal, string $accion): string {
    $nombreBase = pathinfo($nombreOriginal, PATHINFO_FILENAME);
    $extension = pathinfo($nombreOriginal, PATHINFO_EXTENSION);
    
    $sufijo = $accion === 'cifrar' ? '_cifrado' : '_descifrado';
    
    return $nombreBase . $sufijo . '.' . $extension;
}
