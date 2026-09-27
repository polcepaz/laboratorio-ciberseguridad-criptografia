# 📚 Documentación - Cybersecurity Cryptography Lab

## Contenido

1. [¿Qué es criptografía?](#1-qué-es-criptografía)
2. [¿Qué es cifrado?](#2-qué-es-cifrado)
3. [¿Qué es descifrado?](#3-qué-es-descifrado)
4. [Criptoanálisis](#4-criptoanálisis)
5. [Algoritmo César](#5-algoritmo-césar)
6. [César con ASCII](#6-césar-con-ascii)
7. [ASCII imprimible](#7-ascii-imprimible)
8. [Aritmética modular](#8-aritmética-modular)
9. [Fuerza bruta](#9-fuerza-bruta)
10. [Análisis de frecuencia](#10-análisis-de-frecuencia)
11. [Algoritmo Vigenère](#11-algoritmo-vigenère)
12. [Comparación César vs Vigenère](#12-comparación-césar-vs-vigenère)
13. [Limitaciones](#13-limitaciones)

---

## 1. ¿Qué es criptografía?

La **criptografía** es la ciencia y práctica de proteger la información mediante técnicas que la convierten en ilegible para personas no autorizadas.

Su objetivo principal es garantizar:
- **Confidencialidad**: Solo personas autorizadas pueden leer la información
- **Integridad**: La información no ha sido modificada
- **Autenticidad**: Se puede verificar el origen de la información

### Ejemplo cotidiano
Cuando introduces tu contraseña en un sitio web, esa información se cifra antes de ser enviada para evitar que otros la intercepten.

---

## 2. ¿Qué es cifrado?

El **cifrado** es el proceso de convertir un mensaje legible (texto plano) en un mensaje ilegible (texto cifrado) utilizando un algoritmo y una clave.

```
Texto plano + Clave → Texto cifrado
```

El proceso inverso se llama **descifrado**, que convierte el texto cifrado de vuelta a texto plano utilizando la clave correcta.

---

## 3. ¿Qué es descifrado?

El **descifrado** es el proceso inverso al cifrado. Convierte el texto cifrado de vuelta a texto plano utilizando la clave correcta.

```
Texto cifrado + Clave → Texto plano
```

---

## 4. Criptoanálisis

El **criptoanálisis** es el estudio de los sistemas de cifrado con el objetivo de encontrar vulnerabilidades que permitan acceder al mensaje sin conocer la clave.

### Técnicas comunes

1. **Fuerza bruta**: Probar todas las claves posibles hasta encontrar la correcta
2. **Análisis de frecuencia**: Estudiar la distribución de caracteres para identificar patrones
3. **Análisis de bigramas/trigramas**: Estudiar pares o tríos de caracteres

---

## 5. Algoritmo César

El **cifrado César** es uno de los métodos de cifrado más simples y antiguos. Fue utilizado por Julio César para comunicarse con sus generales.

### Principio

Consiste en reemplazar cada letra del mensaje por otra letra que se encuentra un número fijo de posiciones más adelante en el alfabeto.

### Ejemplo con desplazamiento de 3

```
Original: A B C D E F G H I J K L M N O P Q R S T U V W X Y Z
Cifrado:  D E F G H I J K L M N O P Q R S T U V W X Y Z A B C
```

### Debilidad

- Solo tiene 26 claves posibles (o 95 con ASCII imprimible)
- Se puede romper fácilmente con fuerza bruta o análisis de frecuencia

---

## 6. César con ASCII imprimible

La implementación mejorada de César utiliza el rango completo de caracteres ASCII imprimibles (32-126), lo que permite cifrar:

- Mayúsculas (A-Z)
- Minúsculas (a-z)
- Números (0-9)
- Espacios
- Signos de puntuación
- Símbolos especiales

### Fórmulas

#### Cifrado
```
posicion = ASCII(caracter) - 32
nuevoAscii = ((posicion + desplazamiento) mod 95) + 32
```

#### Descifrado
```
posicion = ASCII(caracter) - 32
nuevoAscii = ((posicion - desplazamiento + 95) mod 95) + 32
```

### Ejemplo

Texto: `Hola 123!`
Desplazamiento: `3`

| Original | ASCII | Posición | Desplazamiento | Nuevo ASCII | Resultado |
|----------|-------|----------|----------------|-------------|-----------|
| H        | 72    | 40       | +3             | 75          | K         |
| o        | 111   | 79       | +3             | 82          | r         |
| l        | 108   | 76       | +3             | 79          | o         |
| a        | 97    | 65       | +3             | 68          | d         |
| (esp)    | 32    | 0        | +3             | 3           | # (35)    |
| 1        | 49    | 17       | +3             | 20          | 4 (52)    |
| 2        | 50    | 18       | +3             | 21          | 5 (53)    |
| 3        | 51    | 19       | +3             | 22          | 6 (54)    |
| !        | 33    | 1        | +3             | 4           | $ (36)    |

---

## 7. ASCII imprimible

El rango de **ASCII imprimible** va del 32 al 126, con un total de **95 caracteres**.

### Tabla de referencia

| ASCII | Carácter | ASCII | Carácter | ASCII | Carácter |
|-------|----------|-------|----------|-------|----------|
| 32    | ESP      | 65    | A        | 97    | a        |
| 33    | !        | 66    | B        | 98    | b        |
| 34    | "        | 67    | C        | 99    | c        |
| 35    | #        | 68    | D        | 100   | d        |
| 36    | $        | 69    | E        | 101   | e        |
| 37    | %        | 70    | F        | 102   | f        |
| 38    | &        | 71    | G        | 103   | g        |
| 39    | '        | 72    | H        | 104   | h        |
| 40    | (        | 73    | I        | 105   | i        |
| 41    | )        | 74    | J        | 106   | j        |
| 42    | *        | 75    | K        | 107   | k        |
| 43    | +        | 76    | L        | 108   | l        |
| 44    | ,        | 77    | M        | 109   | m        |
| 45    | -        | 78    | N        | 110   | n        |
| 46    | .        | 79    | O        | 111   | o        |
| 47    | /        | 80    | P        | 112   | p        |
| 48    | 0        | 81    | Q        | 113   | q        |
| 49    | 1        | 82    | R        | 114   | r        |
| 50    | 2        | 83    | S        | 115   | s        |
| 51    | 3        | 84    | T        | 116   | t        |
| 52    | 4        | 85    | U        | 117   | u        |
| 53    | 5        | 86    | V        | 118   | v        |
| 54    | 6        | 87    | W        | 119   | w        |
| 55    | 7        | 88    | X        | 120   | x        |
| 56    | 8        | 89    | Y        | 121   | y        |
| 57    | 9        | 90    | Z        | 122   | z        |
| 58    | :        | 91    | [        | 123   | {        |
| 59    | ;        | 92    | \        | 124   | |        |
| 60    | <        | 93    | ]        | 125   | }        |
| 61    | =        | 94    | ^        | 126   | ~        |
| 62    | >        | 95    | _        |       |          |
| 63    | ?        |       |          |       |          |
| 64    | @        |       |          |       |          |

### ¿Por qué 95 caracteres?

- ASCII imprimible: 126 - 32 + 1 = 95 caracteres
- Incluye todos los caracteres visibles que se pueden escribir
- Excluye caracteres de control (0-31) y DEL (127)

---

## 8. Aritmética modular

La **aritmética modular** (también llamada aritmética de reloj) es un sistema de aritmética para enteros donde los números "dan la vuelta" después de alcanzar un valor determinado llamado **módulo**.

### Ejemplo

En un reloj de 12 horas, si son las 10:00 y pasan 5 horas, son las 3:00 (no las 15:00).

```
(10 + 5) mod 12 = 3
```

### Aplicación en César

En César con ASCII, usamos módulo 95 porque hay 95 caracteres imprimibles. Esto garantiza que el resultado siempre esté en el rango válido (32-126).

```
Si posición = 90 y desplazamiento = 10:
(90 + 10) mod 95 = 100 + 32 = 132 → 132 - 95 = 37 → 37 + 32 = 69 (E)
```

---

## 9. Fuerza bruta

La **fuerza bruta** es un método de criptoanálisis que consiste en probar todas las claves posibles hasta encontrar la correcta.

### Para César con ASCII

- Hay 95 claves posibles (desplazamientos 0-94)
- Se prueban todos los desplazamientos automáticamente
- Se muestra el resultado de cada intento
- Se puede usar análisis de frecuencia para identificar el más probable

### Ventaja

Siempre funciona para César porque el espacio de claves es pequeño.

### Limitación

Para cifrados con espacios de claves grandes (como AES con 2^256 claves posibles), la fuerza bruta no es viable.

---

## 10. Análisis de frecuencia

El **análisis de frecuencia** es una técnica de criptoanálisis que estudia la distribución de los caracteres en un texto cifrado.

### Frecuencia de letras en español

```
E (13.7%) > A (12.5%) > O (8.8%) > S (6.5%) > R (6.0%) > N (7.0%) > I (6.9%)
```

### Frecuencia de letras en inglés

```
E (12.7%) > T (9.1%) > A (8.2%) > O (7.5%) > I (7.0%) > N (6.7%) > S (6.3%)
```

### Aplicación

En textos cifrados con César, las letras frecuentes se desplazan de manera consistente, lo que permite identificar el desplazamiento utilizado.

---

## 11. Algoritmo Vigenère

El **cifrado Vigenère** es un cifrado polialfabético que utiliza una clave de texto para determinar el desplazamiento de cada letra.

### Tabla de Vigenère

```
     A B C D E F G H I J K L M N O P Q R S T U V W X Y Z
A    A B C D E F G H I J K L M N O P Q R S T U V W X Y Z
B    B C D E F G H I J K L M N O P Q R S T U V W X Y Z A
C    C D E F G H I J K L M N O P Q R S T U V W X Y Z A B
D    D E F G H I J K L M N O P Q R S T U V W X Y Z A B C
E    E F G H I J K L M N O P Q R S T U V W X Y Z A B C D
...
Z    Z A B C D E F G H I J K L M N O P Q R S T U V W X Y
```

### Fórmulas

#### Cifrado
```
C = (P + K) mod 26
```

#### Descifrado
```
P = (C - K + 26) mod 26
```

Donde:
- **P** = Posición del texto (A=0, B=1, ..., Z=25)
- **K** = Valor de la clave (A=0, B=1, ..., Z=25)
- **C** = Carácter cifrado resultante

### Ejemplo

Mensaje: `ATAQUE`
Clave: `CLAVE`

| Posición | Texto | Valor | Clave | Valor | Resultado |
|----------|-------|-------|-------|-------|-----------|
| 1        | A     | 0     | C     | 2     | C         |
| 2        | T     | 19    | L     | 11    | E         |
| 3        | A     | 0     | A     | 0     | A         |
| 4        | Q     | 16    | V     | 21    | L         |
| 5        | U     | 20    | E     | 4     | Y         |
| 6        | E     | 4     | C     | 2     | G         |

Resultado: `CLEAYG`

### Característica importante

Los espacios, números y símbolos no consumen posiciones de la clave, solo las letras son procesadas.

---

## 12. Comparación César vs Vigenère

| Característica | César | Vigenère |
|----------------|-------|----------|
| Tipo | Monoalfabético | Polialfabético |
| Tipo de clave | Número (desplazamiento) | Texto (palabra clave) |
| Cantidad de claves | 95 | 26^n (n = longitud clave) |
| Complejidad | Baja | Media |
| Resistencia a fuerza bruta | Muy baja | Media |
| Resistencia a análisis de frecuencia | Nula | Parcial |
| Uso educativo | ✓ | ✓ |
| Uso en producción | ✗ | ✗ |

---

## 13. Limitaciones

### ⚠️ IMPORTANTE

Los algoritmos de cifrado clásico (César y Vigenère) tienen principalmente **valor educativo**. **NO** deben utilizarse actualmente para proteger información sensible.

### Limitaciones de César

- Espacio de claves extremadamente pequeño (95 posibles)
- Fácilmente vulnerable a fuerza bruta
- Preserva patrones de frecuencia del idioma
- No proporciona seguridad real

### Limitaciones de Vigenère

- La clave debe ser tan larga como el mensaje para ser segura
- Vulnerable a análisis de frecuencia de Kasiski si la clave es corta
- Repite patrones si la clave es corta
- No estándar para uso moderno

### Para seguridad real, utilice

- **AES** (Advanced Encryption Standard) - Cifrado simétrico moderno
- **RSA** - Cifrado asimétrico
- **ChaCha20** - Cifrado simétrico rápido
- **TLS/SSL** - Para comunicaciones seguras

---

## 📝 Casos de Prueba

### Caso 1: César básico

```
Texto: Hola Mundo
Desplazamiento: 3
Cifrado: Kruog#Uxqrog
Descifrado: Hola Mundo
```

### Caso 2: César con símbolos

```
Texto: Hola Mundo 123! @#$%
Desplazamiento: 5
Cifrado: Mtfq%Rzsiy 678& @#$%
Descifrado: Hola Mundo 123! @#$%
```

### Caso 3: Vigenère

```
Mensaje: ATAQUE
Clave: CLAVE
Cifrado: CLEAYG
Descifrado: ATAQUE
```

### Caso 4: Fuerza bruta

```
Texto cifrado con desplazamiento 7: "Aopk pz h zljyla"
Fuerza bruta identifica desplazamiento 7: "This is a secret"
```

---

**🔐 Cybersecurity Cryptography Lab** - Documentación completa de criptografía clásica
