<?php
/**
 * Laboratorio de Ciberseguridad y Criptografía
 * Universidad Nacional del Altiplano – Puno
 * Doctorado en Ciencias de la Computación
 * 
 * Barra de navegación con estilo Cover de Bootstrap.
 * 
 * @package CryptoLab
 */

$current_page = basename($_SERVER['SCRIPT_NAME']);
$current_dir = basename(dirname($_SERVER['SCRIPT_NAME']));
?>

<!-- Navbar Cover -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="<?= $base_url ?>index.php">
            <img src="<?= $base_url ?>img/Logo_UNAP.png" alt="UNAP" class="d-inline-block align-text-top me-2" style="height: 40px; width: auto;">
            <strong>Lab Ciberseguridad</strong>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page === 'index.php' && $current_dir === 'web12') ? 'active' : '' ?>" href="<?= $base_url ?>index.php">Inicio</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= ($current_dir === 'cesar') ? 'active' : '' ?>" href="#" data-bs-toggle="dropdown">César</a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?= $base_url ?>cesar/index.php">Cifrado César</a></li>
                        <li><a class="dropdown-item" href="<?= $base_url ?>archivos/index.php">César + Archivos</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($current_dir === 'analizador') ? 'active' : '' ?>" href="<?= $base_url ?>analizador/index.php">Analizador</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($current_dir === 'vigenere') ? 'active' : '' ?>" href="<?= $base_url ?>vigenere/index.php">Vigenère</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $base_url ?>index.php#comparacion">Comparación</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $base_url ?>docs/documentacion.php">Documentación</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Banner del curso -->
<div class="course-banner py-3 bg-navy text-white">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h4 class="mb-0"><i class="bi bi-shield-lock me-2"></i>CIBERSEGURIDAD</h4>
                <small class="opacity-75">Doctorado en Ciencias de la Computación - UNA Puno</small>
            </div>
            <div class="text-end">
                <small><strong>Docente:</strong> IBARRA CABRERA MANUEL JESUS</small><br>
                <small><strong>Estudiante:</strong> Cesar Paul Apaza Choquehuanca</small>
            </div>
        </div>
    </div>
</div>
