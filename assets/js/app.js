/**
 * Cybersecurity Cryptography Lab
 * 
 * Archivo JavaScript principal.
 * Contiene funciones comunes y utilidades para la aplicación.
 * 
 * @package CryptoLab
 */

/**
 * Copiar texto al portapapeles
 * @param {string} elementId - ID del elemento que contiene el texto
 */
function copiarResultado(elementId) {
    const elemento = document.getElementById(elementId);
    if (!elemento) {
        mostrarAlerta('Elemento no encontrado', 'danger');
        return;
    }
    
    const texto = elemento.textContent || elemento.innerText;
    
    if (!texto.trim()) {
        mostrarAlerta('No hay texto para copiar', 'warning');
        return;
    }
    
    navigator.clipboard.writeText(texto).then(() => {
        mostrarAlerta('Texto copiado al portapapeles', 'success');
    }).catch(err => {
        // Fallback para navegadores antiguos
        const textarea = document.createElement('textarea');
        textarea.value = texto;
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand('copy');
        document.body.removeChild(textarea);
        mostrarAlerta('Texto copiado al portapapeles', 'success');
    });
}

/**
 * Descargar texto como archivo TXT
 * @param {string} elementId - ID del elemento que contiene el texto
 * @param {string} nombreArchivo - Nombre del archivo a descargar
 */
