<?php
/**
 * Laboratorio de Ciberseguridad y Criptografía
 * Universidad Nacional del Altiplano – Puno
 * Doctorado en Ciencias de la Computación
 * 
 * Pie de página institucional.
 * 
 * @package CryptoLab
 */
?>

<!-- Footer -->
<footer class="footer mt-auto py-3 bg-dark text-white">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3 mb-md-0">
                <h5 class="text-cyan">
                    <i class="bi bi-building me-2"></i>
                    Universidad Nacional del Altiplano – Puno
                </h5>
                <p class="small text-muted">Doctorado en Ciencias de la Computación</p>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <h5 class="text-cyan">
                    <i class="bi bi-book me-2"></i>
                    Curso de Ciberseguridad
                </h5>
                <p class="small text-muted">Laboratorio de Ciberseguridad y Criptografía</p>
            </div>
            <div class="col-md-4">
                <h5 class="text-cyan">
                    <i class="bi bi-people me-2"></i>
                    Personal Académico
                </h5>
                <p class="small text-muted">
                    Docente: IBARRA CABRERA MANUEL JESUS<br>
                    Estudiante: Cesar Paul Apaza Choquehuanca
                </p>
            </div>
        </div>
        <hr class="my-3 bg-secondary">
        <div class="row">
            <div class="col-md-6 text-center text-md-start">
                <p class="small text-muted mb-0">
                    &copy; <?= date('Y') ?> Universidad Nacional del Altiplano – Puno
                </p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <p class="small text-muted mb-0">
                    <i class="bi bi-shield-lock me-1"></i>
                    Actividad académica – Curso de Ciberseguridad
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap 5 JS Bundle Local -->
<script src="<?= $base_url ?>assets/js/bootstrap.bundle.min.js"></script>
<!-- JavaScript personalizado -->
<script src="<?= $base_url ?>assets/js/app.js"></script>
</body>
</html>
