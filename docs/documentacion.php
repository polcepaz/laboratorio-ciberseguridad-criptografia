<?php
/**
 * Laboratorio de Ciberseguridad y Criptografía
 * Universidad Nacional del Altiplano – Puno
 * Documentación completa de criptografía clásica
 * 
 * @package CryptoLab
 * @subpackage Documentacion
 * @version 2.0.0
 */

$page_title = 'Documentación - Laboratorio de Ciberseguridad';
$base_path = '..';
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/navbar.php';
?>

<section class="module-header">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../index.php" class="text-decoration-none">Inicio</a></li>
                <li class="breadcrumb-item active">Documentación</li>
            </ol>
        </nav>
        <div class="d-flex align-items-center mb-3">
            <div class="module-icon-sm bg-cyan">
                <i class="bi bi-book"></i>
            </div>
            <div>
                <h1 class="module-title mb-0">Documentación</h1>
                <p class="module-subtitle mb-0">Guía completa de criptografía clásica y los algoritmos implementados</p>
            </div>
        </div>
    </div>
</section>

<section class="container py-4">
    <div class="row">
        <div class="col-lg-3">
            <div class="card shadow-sm sticky-top" style="top: 80px;">
                <div class="card-header bg-navy text-white">
                    <i class="bi bi-list-ul me-2"></i>
                    Contenido
                </div>
                <div class="card-body p-2">
                    <nav class="nav flex-column">
                        <a class="nav-link text-dark" href="#criptografia">1. ¿Qué es criptografía?</a>
                        <a class="nav-link text-dark" href="#cifrado">2. ¿Qué es cifrado?</a>
                        <a class="nav-link text-dark" href="#descifrado">3. ¿Qué es descifrado?</a>
                        <a class="nav-link text-dark" href="#criptoanalisis">4. Criptoanálisis</a>
                        <a class="nav-link text-dark" href="#cesar">5. Algoritmo César</a>
                        <a class="nav-link text-dark" href="#ascii">6. César con ASCII</a>
                        <a class="nav-link text-dark" href="#ascii-refs">7. ASCII imprimible</a>
                        <a class="nav-link text-dark" href="#modular">8. Aritmética modular</a>
                        <a class="nav-link text-dark" href="#fuerza-bruta">9. Fuerza bruta</a>
                        <a class="nav-link text-dark" href="#frecuencia">10. Análisis de frecuencia</a>
                        <a class="nav-link text-dark" href="#vigenere">11. Algoritmo Vigenère</a>
                        <a class="nav-link text-dark" href="#comparacion-doc">12. Comparación</a>
                        <a class="nav-link text-dark" href="#limitaciones">13. Limitaciones</a>
                    </nav>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="card shadow-sm mb-4" id="criptografia">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="bi bi-shield-lock me-2"></i>1. ¿Qué es criptografía?</h5>
                </div>
                <div class="card-body">
                    <p>La <strong>criptografía</strong> es la ciencia y práctica de proteger la información mediante técnicas que la convierten en ilegible para personas no autorizadas.</p>
                    <p>Su objetivo principal es garantizar la <strong>confidencialidad</strong>, <strong>integridad</strong> y <strong>autenticidad</strong> de los datos.</p>
                    <div class="alert alert-info">
                        <strong>Ejemplo cotidiano:</strong> Cuando introduces tu contraseña en un sitio web, esa información se cifra antes de ser enviada para evitar que otros la intercepten.
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mb-4" id="cifrado">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="bi bi-lock me-2"></i>2. ¿Qué es cifrado?</h5>
                </div>
                <div class="card-body">
                    <p>El <strong>cifrado</strong> es el proceso de convertir un mensaje legible (texto plano) en un mensaje ilegible (texto cifrado) utilizando un algoritmo y una clave.</p>
                    <div class="formula-box">
                        <span class="variable">Texto plano</span> + <span class="variable">Clave</span> → <span class="result">Texto cifrado</span>
                    </div>
                    <p>El proceso inverso se llama <strong>descifrado</strong>, que convierte el texto cifrado de vuelta a texto plano utilizando la clave correcta.</p>
                </div>
            </div>

            <div class="card shadow-sm mb-4" id="descifrado">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="bi bi-unlock me-2"></i>3. ¿Qué es descifrado?</h5>
                </div>
                <div class="card-body">
                    <p>El <strong>descifrado</strong> es el proceso inverso al cifrado. Convierte el texto cifrado de vuelta a texto plano utilizando la clave correcta.</p>
                    <div class="formula-box">
                        <span class="variable">Texto cifrado</span> + <span class="variable">Clave</span> → <span class="result">Texto plano</span>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mb-4" id="criptoanalisis">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="bi bi-search me-2"></i>4. Criptoanálisis</h5>
                </div>
                <div class="card-body">
                    <p>El <strong>criptoanálisis</strong> es el estudio de los sistemas de cifrado con el objetivo de encontrar vulnerabilidades que permitan acceder al mensaje sin conocer la clave.</p>
                    <p>Técnicas comunes de criptoanálisis incluyen:</p>
                    <ul>
                        <li><strong>Fuerza bruta:</strong> Probar todas las claves posibles hasta encontrar la correcta.</li>
                        <li><strong>Análisis de frecuencia:</strong> Estudiar la distribución de caracteres para identificar patrones.</li>
                        <li><strong>Análisis de frecuencia de bigramas/trigramas:</strong> Estudiar pares o tríos de caracteres.</li>
                    </ul>
                </div>
            </div>

            <div class="card shadow-sm mb-4" id="cesar">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="bi bi-key me-2"></i>5. Algoritmo César</h5>
                </div>
                <div class="card-body">
                    <p>El <strong>cifrado César</strong> es uno de los métodos de cifrado más simples y antiguos. Fue utilizado por Julio César para comunicarse con sus generales.</p>
                    <p>Consiste en reemplazar cada letra del mensaje por otra letra que se encuentra un número fijo de posiciones más adelante en el alfabeto.</p>

                    <h6>Ejemplo con desplazamiento de 3:</h6>
                    <div class="ascii-display">
