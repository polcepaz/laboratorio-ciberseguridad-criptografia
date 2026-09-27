# 🔐 Cybersecurity Cryptography Lab

## Laboratorio educativo de criptografía clásica

### Descripción

**Cybersecurity Cryptography Lab** es una aplicación web educativa e interactiva diseñada para enseñar los fundamentos de la criptografía clásica. Permite a los estudiantes comprender visualmente cómo funcionan los algoritmos de cifrado César y Vigenère, incluyendo cifrado, descifrado, análisis de frecuencia y fuerza bruta.

---

## 📋 Objetivos

- Enseñar los principios de la criptografía clásica de manera visual e interactiva.
- Permitir a los estudiantes comprender el proceso de cifrado y descifrado paso a paso.
- Demostrar las vulnerabilidades de los algoritmos clásicos.
- Proporcionar herramientas de criptoanálisis para análisis educativo.

---

## 🛠️ Tecnologías

- **PHP 8.x** - Lógica del servidor
- **HTML5** - Estructura
- **CSS3** - Estilos
- **Bootstrap 5** - Framework CSS responsive
- **JavaScript Vanilla** - Interactividad del cliente
- **Bootstrap Icons** - Iconografía

---

## 📦 Requisitos

- **Servidor web**: XAMPP, WAMP, MAMP o Apache con PHP
- **PHP**: Versión 8.0 o superior
- **Navegador web**: Chrome, Firefox, Safari o Edge (versiones recientes)
- **Sin bases de datos**: La aplicación no utiliza almacenamiento persistente

---

## 🚀 Instalación

### Opción 1: XAMPP (Recomendado)

1. **Descargar XAMPP** desde https://www.apachefriends.org/

2. **Iniciar servicios**:
   - Abrir XAMPP Control Panel
   - Iniciar Apache (botón "Start")

3. **Copiar el proyecto**:
   - Copiar la carpeta `crypto-lab` dentro de `C:\xampp\htdocs\`

4. **Acceder a la aplicación**:
   - Abrir el navegador
   - Ir a: `http://localhost/crypto-lab/`

### Opción 2: PHP Built-in Server

1. Abrir terminal en la carpeta del proyecto
2. Ejecutar:
   ```bash
   php -S localhost:8000
   ```
3. Abrir `http://localhost:8000` en el navegador

---

## ⚙️ Configuración

La aplicación no requiere configuración adicional. Solo asegúrese de que:

1. PHP tenga habilitado `file_uploads` en `php.ini`
2. El límite de `upload_max_filesize` sea al menos 100KB
3. Los permisos de escritura estén habilitados para archivos temporales

---

## 📁 Estructura del Proyecto

```
crypto-lab/
├── index.php                 # Página principal
├── README.md                 # Este archivo
│
├── cesar/                    # Módulo César
│   ├── index.php             # Interfaz de cifrado César
│   └── cesar.php             # Funciones de cifrado César
│
├── archivos/                 # Módulo de Archivos
│   ├── index.php             # Interfaz de archivos
│   └── procesar.php          # Funciones de procesamiento
│
├── analizador/               # Módulo Analizador
│   ├── index.php             # Interfaz del analizador
│   └── analizador.php        # Funciones de análisis
│
├── vigenere/                 # Módulo Vigenère
│   ├── index.php             # Interfaz de cifrado Vigenère
│   └── vigenere.php          # Funciones de cifrado Vigenère
│
├── includes/                 # Archivos compartidos
│   ├── header.php            # Cabecera HTML
│   ├── navbar.php            # Barra de navegación
│   └── footer.php            # Pie de página
│
├── assets/                   # Recursos estáticos
│   ├── css/
│   │   └── style.css         # Estilos personalizados
│   └── js/
│       └── app.js            # JavaScript principal
│
└── docs/                     # Documentación
    └── documentacion.php     # Documentación completa
```

---

## 📚 Módulos

### 1. Cifrado César

Algoritmo de cifrado por desplazamiento que utiliza caracteres ASCII imprimibles (32-126).

**Características:**
- Cifrado y descifrado de mensajes
- Visualización paso a paso del proceso
- Fórmulas matemáticas explicadas
- Modo aprendizaje

### 2. César con Archivos

Permite cifrar y descifrar archivos de texto (.txt) utilizando el algoritmo César.

**Características:**
- Subida de archivos .txt
- Validación de extensión y tamaño
- Vista previa del contenido
- Descarga del resultado

### 3. Analizador

Herramientas de criptoanálisis para mensajes cifrados.

**Características:**
- Fuerza bruta para César (prueba 95 desplazamientos)
- Análisis de frecuencia de caracteres
- Gráficos visuales
- Puntuación de legibilidad

### 4. Cifrado Vigenère

Cifrado polialfabético que utiliza una clave de texto.

**Características:**
- Cifrado y descifrado con clave
- Visualización del proceso con clave
- Fórmulas matemáticas
- Manejo de caracteres no alfabéticos

---

## 🔐 Algoritmos Implementados

### César (ASCII Imprimible)

