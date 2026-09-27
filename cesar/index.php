<?php
/**
 * Laboratorio de Ciberseguridad y Criptografía
 * Universidad Nacional del Altiplano – Puno
 * Módulo de Cifrado César con ASCII imprimible
 * 
 * @package CryptoLab
 * @subpackage Cesar
 * @version 2.0.0
 */

$page_title = 'Cifrado César ASCII - Laboratorio de Ciberseguridad';
$base_path = '..';
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/navbar.php';

// Procesar formulario si se envió
$resultado = null;
$error = null;
$paso_a_paso = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/cesar.php';

    $texto = $_POST['texto'] ?? '';
    $desplazamiento = $_POST['desplazamiento'] ?? '';
    $accion = $_POST['accion'] ?? '';

    if (empty(trim($texto))) {
        $error = 'El campo de texto no puede estar vacío.';
    } elseif ($desplazamiento === '' || !ctype_digit($desplazamiento)) {
        $error = 'El desplazamiento debe ser un número entero positivo.';
    } else {
        $desplazamiento = (int) $desplazamiento;

        if ($desplazamiento < 0 || $desplazamiento > 94) {
            $error = 'El desplazamiento debe estar entre 0 y 94 (rango ASCII imprimible).';
        } else {
            if ($accion === 'cifrar') {
                $resultado = cifrarCesar($texto, $desplazamiento);
                $paso_a_paso = generarPasosCesar($texto, $desplazamiento, 'cifrar');
            } elseif ($accion === 'descifrar') {
                $resultado = descifrarCesar($texto, $desplazamiento);
                $paso_a_paso = generarPasosCesar($texto, $desplazamiento, 'descifrar');
            }
        }
    }
}
?>

<!-- Cabecera del módulo -->
<section class="module-header">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../index.php" class="text-decoration-none">Inicio</a></li>
                <li class="breadcrumb-item active">Cifrado César</li>
            </ol>
        </nav>
        <div class="d-flex align-items-center mb-3">
            <div class="module-icon-sm bg-cyan">
                <i class="bi bi-key-fill"></i>
            </div>
            <div>
                <h1 class="module-title mb-0">Cifrado César ASCII</h1>
                <p class="module-subtitle mb-0">Cifrado por desplazamiento utilizando caracteres ASCII imprimibles (32-126)</p>
            </div>
        </div>
    </div>
</section>