A B C D E F G H I J K L M N O P Q R S T U V W X Y Z
↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓
D E F G H I J K L M N O P Q R S T U V W X Y Z A B C
                    </div>

                    <div class="alert alert-warning mt-3">
                        <strong>Debilidad:</strong> Solo tiene 26 claves posibles (o 95 con ASCII imprimible). Se puede romper fácilmente con fuerza bruta o análisis de frecuencia.
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mb-4" id="ascii">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="bi bi-file-binary me-2"></i>6. César con ASCII imprimible</h5>
                </div>
                <div class="card-body">
                    <p>La implementación mejorada de César utiliza el rango completo de caracteres ASCII imprimibles (32-126), lo que permite cifrar:</p>
                    <ul>
                        <li>Mayúsculas (A-Z)</li>
                        <li>Minúsculas (a-z)</li>
                        <li>Números (0-9)</li>
                        <li>Espacios</li>
                        <li>Signos de puntuación</li>
                        <li>Símbolos especiales</li>
                    </ul>

                    <h6>Fórmulas:</h6>
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

            <div class="card shadow-sm mb-4" id="ascii-refs">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="bi bi-table me-2"></i>7. ASCII imprimible</h5>
                </div>
                <div class="card-body">
                    <p>El rango de <strong>ASCII imprimible</strong> va del 32 al 126, con un total de <strong>95 caracteres</strong>.</p>

                    <h6>Tabla de referencia:</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm process-table">
                            <thead>
                                <tr>
                                    <th>ASCII</th>
                                    <th>Carácter</th>
                                    <th>ASCII</th>
                                    <th>Carácter</th>
                                    <th>ASCII</th>
                                    <th>Carácter</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td>32</td><td>ESP</td><td>65</td><td>A</td><td>97</td><td>a</td></tr>
                                <tr><td>33</td><td>!</td><td>66</td><td>B</td><td>98</td><td>b</td></tr>
                                <tr><td>34</td><td>"</td><td>67</td><td>C</td><td>99</td><td>c</td></tr>
                                <tr><td>35</td><td>#</td><td>68</td><td>D</td><td>100</td><td>d</td></tr>
                                <tr><td>36</td><td>$</td><td>69</td><td>E</td><td>101</td><td>e</td></tr>
                                <tr><td>37</td><td>%</td><td>70</td><td>F</td><td>102</td><td>f</td></tr>
                                <tr><td>38</td><td>&</td><td>71</td><td>G</td><td>103</td><td>g</td></tr>
                                <tr><td>39</td><td>'</td><td>72</td><td>H</td><td>104</td><td>h</td></tr>
                                <tr><td>40</td><td>(</td><td>73</td><td>I</td><td>105</td><td>i</td></tr>
                                <tr><td>41</td><td>)</td><td>74</td><td>J</td><td>106</td><td>j</td></tr>
                                <tr><td>42</td><td>*</td><td>75</td><td>K</td><td>107</td><td>k</td></tr>
                                <tr><td>43</td><td>+</td><td>76</td><td>L</td><td>108</td><td>l</td></tr>
                                <tr><td>44</td><td>,</td><td>77</td><td>M</td><td>109</td><td>m</td></tr>
                                <tr><td>45</td><td>-</td><td>78</td><td>N</td><td>110</td><td>n</td></tr>
                                <tr><td>46</td><td>.</td><td>79</td><td>O</td><td>111</td><td>o</td></tr>
                                <tr><td>47</td><td>/</td><td>80</td><td>P</td><td>112</td><td>p</td></tr>
                                <tr><td>48</td><td>0</td><td>81</td><td>Q</td><td>113</td><td>q</td></tr>
                                <tr><td>49</td><td>1</td><td>82</td><td>R</td><td>114</td><td>r</td></tr>
                                <tr><td>50</td><td>2</td><td>83</td><td>S</td><td>115</td><td>s</td></tr>
                                <tr><td>51</td><td>3</td><td>84</td><td>T</td><td>116</td><td>t</td></tr>
                                <tr><td>52</td><td>4</td><td>85</td><td>U</td><td>117</td><td>u</td></tr>
                                <tr><td>53</td><td>5</td><td>86</td><td>V</td><td>118</td><td>v</td></tr>
                                <tr><td>54</td><td>6</td><td>87</td><td>W</td><td>119</td><td>w</td></tr>
                                <tr><td>55</td><td>7</td><td>88</td><td>X</td><td>120</td><td>x</td></tr>
                                <tr><td>56</td><td>8</td><td>89</td><td>Y</td><td>121</td><td>y</td></tr>
                                <tr><td>57</td><td>9</td><td>90</td><td>Z</td><td>122</td><td>z</td></tr>
                                <tr><td>58</td><td>:</td><td>91</td><td>[</td><td>123</td><td>{</td></tr>
                                <tr><td>59</td><td>;</td><td>92</td><td>\</td><td>124</td><td>|</td></tr>
                                <tr><td>60</td><td>&lt;</td><td>93</td><td>]</td><td>125</td><td>}</td></tr>
                                <tr><td>61</td><td>=</td><td>94</td><td>^</td><td>126</td><td>~</td></tr>
                                <tr><td>62</td><td>&gt;</td><td>95</td><td>_</td><td colspan="2"></td></tr>
                                <tr><td>63</td><td>?</td><td colspan="4"></td></tr>
                                <tr><td>64</td><td>@</td><td colspan="4"></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mb-4" id="modular">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="bi bi-calculator me-2"></i>8. Aritmética modular</h5>
                </div>
                <div class="card-body">
                    <p>La <strong>aritmética modular</strong> (también llamada aritmética de reloj) es un sistema de aritmética para enteros donde los números "dan la vuelta" después de alcanzar un valor determinado llamado <strong>módulo</strong>.</p>

                    <h6>Ejemplo:</h6>
                    <p>En un reloj de 12 horas, si son las 10:00 y pasan 5 horas, son las 3:00 (no las 15:00). Esto es aritmética modular: <code>(10 + 5) mod 12 = 3</code></p>

                    <div class="formula-box">
                        <span class="variable">a</span> <span class="operator">mod</span> <span class="variable">n</span> = <span class="result">residuo de a / n</span>
                    </div>

                    <p>En César con ASCII, usamos módulo 95 porque hay 95 caracteres imprimibles. Esto garantiza que el resultado siempre esté en el rango válido.</p>
                </div>
            </div>

            <div class="card shadow-sm mb-4" id="fuerza-bruta">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="bi bi-key me-2"></i>9. Fuerza bruta</h5>
                </div>
                <div class="card-body">
                    <p>La <strong>fuerza bruta</strong> es un método de criptoanálisis que consiste en probar todas las claves posibles hasta encontrar la correcta.</p>

                    <h6>Para César con ASCII:</h6>
                    <ul>
                        <li>Hay 95 claves posibles (desplazamientos 0-94)</li>
                        <li>Se prueban todos los desplazamientos automáticamente</li>
                        <li>Se muestra el resultado de cada intento</li>
                        <li>Se puede usar análisis de frecuencia para identificar el más probable</li>
                    </ul>

                    <div class="alert alert-success">
                        <strong>Ventaja:</strong> Siempre funciona para César porque el espacio de claves es pequeño.
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mb-4" id="frecuencia">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="bi bi-bar-chart me-2"></i>10. Análisis de frecuencia</h5>
                </div>
                <div class="card-body">
                    <p>El <strong>análisis de frecuencia</strong> es una técnica de criptoanálisis que estudia la distribución de los caracteres en un texto cifrado.</p>

                    <h6>Frecuencia de letras en español:</h6>
                    <div class="ascii-display">
