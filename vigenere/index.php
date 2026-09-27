<?php
/**
 * Laboratorio de Ciberseguridad y Criptografía
 * Universidad Nacional del Altiplano – Puno
 * Módulo de Cifrado Vigenère
 * 
 * @package CryptoLab
 * @subpackage Vigenere
 * @version 2.0.0
 */

$page_title = 'Cifrado Vigenère - Laboratorio de Ciberseguridad';
$base_path = '..';
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/navbar.php';

$resultado = null;
$error = null;
$paso_a_paso = null;
$accion = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/vigenere.php';

    $texto = $_POST['texto'] ?? '';
    $clave = $_POST['clave'] ?? '';
    $accion = $_POST['accion'] ?? '';

    if (empty(trim($texto))) {
        $error = 'El campo de texto no puede estar vacío.';
    } elseif (empty(trim($clave))) {
        $error = 'El campo de clave no puede estar vacío.';
    } elseif (!preg_match('/^[a-zA-Z]+$/', $clave)) {
        $error = 'La clave solo debe contener letras (A-Z, a-z).';
    } else {
        if ($accion === 'cifrar') {
            $resultado = cifrarVigenere($texto, $clave);
            $paso_a_paso = generarPasosVigenere($texto, $clave, 'cifrar');
        } elseif ($accion === 'descifrar') {
            $resultado = descifrarVigenere($texto, $clave);
            $paso_a_paso = generarPasosVigenere($texto, $clave, 'descifrar');
        }
    }
}
?>

<section class="module-header">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../index.php" class="text-decoration-none">Inicio</a></li>
                <li class="breadcrumb-item active">Cifrado Vigenère</li>
            </ol>
        </nav>
        <div class="d-flex align-items-center mb-3">
            <div class="module-icon-sm bg-blue">
                <i class="bi bi-shield-lock-fill"></i>
            </div>
            <div>
                <h1 class="module-title mb-0">Cifrado Vigenère</h1>
                <p class="module-subtitle mb-0">Cifrado polialfabético mediante una clave de texto</p>
            </div>
        </div>
    </div>
</section>

<section class="container py-4">
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
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-navy text-white">
                    <i class="bi bi-pencil-square me-2"></i>
                    Entrada de datos
                </div>
                <div class="card-body">
                    <form method="POST" action="" id="formVigenere">
                        <div class="mb-3">
                            <label for="texto" class="form-label fw-bold">
                                <i class="bi bi-text-paragraph me-1"></i>
                                Mensaje
                            </label>
                            <textarea
                                class="form-control"
                                id="texto"
                                name="texto"
                                rows="5"
                                placeholder="Ingresa el mensaje a cifrar o descifrar..."
                                required
                            ><?= isset($texto) ? htmlspecialchars($texto) : '' ?></textarea>
                            <div class="form-text">Los espacios, números y símbolos se conservan sin modificar</div>
                        </div>

                        <div class="mb-3">
                            <label for="clave" class="form-label fw-bold">
                                <i class="bi bi-key me-1"></i>
                                Clave
                            </label>
                            <input
                                type="text"
                                class="form-control"
                                id="clave"
                                name="clave"
                                placeholder="Ejemplo: CLAVE"
                                pattern="[a-zA-Z]+"
                                value="<?= isset($clave) ? htmlspecialchars($clave) : '' ?>"
                                required
                            >
                            <div class="form-text">Solo letras (A-Z, a-z). Ejemplo: CLAVE, MIAB, SECRET</div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex">
                            <button type="submit" name="accion" value="cifrar" class="btn btn-cyan flex-fill">
                                <i class="bi bi-lock me-2"></i>Cifrar
                            </button>
                            <button type="submit" name="accion" value="descifrar" class="btn btn-green flex-fill">
                                <i class="bi bi-unlock me-2"></i>Descifrar
                            </button>
                            <button type="button" class="btn btn-outline-secondary" onclick="limpiarFormulario('formVigenere')">
                                <i class="bi bi-eraser me-2"></i>Limpiar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm mt-4">
                <div class="card-header bg-info text-white">
                    <i class="bi bi-calculator me-2"></i>
                    Fórmulas del Algoritmo
                </div>
                <div class="card-body">
                    <div class="formula-box mb-3">
                        <strong>Cifrado:</strong><br>
                        <span class="result">C</span> = (<span class="variable">P</span> + <span class="variable">K</span>) <span class="operator">mod</span> 26
                    </div>
                    <div class="formula-box">
                        <strong>Descifrado:</strong><br>
                        <span class="result">P</span> = (<span class="variable">C</span> - <span class="variable">K</span> + 26) <span class="operator">mod</span> 26
                    </div>
                    <div class="alert alert-info mt-3 mb-0">
                        <small>
                            <strong>P</strong> = Posición del texto (A=0, B=1, ..., Z=25)<br>
                            <strong>K</strong> = Valor de la clave (A=0, B=1, ..., Z=25)<br>
                            <strong>C</strong> = Carácter cifrado resultante
                        </small>
                    </div>
                </div>
            </div>
        </div>

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
                            <button class="btn btn-sm btn-outline-light" onclick="descargarTXT('resultado-texto', 'vigenere_resultado.txt')">
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
                            <div class="alert alert-secondary mb-3">
                                <strong>Clave utilizada:</strong>
                                <code class="fs-5"><?= htmlspecialchars(strtoupper($clave)) ?></code>
                                <br>
                                <small>La clave solo avanza cuando se procesa una letra</small>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered process-table">
                                    <thead>
                                        <tr>
                                            <th>Posición</th>
                                            <th>Texto</th>
                                            <th>Valor</th>
                                            <th>Clave</th>
                                            <th>Valor</th>
                                            <th>Resultado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($paso_a_paso as $paso): ?>
                                            <tr class="<?= $paso['es_letra'] ? '' : 'table-secondary' ?>">
                                                <td class="text-center"><?= $paso['posicion'] ?></td>
                                                <td class="text-center fw-bold"><?= htmlspecialchars($paso['texto']) ?></td>
                                                <td class="text-center"><?= $paso['es_letra'] ? $paso['valor_texto'] : '-' ?></td>
                                                <td class="text-center"><?= $paso['es_letra'] ? htmlspecialchars($paso['letra_clave']) : '-' ?></td>
                                                <td class="text-center"><?= $paso['es_letra'] ? $paso['valor_clave'] : '-' ?></td>
                                                <td class="text-center fw-bold text-success"><?= htmlspecialchars($paso['resultado']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="alert alert-info mt-3">
                                <h6><i class="bi bi-info-circle me-2"></i>Proceso paso a paso:</h6>
                                <ol class="mb-0">
                                    <li>Convertir la letra del mensaje a valor numérico (A=0, B=1, ..., Z=25).</li>
                                    <li>Convertir la letra de la clave a valor numérico.</li>
                                    <li>Aplicar la fórmula: <?= $accion === 'cifrar' ? '(P + K) mod 26' : '(C - K + 26) mod 26' ?>.</li>
                                    <li>Convertir el resultado numérico de nuevo a letra.</li>
                                    <li>Los caracteres que no son letras se mantienen sin cambios.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="card shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-arrow-left-circle text-muted" style="font-size: 4rem;"></i>
                        <h5 class="text-muted mt-3">Ingresa un texto y una clave</h5>
                        <p class="text-muted">El resultado aparecerá aquí junto con la visualización paso a paso.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
