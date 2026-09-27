<?php
/**
 * Laboratorio de Ciberseguridad y Criptografía
 * Universidad Nacional del Altiplano – Puno
 * Doctorado en Ciencias de la Computación
 * 
 * Archivo de cabecera compartido.
 * Utiliza Bootstrap local y rutas de imagen correctas.
 * 
 * @package CryptoLab
 * @version 2.0.0
 */

// Ruta base del proyecto (ajustar según la carpeta en el servidor)
$base_url = '/web12/';
// Para la raíz del servidor: $base_url = '/';
// Para desarrollo local XAMPP en subcarpeta: $base_url = '/web12/';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Laboratorio educativo de criptografía clásica - Universidad Nacional del Altiplano - Puno">
    <meta name="author" content="Cesar Paul Apaza Choquehuanca - Doctorado en Ciencias de la Computación">
    <title><?= htmlspecialchars($page_title ?? 'Laboratorio de Ciberseguridad y Criptografía - UNA Puno') ?></title>

    <!-- Bootstrap 5.3 Local CSS -->
    <link href="<?= $base_url ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="<?= $base_url ?>assets/css/bootstrap-icons.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link href="<?= $base_url ?>assets/css/style.css" rel="stylesheet">
</head>
<body class="text-center bg-dark text-light">