E (13.7%) > A (12.5%) > O (8.8%) > S (6.5%) > R (6.0%) > N (7.0%) > I (6.9%)
                    </div>

                    <h6>Frecuencia de letras en inglés:</h6>
                    <div class="ascii-display">
E (12.7%) > T (9.1%) > A (8.2%) > O (7.5%) > I (7.0%) > N (6.7%) > S (6.3%)
                    </div>

                    <p>En textos cifrados con César, las letras frecuentes se desplazan de manera consistente, lo que permite identificar el desplazamiento utilizado.</p>
                </div>
            </div>

            <div class="card shadow-sm mb-4" id="vigenere">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="bi bi-shield-lock me-2"></i>11. Algoritmo Vigenère</h5>
                </div>
                <div class="card-body">
                    <p>El <strong>cifrado Vigenère</strong> es un cifrado polialfabético que utiliza una clave de texto para determinar el desplazamiento de cada letra.</p>

                    <h6>Tabla de Vigenère:</h6>
                    <div class="table-responsive" style="font-size: 0.8rem;">
                        <table class="table table-bordered table-sm process-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>A</th><th>B</th><th>C</th><th>D</th><th>E</th><th>F</th><th>G</th><th>H</th><th>I</th><th>J</th><th>K</th><th>L</th><th>M</th>
                                    <th>N</th><th>O</th><th>P</th><th>Q</th><th>R</th><th>S</th><th>T</th><th>U</th><th>V</th><th>W</th><th>X</th><th>Y</th><th>Z</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="fw-bold">A</td>
                                    <td>A</td><td>B</td><td>C</td><td>D</td><td>E</td><td>F</td><td>G</td><td>H</td><td>I</td><td>J</td><td>K</td><td>L</td><td>M</td>
                                    <td>N</td><td>O</td><td>P</td><td>Q</td><td>R</td><td>S</td><td>T</td><td>U</td><td>V</td><td>W</td><td>X</td><td>Y</td><td>Z</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">B</td>
                                    <td>B</td><td>C</td><td>D</td><td>E</td><td>F</td><td>G</td><td>H</td><td>I</td><td>J</td><td>K</td><td>L</td><td>M</td><td>N</td>
                                    <td>O</td><td>P</td><td>Q</td><td>R</td><td>S</td><td>T</td><td>U</td><td>V</td><td>W</td><td>X</td><td>Y</td><td>Z</td><td>A</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">C</td>
                                    <td>C</td><td>D</td><td>E</td><td>F</td><td>G</td><td>H</td><td>I</td><td>J</td><td>K</td><td>L</td><td>M</td><td>N</td><td>O</td>
                                    <td>P</td><td>Q</td><td>R</td><td>S</td><td>T</td><td>U</td><td>V</td><td>W</td><td>X</td><td>Y</td><td>Z</td><td>A</td><td>B</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h6>Fórmulas:</h6>
                    <div class="formula-box mb-3">
                        <strong>Cifrado:</strong> <span class="result">C</span> = (<span class="variable">P</span> + <span class="variable">K</span>) <span class="operator">mod</span> 26
                    </div>
                    <div class="formula-box">
                        <strong>Descifrado:</strong> <span class="result">P</span> = (<span class="variable">C</span> - <span class="variable">K</span> + 26) <span class="operator">mod</span> 26
                    </div>

                    <div class="alert alert-info mt-3">
                        <strong>Característica:</strong> Los espacios, números y símbolos no consumen posiciones de la clave, solo las letras son procesadas.
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mb-4" id="comparacion-doc">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="bi bi-bar-chart me-2"></i>12. Comparación César vs Vigenère</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered process-table">
                            <thead class="table-dark">
                                <tr>
                                    <th>Característica</th>
                                    <th>César</th>
                                    <th>Vigenère</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td>Tipo</td><td>Monoalfabético</td><td>Polialfabético</td></tr>
                                <tr><td>Clave</td><td>Número</td><td>Texto</td></tr>
                                <tr><td>Claves posibles</td><td>95</td><td>26^n</td></tr>
                                <tr><td>Complejidad</td><td>Baja</td><td>Media</td></tr>
                                <tr><td>Fuerza bruta</td><td>Fácil</td><td>Más difícil</td></tr>
                                <tr><td>Análisis frecuencia</td><td>Muy efectivo</td><td>Parcialmente efectivo</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mb-4" id="limitaciones">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="bi bi-exclamation-triangle me-2"></i>13. Limitaciones</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-danger">
                        <strong>IMPORTANTE:</strong> Los algoritmos de cifrado clásico (César y Vigenère) tienen principalmente <strong>valor educativo</strong>. <strong>NO</strong> deben utilizarse actualmente para proteger información sensible.
                    </div>

                    <h6>Limitaciones de César:</h6>
                    <ul>
                        <li>Espacio de claves extremadamente pequeño</li>
                        <li>Fácilmente vulnerable a fuerza bruta</li>
                        <li>Preserva patrones de frecuencia del idioma</li>
                        <li>No proporciona seguridad real</li>
                    </ul>

                    <h6>Limitaciones de Vigenère:</h6>
                    <ul>
                        <li>Vulnerable a análisis de frecuencia de Kasiski</li>
                        <li>La clave debe ser tan larga como el mensaje para ser segura</li>
                        <li>Repite patrones si la clave es corta</li>
                        <li>No estándar para uso moderno</li>
                    </ul>

                    <h6>Para seguridad real, utilice:</h6>
                    <ul>
                        <li><strong>AES</strong> (Advanced Encryption Standard)</li>
                        <li><strong>RSA</strong> para cifrado asimétrico</li>
                        <li><strong>ChaCha20</strong> para cifrado simétrico</li>
                        <li><strong>TLS/SSL</strong> para comunicaciones seguras</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
