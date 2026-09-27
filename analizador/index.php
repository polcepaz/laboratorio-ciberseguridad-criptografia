<?php
/**
 * Laboratorio de Ciberseguridad y Criptografía
 * Universidad Nacional del Altiplano – Puno
 * Módulo de Criptoanálisis
 * 
 * @package CryptoLab
 * @subpackage Analizador
 * @version 2.0.0
 */

$page_title = 'Analizador de Mensajes Cifrados - Laboratorio de Ciberseguridad';
$base_path = '..';
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/navbar.php';

$resultado_fuerza_bruta = null;
$resultado_frecuencia = null;
$error = null;
$texto_original = null;
$tipo_analisis = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../cesar/cesar.php';
    require_once __DIR__ . '/analizador.php';

    $texto = $_POST['texto'] ?? '';
    $tipo_analisis = $_POST['tipo_analisis'] ?? '';

    if (empty(trim($texto))) {
        $error = 'El campo de texto no puede estar vacío.';
    } else {
        $texto_original = $texto;

        if ($tipo_analisis === 'fuerza_bruta') {
            $resultado_fuerza_bruta = fuerzaBrutaCesar($texto);
        } elseif ($tipo_analisis === 'frecuencia') {
            $resultado_frecuencia = analizarFrecuencia($texto);
        }
    }
}
?>

<section class="module-header">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../index.php" class="text-decoration-none">Inicio</a></li>
                <li class="breadcrumb-item active">Analizador</li>
            </ol>
        </nav>
        <div class="d-flex align-items-center mb-3">
            <div class="module-icon-sm bg-purple">
                <i class="bi bi-search-heart"></i>
            </div>
            <div>
                <h1 class="module-title mb-0">Analizador de Mensajes Cifrados</h1>
                <p class="module-subtitle mb-0">Herramientas de criptoanálisis para algoritmos de cifrado clásico</p>
            </div>
        </div>
    </div>
</section>