<!-- Contenido principal -->
<section class="container py-4">
    <!-- Alertas -->
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
        <!-- Formulario -->
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-navy text-white">
                    <i class="bi bi-pencil-square me-2"></i>
                    Entrada de datos
                </div>
                <div class="card-body">
                    <form method="POST" action="" id="formCesar">
                        <div class="mb-3">
                            <label for="texto" class="form-label fw-bold">
                                <i class="bi bi-text-paragraph me-1"></i>
                                Texto
                            </label>
                            <textarea
                                class="form-control"
                                id="texto"
                                name="texto"
                                rows="5"
                                placeholder="Ingresa el mensaje a cifrar o descifrar..."
                                required
                            ><?= isset($texto) ? htmlspecialchars($texto) : '' ?></textarea>
                            <div class="form-text">
                                Soporta mayúsculas, minúsculas, números, espacios y símbolos (ASCII 32-126)
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="desplazamiento" class="form-label fw-bold">
                                <i class="bi bi-arrow-left-right me-1"></i>
                                Desplazamiento
                            </label>
                            <input
                                type="number"
                                class="form-control"
                                id="desplazamiento"
                                name="desplazamiento"
                                min="0"
                                max="94"
                                value="<?= isset($desplazamiento) ? htmlspecialchars($desplazamiento) : '3' ?>"
                                required
                            >
                            <div class="form-text">
                                Valor entre 0 y 94 (rango de caracteres ASCII imprimibles)
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex">
                            <button type="submit" name="accion" value="cifrar" class="btn btn-cyan flex-fill">
                                <i class="bi bi-lock me-2"></i>Cifrar
                            </button>
                            <button type="submit" name="accion" value="descifrar" class="btn btn-green flex-fill">
                                <i class="bi bi-unlock me-2"></i>Descifrar
                            </button>
                            <button type="button" class="btn btn-outline-secondary" onclick="limpiarFormulario('formCesar')">
                                <i class="bi bi-eraser me-2"></i>Limpiar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Fórmulas -->
            <div class="card shadow-sm mt-4">
                <div class="card-header bg-info text-white">
                    <i class="bi bi-calculator me-2"></i>
                    Fórmulas del Algoritmo
                </div>
                <div class="card-body">
                    <div class="formula-box mb-3">
                        <strong>Cifrado:</strong><br>
                        <span class="variable">pos</span> = <span class="variable">ASCII</span>(<span class="variable">caracter</span>) - 32<br>
                        <span class="result">nuevoAscii</span> = ((<span class="variable">pos</span> + <span class="variable">desplazamiento</span>) <span class="operator">mod</span> 95) + 32
                    </div>
                    <div class="formula-box">
                        <strong>Descifrado:</strong><br>
                        <span class="variable">pos</span> = <span class="variable">ASCII</span>(<span class="variable">caracter</span>) - 32<br>
                        <span class="result">nuevoAscii</span> = ((<span class="variable">pos</span> - <span class="variable">desplazamiento</span> + 95) <span class="operator">mod</span> 95) + 32
                    </div>
                </div>
            </div>
        </div>

        <!-- Resultado -->
        <div class="col-lg-6">
            <?php if ($resultado !== null): ?>
                <div class="card shadow-sm">
                    <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center">
                        <span>
                            <i class="bi bi-check-circle me-2"></i>
                            Mensaje resultante
                        </span>
                        <div>
                            <button class="btn btn-sm btn-outline-light" onclick="copiarResultado('resultado-texto')">
                                <i class="bi bi-clipboard me-1"></i>Copiar
                            </button>
                            <button class="btn btn-sm btn-outline-light" onclick="descargarTXT('resultado-texto', 'cesar_resultado.txt')">
                                <i class="bi bi-download me-1"></i>TXT
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="result-card">
                            <div id="resultado-texto" class="result-text">
                                <?= htmlspecialchars($resultado) ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if ($paso_a_paso && !empty($paso_a_paso)): ?>
                    <div class="card shadow-sm mt-4">
                        <div class="card-header bg-info text-white">
                            <i class="bi bi-list-ol me-2"></i>
                            ¿Cómo funciona el <?= $accion === 'cifrar' ? 'cifrado' : 'descifrado' ?>?
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered process-table">
                                    <thead>
                                        <tr>
                                            <th>Original</th>
                                            <th>ASCII</th>
                                            <th>Posición</th>
                                            <th><?= $accion === 'cifrar' ? 'Desplazamiento' : 'Resta' ?></th>
                                            <th>Nuevo ASCII</th>
                                            <th>Resultado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($paso_a_paso as $paso): ?>
                                            <tr>
                                                <td class="text-center fw-bold"><?= htmlspecialchars($paso['original']) ?></td>
                                                <td class="text-center"><?= $paso['ascii'] ?></td>
                                                <td class="text-center"><?= $paso['posicion'] ?></td>
                                                <td class="text-center"><?= $accion === 'cifrar' ? '+' . $desplazamiento : '-' . $desplazamiento ?></td>
                                                <td class="text-center"><?= $paso['nuevo_ascii'] ?></td>
                                                <td class="text-center fw-bold text-success"><?= htmlspecialchars($paso['resultado']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="alert alert-info mt-3">
                                <h6><i class="bi bi-info-circle me-2"></i>Proceso paso a paso:</h6>
                                <ol class="mb-0">
                                    <li>Obtener el código ASCII del carácter original.</li>
                                    <li>Restar 32 para obtener la posición en el alfabeto (0-94).</li>
                                    <li>Aplicar el <?= $accion === 'cifrar' ? 'desplazamiento (suma)' : 'desplazamiento (resta)' ?>.</li>
                                    <li>Aplicar módulo 95 para mantenerse en el rango.</li>
                                    <li>Sumar 32 para obtener el nuevo código ASCII.</li>
                                    <li>Convertir el código ASCII a carácter.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="card shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-arrow-left-circle text-muted" style="font-size: 4rem;"></i>
                        <h5 class="text-muted mt-3">Ingresa un texto y selecciona una acción</h5>
                        <p class="text-muted">El resultado aparecerá aquí junto con la visualización paso a paso.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
