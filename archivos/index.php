<?php
/**
 * Laboratorio de Ciberseguridad y Criptografía
 * Universidad Nacional del Altiplano – Puno
 * Módulo de César con Archivos TXT
 * 
 * @package CryptoLab
 * @subpackage Archivos
 * @version 2.0.0
 */

$page_title = 'César con Archivos - Laboratorio de Ciberseguridad';
$base_path = '..';
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/navbar.php';

$resultado = null;
$error = null;
$contenido_original = null;
$nombre_archivo = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../cesar/cesar.php';
    require_once __DIR__ . '/procesar.php';

    $desplazamiento = $_POST['desplazamiento'] ?? '';
    $accion = $_POST['accion'] ?? '';

    if ($desplazamiento === '' || !ctype_digit($desplazamiento)) {
        $error = 'El desplazamiento debe ser un número entero positivo.';
    } else {
        $desplazamiento = (int) $desplazamiento;

        if ($desplazamiento < 0 || $desplazamiento > 94) {
            $error = 'El desplazamiento debe estar entre 0 y 94.';
        } elseif (!isset($_FILES['archivo']) || $_FILES['archivo']['error'] !== UPLOAD_ERR_OK) {
            $error = 'Error al subir el archivo. Verifica que sea un archivo .txt válido.';
        } else {
            $archivo = $_FILES['archivo'];

            $validacion = validarArchivo($archivo);
            if ($validacion !== true) {
                $error = $validacion;
            } else {
                $contenido = file_get_contents($archivo['tmp_name']);

                if ($contenido === false) {
                    $error = 'Error al leer el archivo.';
                } else {
                    $contenido_original = $contenido;
                    $nombre_archivo = $archivo['name'];

                    if ($accion === 'cifrar') {
                        $resultado = cifrarCesar($contenido, $desplazamiento);
                    } elseif ($accion === 'descifrar') {
                        $resultado = descifrarCesar($contenido, $desplazamiento);
                    }
                }
            }
        }
    }
}
?>

<section class="module-header">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../index.php" class="text-decoration-none">Inicio</a></li>
                <li class="breadcrumb-item active">César + Archivos</li>
            </ol>
        </nav>
        <div class="d-flex align-items-center mb-3">
            <div class="module-icon-sm bg-orange">
                <i class="bi bi-file-earmark-text-fill"></i>
            </div>
            <div>
                <h1 class="module-title mb-0">Cifrado de Archivos de Texto</h1>
                <p class="module-subtitle mb-0">Cifra y descifra archivos .txt utilizando el algoritmo César</p>
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
                    <i class="bi bi-upload me-2"></i>
                    Subir archivo
                </div>
                <div class="card-body">
                    <form method="POST" action="" enctype="multipart/form-data" id="formArchivos">
                        <div class="mb-3">
                            <label for="archivo" class="form-label fw-bold">
                                <i class="bi bi-file-earmark me-1"></i>
                                Archivo de texto (.txt)
                            </label>
                            <input
                                type="file"
                                class="form-control"
                                id="archivo"
                                name="archivo"
                                accept=".txt"
                                required
                            >
                            <div class="form-text">Solo archivos .txt con tamaño máximo de 100 KB</div>
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
                                value="3"
                                required
                            >
                        </div>

                        <div class="d-grid gap-2 d-md-flex">
                            <button type="submit" name="accion" value="cifrar" class="btn btn-cyan flex-fill">
                                <i class="bi bi-lock me-2"></i>Cifrar archivo
                            </button>
                            <button type="submit" name="accion" value="descifrar" class="btn btn-green flex-fill">
                                <i class="bi bi-unlock me-2"></i>Descifrar archivo
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm mt-4">
                <div class="card-header bg-info text-white">
                    <i class="bi bi-info-circle me-2"></i>
                    Información
                </div>
                <div class="card-body">
                    <h6>Formatos soportados:</h6>
                    <ul>
                        <li><strong>Extensión:</strong> .txt únicamente</li>
                        <li><strong>Tamaño máximo:</strong> 100 KB</li>
                        <li><strong>Charset:</strong> UTF-8 o ASCII</li>
                    </ul>

                    <h6 class="mt-3">Proceso:</h6>
                    <ol>
                        <li>Selecciona un archivo .txt</li>
                        <li>Ingresa el desplazamiento (0-94)</li>
                        <li>Selecciona cifrar o descifrar</li>
                        <li>Vista el resultado y descárgalo</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <?php if ($resultado !== null): ?>
                <?php if ($nombre_archivo): ?>
                    <div class="alert alert-info">
                        <i class="bi bi-file-earmark me-2"></i>
                        <strong>Archivo procesado:</strong> <?= htmlspecialchars($nombre_archivo) ?>
                    </div>
                <?php endif; ?>

                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-secondary text-white">
                        <i class="bi bi-file-text me-2"></i>
                        Contenido original
                    </div>
                    <div class="card-body">
                        <div class="ascii-display" style="max-height: 200px; overflow-y: auto;">
                            <?= htmlspecialchars($contenido_original) ?>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center">
                        <span>
                            <i class="bi bi-check-circle me-2"></i>
                            <?= $accion === 'cifrar' ? 'Contenido cifrado' : 'Contenido descifrado' ?>
                        </span>
                        <div>
                            <button class="btn btn-sm btn-outline-light" onclick="copiarResultado('resultado-archivo')">
                                <i class="bi bi-clipboard me-1"></i>Copiar
                            </button>
                            <button class="btn btn-sm btn-outline-light" onclick="descargarDesdeContenido('resultado-archivo', '<?= $accion === 'cifrar' ? 'cifrado' : 'descifrado' ?>_<?= htmlspecialchars($nombre_archivo ?? 'archivo') ?>')">
                                <i class="bi bi-download me-1"></i>Descargar
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="result-card">
                            <div id="resultado-archivo" class="result-text" style="max-height: 300px; overflow-y: auto;">
                                <?= htmlspecialchars($resultado) ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="card shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-cloud-upload text-muted" style="font-size: 4rem;"></i>
                        <h5 class="text-muted mt-3">Sube un archivo .txt para comenzar</h5>
                        <p class="text-muted">El contenido se mostrará aquí junto con el resultado.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
function descargarDesdeContenido(elementId, nombreArchivo) {
    const elemento = document.getElementById(elementId);
    if (!elemento) {
        mostrarAlerta('Elemento no encontrado', 'danger');
        return;
    }

    const texto = elemento.textContent || elemento.innerText;

    if (!texto.trim()) {
        mostrarAlerta('No hay contenido para descargar', 'warning');
        return;
    }

    const blob = new Blob([texto], { type: 'text/plain;charset=utf-8' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = nombreArchivo;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);

    mostrarAlerta('Archivo descargado correctamente', 'success');
}
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