**Constantes:**
- `ASCII_INICIO = 32` (espacio)
- `ASCII_FIN = 126` (~)
- `TAM_ALFABETO = 95`

**Fórmula de cifrado:**
```
posicion = ASCII(caracter) - 32
nuevoAscii = ((posicion + desplazamiento) mod 95) + 32
```

**Fórmula de descifrado:**
```
posicion = ASCII(caracter) - 32
nuevoAscii = ((posicion - desplazamiento + 95) mod 95) + 32
```

### Vigenère

**Alfabeto:** A-Z (26 letras)

**Fórmula de cifrado:**
```
C = (P + K) mod 26
```

**Fórmula de descifrado:**
```
P = (C - K + 26) mod 26
```

Donde:
- P = Posición del texto (A=0, B=1, ..., Z=25)
- K = Valor de la clave
- C = Carácter cifrado resultante

---

## 🧪 Casos de Prueba

### Caso 1: César básico

| Campo | Valor |
|-------|-------|
| Texto | Hola Mundo |
| Desplazamiento | 3 |
| Cifrado esperado | Kruog#Uxqrog |

### Caso 2: César con símbolos

| Campo | Valor |
|-------|-------|
| Texto | Hola Mundo 123! @#$% |
| Desplazamiento | 5 |
| Cifrado esperado | Mtfq%Rzsiy 123! @#$% |

### Caso 3: Vigenère

| Campo | Valor |
|-------|-------|
| Mensaje | ATAQUE |
| Clave | CLAVE |
| Cifrado esperado | CLVLWC |

### Caso 4: Archivo TXT

1. Crear archivo `mensaje.txt` con contenido "Hola Mundo"
2. Subir al módulo de archivos
3. Cifrar con desplazamiento 5
4. Descargar resultado
5. Descifrar el archivo cifrado
6. Verificar que el contenido original se restaura

### Caso 5: Fuerza bruta

1. Cifrar "Hello World" con desplazamiento 7
2. Ingresar el resultado en el analizador
3. Ejecutar fuerza bruta
4. Verificar que el desplazamiento 7 aparece como posible resultado

---

## 🔒 Seguridad

La aplicación implementa las siguientes medidas de seguridad:

1. **Validación de entradas**: Todos los datos de usuario son validados
2. **Escape HTML**: Uso de `htmlspecialchars()` para prevenir XSS
3. **Validación de archivos**: Extensión, tamaño y tipo MIME
4. **Sin eval()**: No se utiliza evaluación de código dinámico
5. **Sin comandos del sistema**: No se usan `exec()`, `shell_exec()`, etc.
6. **Sin base de datos**: No hay almacenamiento persistente de datos
7. **Separación de concerns**: Lógica separada de presentación

---

## ⚠️ Limitaciones

### César
- Espacio de claves pequeño (95 posibles)
- Vulnerable a fuerza bruta
- Vulnerable a análisis de frecuencia
- Preserva patrones del idioma

### Vigenère
- La clave debe ser tan larga como el mensaje para máxima seguridad
- Vulnerable a análisis de Kasiski si la clave es corta
- No estándar para uso moderno

### General
- Estos algoritmos son **educativos**
- **NO** deben usarse para información sensible
- Para seguridad real, utilice AES, RSA o ChaCha20

---

## 📖 Conclusiones

1. **César** es un algoritmo sencillo y vulnerable, ideal para aprender conceptos básicos.

2. La utilización del rango ASCII 32-126 amplía César para soportar diferentes tipos de caracteres.

3. La **fuerza bruta** demuestra que un espacio de claves pequeño puede ser fácilmente explorado.

4. El **análisis de frecuencia** es una técnica importante de criptoanálisis clásico.

5. **Vigenère** utiliza múltiples desplazamientos dependiendo de la clave, ofreciendo mayor resistencia.

6. Estos algoritmos tienen principalmente **valor educativo** y no deben utilizarse actualmente para proteger información sensible.

---

## 👨‍🏫 Cómo Presentar el Proyecto

1. **Introducción**: Explicar qué es la criptografía y su importancia.

2. **Demostración en vivo**:
   - Mostrar el cifrado César con diferentes desplazamientos
   - Explicar cada paso del proceso
   - Demostrar la visualización paso a paso

3. **Archivos**: Cifrar y descifrar un archivo de texto.

4. **Criptoanálisis**:
   - Realizar fuerza bruta sobre un texto cifrado
   - Mostrar análisis de frecuencia
   - Explicar por qué se puede romper

5. **Vigenère**: Demostrar la diferencia con César.

6. **Comparación**: Mostrar la tabla comparativa.

7. **Conclusiones**: Explicar las limitaciones y por qué no se usan en la actualidad.

---

## 📝 Licencia

Este proyecto se distribuye bajo la **Licencia MIT** y está destinado
a fines educativos y académicos.

Desarrollado para el curso de **Ciberseguridad y Criptografía** del
**Doctorado en Ciencias de la Computación – Universidad Nacional del Altiplano**.

**🔐 Cybersecurity Cryptography Lab** - Proyecto académico de criptografía clásica