function descargarTXT(elementId, nombreArchivo = 'resultado.txt') {
    const elemento = document.getElementById(elementId);
    if (!elemento) {
        mostrarAlerta('Elemento no encontrado', 'danger');
        return;
    }
    
    const texto = elemento.textContent || elemento.innerText;
    
    if (!texto.trim()) {
        mostrarAlerta('No hay texto para descargar', 'warning');
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

/**
 * Mostrar alerta Bootstrap
 * @param {string} mensaje - Mensaje a mostrar
 * @param {string} tipo - Tipo de alerta (success, danger, warning, info)
 * @param {string} containerId - ID del contenedor donde mostrar la alerta
 */
function mostrarAlerta(mensaje, tipo = 'info', containerId = 'alertas') {
    const container = document.getElementById(containerId);
    if (!container) return;
    
    const iconMap = {
        'success': 'bi-check-circle-fill',
        'danger': 'bi-exclamation-triangle-fill',
        'warning': 'bi-exclamation-circle-fill',
        'info': 'bi-info-circle-fill'
    };
    
    const alerta = document.createElement('div');
    alerta.className = `alert alert-${tipo} alert-dismissible fade show`;
    alerta.innerHTML = `
        <i class="bi ${iconMap[tipo] || 'bi-info-circle-fill'} me-2"></i>
        ${escapeHtml(mensaje)}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    container.appendChild(alerta);
    
    // Auto-cerrar después de 5 segundos
    setTimeout(() => {
        if (alerta.parentNode) {
            alerta.remove();
        }
    }, 5000);
}

/**
 * Escape HTML para prevenir XSS
 * @param {string} text - Texto a escapar
 * @returns {string} Texto escapado
 */
function escapeHtml(text) {
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, m => map[m]);
}

/**
 * Limpiar formulario
 * @param {string} formId - ID del formulario a limpiar
 */
function limpiarFormulario(formId) {
    const formulario = document.getElementById(formId);
    if (!formulario) return;
    
    formulario.reset();
    
    // Limpiar resultados
    const resultados = formulario.querySelectorAll('.result-card, .process-table, .learning-mode');
    resultados.forEach(el => {
        el.innerHTML = '';
        el.style.display = 'none';
    });
    
    // Limpiar alertas
    const alertas = document.getElementById('alertas');
    if (alertas) alertas.innerHTML = '';
}

/**
 * Validar que un campo no esté vacío
 * @param {string} valor - Valor a validar
 * @returns {boolean} True si es válido
 */
function validarNoVacio(valor) {
    return valor && valor.trim().length > 0;
}

/**
 * Validar que un número esté en un rango
 * @param {number} valor - Valor a validar
 * @param {number} min - Valor mínimo
 * @param {number} max - Valor máximo
 * @returns {boolean} True si es válido
 */
function validarRango(valor, min, max) {
    const num = parseInt(valor);
    return !isNaN(num) && num >= min && num <= max;
}

/**
 * Validar extensión de archivo
 * @param {string} nombreArchivo - Nombre del archivo
 * @param {string[]} extensionesPermitidas - Extensiones permitidas
 * @returns {boolean} True si es válido
 */
function validarExtension(nombreArchivo, extensionesPermitidas = ['.txt']) {
    const extension = nombreArchivo.toLowerCase().substring(nombreArchivo.lastIndexOf('.'));
    return extensionesPermitidas.includes(extension);
}

/**
 * Crear tabla de proceso dinámica
 * @param {string} containerId - ID del contenedor
 * @param {string[]} headers - Encabezados de la tabla
 * @param {Array<Array>} rows - Filas de datos
 */
function crearTablaProceso(containerId, headers, rows) {
    const container = document.getElementById(containerId);
    if (!container) return;
    
    let html = '<div class="table-responsive"><table class="table table-bordered process-table">';
    
    // Encabezados
    html += '<thead><tr>';
    headers.forEach(header => {
        html += `<th>${escapeHtml(header)}</th>`;
    });
    html += '</tr></thead>';
    
    // Filas
    html += '<tbody>';
    rows.forEach(row => {
        html += '<tr>';
        row.forEach(cell => {
            html += `<td>${escapeHtml(String(cell))}</td>`;
        });
        html += '</tr>';
    });
    html += '</tbody></table></div>';
    
    container.innerHTML = html;
}

/**
 * Crear gráfico de barras simple con Canvas
 * @param {string} canvasId - ID del canvas
 * @param {Object} data - Datos {caracter: frecuencia}
 * @param {string} title - Título del gráfico
 */
function crearGraficoFrecuencia(canvasId, data, title = 'Frecuencia de Caracteres') {
    const canvas = document.getElementById(canvasId);
    if (!canvas) return;
    
    const ctx = canvas.getContext('2d');
    const width = canvas.width;
    const height = canvas.height;
    
    // Limpiar canvas
    ctx.clearRect(0, 0, width, height);
    
    // Obtener datos ordenados
    const entries = Object.entries(data).sort((a, b) => b[1] - a[1]).slice(0, 20);
    if (entries.length === 0) return;
    
    const maxFreq = Math.max(...entries.map(e => e[1]));
    const barWidth = (width - 60) / entries.length;
    const chartHeight = height - 80;
    
    // Dibujar fondo
    ctx.fillStyle = '#f8f9fa';
    ctx.fillRect(0, 0, width, height);
    
    // Dibujar título
    ctx.fillStyle = '#212529';
    ctx.font = 'bold 14px Arial';
    ctx.textAlign = 'center';
    ctx.fillText(title, width / 2, 20);
    
    // Dibujar barras
    entries.forEach(([char, freq], i) => {
        const barHeight = (freq / maxFreq) * chartHeight;
        const x = 50 + i * barWidth;
        const y = height - 50 - barHeight;
        
        // Barra con gradiente
        const gradient = ctx.createLinearGradient(x, y, x, height - 50);
        gradient.addColorStop(0, '#0dcaf0');
        gradient.addColorStop(1, '#0d6efd');
        ctx.fillStyle = gradient;
        ctx.fillRect(x, y, barWidth - 4, barHeight);
        
        // Etiqueta del carácter
        ctx.fillStyle = '#495057';
        ctx.font = '11px Courier New';
        ctx.textAlign = 'center';
        ctx.fillText(char === ' ' ? 'ESP' : char, x + barWidth / 2 - 2, height - 35);
        
        // Valor de frecuencia
        ctx.fillStyle = '#212529';
        ctx.font = '10px Arial';
        ctx.fillText(freq, x + barWidth / 2 - 2, y - 5);
    });
    
    // Dibujar ejes
    ctx.strokeStyle = '#dee2e6';
    ctx.lineWidth = 1;
    ctx.beginPath();
    ctx.moveTo(45, 30);
    ctx.lineTo(45, height - 50);
    ctx.lineTo(width - 10, height - 50);
    ctx.stroke();
}

/**
 * Alternar modo aprendizaje
 * @param {string} learningId - ID del contenedor de aprendizaje
 * @param {string} btnId - ID del botón
 */
function toggleModoAprendizaje(learningId, btnId) {
    const container = document.getElementById(learningId);
    const btn = document.getElementById(btnId);
    
    if (!container || !btn) return;
    
    const isVisible = container.style.display !== 'none';
    container.style.display = isVisible ? 'none' : 'block';
    btn.innerHTML = isVisible 
        ? '<i class="bi bi-mortarboard me-2"></i>Modo Aprendizaje'
        : '<i class="bi bi-mortarboard-fill me-2"></i>Cerrar Modo Aprendizaje';
}

/**
 * Desplazamiento suave a una sección
 * @param {string} sectionId - ID de la sección
 */
function scrollToSection(sectionId) {
    const section = document.getElementById(sectionId);
    if (section) {
        section.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
}

// Inicialización cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    // Tooltips de Bootstrap
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Popovers de Bootstrap
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(function(popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
    
    console.log('🔐 Cybersecurity Cryptography Lab - Initialized');
});
