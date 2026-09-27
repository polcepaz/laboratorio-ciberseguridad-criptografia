<?php
/**
 * Laboratorio de Ciberseguridad y Criptografía
 * Universidad Nacional del Altiplano – Puno
 * Doctorado en Ciencias de la Computación
 * Curso: Ciberseguridad
 * 
 * Página principal - Dashboard Cover de Bootstrap.
 * 
 * @package CryptoLab
 * @version 2.0.0
 */

$page_title = 'Laboratorio de Ciberseguridad - UNA Puno';
$base_path = dirname(__DIR__);
include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/navbar.php';

// Ruta base para assets
$base_url = '/web12/';
?>

<!-- COVER CONTAINER -->
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">

    <!-- HEADER -->
    <header class="masthead mb-auto">
        <div class="inner">
            <h3 class="masthead-brand">
                <img src="<?= $base_url ?>img/Logo_UNAP.png" alt="UNAP Logo" class="rounded me-2" style="height: 60px; width: auto;">
                <strong>Universidad Nacional del Altiplano – Puno</strong>
            </h3>
            <nav class="nav nav-masthead justify-content-center">
                <a class="nav-link active" href="<?= $base_url ?>index.php">Inicio</a>
                <a class="nav-link" href="<?= $base_url ?>cesar/index.php">Cifrado César</a>
                <a class="nav-link" href="<?= $base_url ?>archivos/index.php">Archivos TXT</a>
                <a class="nav-link" href="<?= $base_url ?>analizador/index.php">Analizador</a>
                <a class="nav-link" href="<?= $base_url ?>vigenere/index.php">Vigenère</a>
                <a class="nav-link" href="<?= $base_url ?>docs/documentacion.php">Documentación</a>
            </nav>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="inner">
        <!-- Título principal -->
        <div class="py-5 text-center">
            <h1 class="display-4 fw-bold text-navy">
                <i class="bi bi-shield-lock-fill text-cyan me-2"></i>
                LABORATORIO DE CIBERSEGURIDAD Y CRIPTOGRAFÍA
            </h1>
            <h3 class="lead text-muted mb-3">Criptografía y Criptoanálisis</h3>
            <p class="lead text-muted" style="max-width: 600px; margin: 0 auto;">
                Entorno académico para el estudio experimental de los fundamentos de la criptografía,
                técnicas de cifrado y descifrado, algoritmos criptográficos y métodos de criptoanálisis.
            </p>
        </div>

        <!-- Información académica -->
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-navy text-white">
                        <i class="bi bi-mortarboard me-2"></i>
                        Información Académica
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-book-fill text-cyan me-2"></i>
                                    <div>
                                        <strong>Programa:</strong> Doctorado en Ciencias de la Computación
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-journal-bookmark-fill text-cyan me-2"></i>
                                    <div>
                                        <strong>Curso:</strong> Ciberseguridad
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-person-video text-cyan me-2"></i>
                                    <div>
                                        <strong>Docente:</strong> IBARRA CABRERA MANUEL JESUS
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-person-badge text-cyan me-2"></i>
                                    <div>
                                        <strong>Estudiante:</strong> Cesar Paul Apaza Choquehuanca
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tarjetas de módulos -->
        <div class="row justify-content-center g-4 mb-5">
            <!-- Cifrado -->
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-start border-cyan border-3">
                    <div class="card-body text-center">
                        <div class="bg-cyan text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="bi bi-lock-fill fs-3"></i>
                        </div>
                        <h5 class="card-title fw-bold">Cifrado</h5>
                        <p class="card-text text-muted small">
                            Aplicación de algoritmos criptográficos para proteger información mediante técnicas de cifrado clásico.
                        </p>
                        <a href="<?= $base_url ?>cesar/index.php" class="btn btn-cyan">
                            <i class="bi bi-key me-2"></i>Ver Módulo
                        </a>
                    </div>
                </div>
            </div>

            <!-- Descifrado -->
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-start border-green border-3">
                    <div class="card-body text-center">
                        <div class="bg-green text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="bi bi-unlock-fill fs-3"></i>
                        </div>
                        <h5 class="card-title fw-bold">Descifrado</h5>
                        <p class="card-text text-muted small">
                            Recuperación de información mediante claves y algoritmos correspondientes de descifrado.
                        </p>
                        <a href="<?= $base_url ?>cesar/index.php" class="btn btn-green">
                            <i class="bi bi-unlock me-2"></i>Ver Módulo
                        </a>
                    </div>
                </div>
            </div>

            <!-- Criptoanálisis -->
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-start border-purple border-3">
                    <div class="card-body text-center">
                        <div class="bg-purple text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="bi bi-search-heart fs-3"></i>
                        </div>
                        <h5 class="card-title fw-bold">Criptoanálisis</h5>
                        <p class="card-text text-muted small">
                            Análisis de información cifrada y estudio de patrones para determinar posibles vulnerabilidades.
                        </p>
                        <a href="<?= $base_url ?>analizador/index.php" class="btn btn-purple">
                            <i class="bi bi-search me-2"></i>Analizar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Archivos -->
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-start border-orange border-3">
                    <div class="card-body text-center">
                        <div class="bg-orange text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="bi bi-file-earmark-text-fill fs-3"></i>
                        </div>
                        <h5 class="card-title fw-bold">Gestión de Archivos</h5>
                        <p class="card-text text-muted small">
                            Configuración y utilización de claves criptográficas aplicadas a archivos de texto.
                        </p>
                        <a href="<?= $base_url ?>archivos/index.php" class="btn btn-orange">
                            <i class="bi bi-file-earmark-text me-2"></i>Ver Módulo
                        </a>
                    </div>
                </div>
            </div>

            <!-- Algoritmos -->
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-start border-blue border-3">
                    <div class="card-body text-center">
                        <div class="bg-blue text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="bi bi-cpu fs-3"></i>
                        </div>
                        <h5 class="card-title fw-bold">Algoritmos</h5>
                        <p class="card-text text-muted small">
                            Experimentación con diferentes algoritmos de cifrado clásico y sus implementaciones.
                        </p>
                        <a href="<?= $base_url ?>cesar/index.php" class="btn btn-blue">
                            <i class="bi bi-cpu me-2"></i>Experimentar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Análisis de Seguridad -->
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-start border-red border-3">
                    <div class="card-body text-center">
                        <div class="bg-red text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="bi bi-shield-check fs-3"></i>
                        </div>
                        <h5 class="card-title fw-bold">Análisis de Seguridad</h5>
                        <p class="card-text text-muted small">
                            Visualización y análisis de resultados mediante gráficos, estadísticas e indicadores.
                        </p>
                        <a href="<?= $base_url ?>analizador/index.php" class="btn btn-red">
                            <i class="bi bi-graph-up me-2"></i>Analizar
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comparación -->
        <section id="comparacion" class="mb-5">
            <h2 class="h3 mb-3 fw-bold text-navy">
                <i class="bi bi-bar-chart me-2 text-cyan"></i>
                Comparación: César vs Vigenère
            </h2>
            <div class="card shadow-sm mb-4">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="ps-4">Característica</th>
                                <th class="text-center">César</th>
                                <th class="text-center">Vigenère</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td class="ps-4 fw-semibold">Tipo de cifrado</td><td class="text-center">Monoalfabético</td><td class="text-center">Polialfabético</td></tr>
                            <tr><td class="ps-4 fw-semibold">Tipo de clave</td><td class="text-center">Número</td><td class="text-center">Texto</td></tr>
                            <tr><td class="ps-4 fw-semibold">Cantidad de claves</td><td class="text-center"><span class="badge bg-info">95</span></td><td class="text-center"><span class="badge bg-info">26^n</span></td></tr>
                            <tr><td class="ps-4 fw-semibold">Complejidad</td><td class="text-center"><span class="badge bg-success">Baja</span></td><td class="text-center"><span class="badge bg-warning">Media</span></td></tr>
                            <tr><td class="ps-4 fw-semibold">Resistencia a fuerza bruta</td><td class="text-center"><span class="badge bg-danger">Muy Baja</span></td><td class="text-center"><span class="badge bg-warning">Media</span></td></tr>
                            <tr><td class="ps-4 fw-semibold">Resistencia a análisis de frecuencia</td><td class="text-center"><span class="badge bg-danger">Nula</span></td><td class="text-center"><span class="badge bg-warning">Parcial</span></td></tr>
                            <tr><td class="ps-4 fw-semibold">Uso educativo</td><td class="text-center"><i class="bi bi-check-circle-fill text-success"></i></td><td class="text-center"><i class="bi bi-check-circle-fill text-success"></i></td></tr>
                            <tr><td class="ps-4 fw-semibold">Uso en producción</td><td class="text-center"><i class="bi bi-x-circle-fill text-danger"></i></td><td class="text-center"><i class="bi bi-x-circle-fill text-danger"></i></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Advertencia de seguridad -->
        <div class="alert alert-warning mb-4">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>Nota Importantísima:</strong> Los algoritmos de cifrado clásico (César y Vigenère) tienen principalmente <strong>valor educativo</strong>. No deben utilizarse actualmente para proteger información sensible. Para seguridad real, utilice algoritmos modernos como AES, RSA o ChaCha20.
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="mastfoot mt-auto">
        <div class="inner">
            <p class="text-muted small text-center">
                <strong>Universidad Nacional del Altiplano – Puno</strong> |
                <strong>Doctorado en Ciencias de la Computación</strong> |
                <strong>Curso de Ciberseguridad</strong> |
                Docente: IBARRA CABRERA MANUEL JESUS |
                Estudiante: Cesar Paul Apaza Choquehuanca |
                &copy; <?= date('Y') ?>
            </p>
        </div>
    </footer>
</div>

<script>
// Bootstrap JS local ya se incluye en footer.php
</script>
<?php include __DIR__ . '/includes/footer.php'; ?>