<section class="container py-4">
    <div class="alert alert-warning">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <strong>Nota Importante:</strong> No existe un método universal para descifrar cualquier algoritmo
        criptográfico sin conocer su estructura, clave o vulnerabilidad. Este módulo analiza algoritmos
        clásicos soportados por la aplicación.
    </div>

    <div id="alertas">
        <?php if ($error): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <?= htmlspecialchars($error) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-navy text-white">
                    <i class="bi bi-pencil-square me-2"></i>
                    Entrada de datos
                </div>
                <div class="card-body">
                    <form method="POST" action="" id="formAnalizador">
                        <div class="mb-3">
                            <label for="texto" class="form-label fw-bold">
                                <i class="bi bi-text-paragraph me-1"></i>
                                Mensaje cifrado
                            </label>
                            <textarea
                                class="form-control"
                                id="texto"
                                name="texto"
                                rows="5"
                                placeholder="Ingresa el mensaje cifrado a analizar..."
                                required
                            ><?= isset($texto_original) ? htmlspecialchars($texto_original) : '' ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                <i class="bi bi-gear me-1"></i>
                                Tipo de análisis
                            </label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo_analisis"
                                       id="fuerza_bruta" value="fuerza_bruta"
                                       <?= ($tipo_analisis === 'fuerza_bruta' || !$tipo_analisis) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="fuerza_bruta">
                                    <i class="bi bi-key me-1"></i>
                                    Fuerza bruta César
                                </label>
                                <div class="form-text">Prueba todos los desplazamientos posibles</div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo_analisis"
                                       id="frecuencia" value="frecuencia"
                                       <?= ($tipo_analisis === 'frecuencia') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="frecuencia">
                                    <i class="bi bi-bar-chart me-1"></i>
                                    Análisis de frecuencia
                                </label>
                                <div class="form-text">Analiza la distribución de caracteres</div>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-purple">
                                <i class="bi bi-search me-2"></i>Analizar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm mt-4">
                <div class="card-header bg-info text-white">
                    <i class="bi bi-info-circle me-2"></i>
                    Métodos de análisis
                </div>
                <div class="card-body">
                    <h6>Fuerza Bruta:</h6>
                    <p class="small text-muted">
                        Prueba automáticamente todos los desplazamientos posibles (0-94)
                        y muestra los resultados con una puntuación de legibilidad.
                    </p>

                    <h6>Análisis de Frecuencia:</h6>
                    <p class="small text-muted">
                        Estudia la distribución de los caracteres del texto. Los textos en español
                        tienen patrones de frecuencia conocidos que pueden ayudar a identificar
                        cifrados monoalfabéticos.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <?php if ($resultado_fuerza_bruta): ?>
                <div class="card shadow-sm">
                    <div class="card-header bg-navy text-white">
                        <i class="bi bi-key me-2"></i>
                        Resultados de fuerza bruta
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-3">
                            Se probaron <?= count($resultado_fuerza_bruta) ?> desplazamientos.
                            Los resultados con mayor puntuación aparecen primero.
                        </p>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover process-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Desplazamiento</th>
                                        <th>Resultado</th>
                                        <th class="text-center">Puntuación</th>
                                        <th class="text-center">Posible</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($resultado_fuerza_bruta as $intento): ?>
                                        <tr class="<?= $intento['es_posible'] ? 'table-success' : '' ?>">
                                            <td class="text-center fw-bold"><?= $intento['desplazamiento'] ?></td>
                                            <td class="result-text" style="font-family: 'Courier New', monospace;">
                                                <?= htmlspecialchars($intento['texto']) ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="progress" style="height: 20px;">
                                                    <div class="progress-bar <?= $intento['puntuacion'] > 70 ? 'bg-success' : ($intento['puntuacion'] > 40 ? 'bg-warning' : 'bg-secondary') ?>"
                                                         style="width: <?= $intento['puntuacion'] ?>%">
                                                        <?= $intento['puntuacion'] ?>%
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($intento['es_posible']): ?>
                                                    <span class="badge bg-success">
                                                        <i class="bi bi-check-circle me-1"></i>Posible
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary">No</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="alert alert-info mt-3">
                            <h6><i class="bi bi-info-circle me-2"></i>¿Cómo funciona la puntuación?</h6>
                            <p class="mb-1 small">La puntuación evalúa si el texto tiene características de un idioma natural:</p>
                            <ul class="small mb-0">
                                <li>Presencia de vocales (a, e, i, o, u) en proporciones adecuadas</li>
                                <li>Consonantes comunes (n, s, r, t, l)</li>
                                <li>Espaciado típico de texto legible</li>
                                <li>Ausencia de caracteres poco frecuentes</li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php elseif ($resultado_frecuencia): ?>
                <div class="card shadow-sm">
                    <div class="card-header bg-navy text-white">
                        <i class="bi bi-bar-chart me-2"></i>
                        Análisis de frecuencia
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="card bg-info text-white">
                                    <div class="card-body text-center">
                                        <h3><?= $resultado_frecuencia['total_caracteres'] ?></h3>
                                        <p class="mb-0">Caracteres totales</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-success text-white">
                                    <div class="card-body text-center">
                                        <h3><?= $resultado_frecuencia['caracteres_unicos'] ?></h3>
                                        <p class="mb-0">Caracteres únicos</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-warning text-dark">
                                    <div class="card-body text-center">
                                        <h3><?= htmlspecialchars($resultado_frecuencia['mas_frecuente']) ?></h3>
                                        <p class="mb-0">Más frecuente</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5><i class="bi bi-table me-2"></i>Tabla de frecuencia</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover process-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Carácter</th>
                                        <th class="text-center">ASCII</th>
                                        <th class="text-center">Frecuencia</th>
                                        <th class="text-center">Porcentaje</th>
                                        <th>Gráfico</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($resultado_frecuencia['frecuencias'] as $dato): ?>
                                        <tr>
                                            <td class="text-center fw-bold">
                                                <?= $dato['caracter'] === ' ' ? 'ESP' : htmlspecialchars($dato['caracter']) ?>
                                            </td>
                                            <td class="text-center"><?= $dato['ascii'] ?></td>
                                            <td class="text-center"><?= $dato['frecuencia'] ?></td>
                                            <td class="text-center"><?= number_format($dato['porcentaje'], 2) ?>%</td>
                                            <td>
                                                <div class="progress" style="height: 15px;">
                                                    <div class="progress-bar bg-info"
                                                         style="width: <?= number_format($dato['porcentaje'] * 5, 1) ?>%">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <h5 class="mt-4"><i class="bi bi-graph-up me-2"></i>Gráfico de frecuencia</h5>
                        <div class="chart-container">
                            <canvas id="graficoFrecuencia" width="600" height="300"></canvas>
                        </div>

                        <div class="alert alert-info mt-3">
                            <h6><i class="bi bi-info-circle me-2"></i>Análisis de frecuencia</h6>
                            <p class="mb-0 small">
                                El análisis de frecuencia estudia la distribución de los caracteres de un texto.
                                En español, las letras más frecuentes suelen ser: E, A, O, S, R, N, I, L.
                                Esta técnica es fundamental en criptoanálisis para romper cifrados monoalfabéticos.
                            </p>
                        </div>
                    </div>
                </div>

                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const datos = <?= json_encode($resultado_frecuencia['frecuencias']) ?>;
                    const dataMap = {};
                    datos.forEach(d => {
                        dataMap[d.caracter] = d.frecuencia;
                    });
                    crearGraficoFrecuencia('graficoFrecuencia', dataMap, 'Frecuencia de Caracteres');
                });
                </script>
            <?php else: ?>
                <div class="card shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-search text-muted" style="font-size: 4rem;"></i>
                        <h5 class="text-muted mt-3">Ingresa un mensaje y selecciona un análisis</h5>
                        <p class="text-muted">Los resultados aparecerán aquí con tablas y gráficos detallados.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
