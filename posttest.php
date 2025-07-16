<?php
// Intentar recuperar id_usuario desde la URL
$id_usuario = $_GET['id_usuario'] ?? null;

// Si no viene por URL, lo recuperaremos por JavaScript desde localStorage
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Post-Test Anemia Infantil</title>
    <link rel="stylesheet" href="Estilos/preposttest.css">
</head>

<body style="background: linear-gradient(180deg, #AEE9FF 0%, #7EC8E3 60%, #B3D8F7 100%);">
    <div class="formulario-layout">
        <div class="formulario-imagenes-col imagenes-izq">
            <img src="Img/estetoscopio.png" alt="Estetoscopio" class="img-efecto img-estetoscopio">
            <img src="Img/frasco.png" alt="Frasco" class="img-efecto img-frasco">
        </div>
        <div class="pretest-card-glass">
            <h1 class="pretest-title" style="font-family:'Segoe UI', Arial, sans-serif;">Post-Test Anemia Infantil</h1>
            <p class="pretest-desc">Responde las siguientes preguntas después de la evaluación principal.</p>
            <form action="guardar_posttest.php" method="post" id="posttest-form">
                <input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $id_usuario; ?>">
                <div class="registro-fields">
                    <div class="question">
                        <div class="question-text">
                            <span class="question-number">7</span>
                            Marque al menos dos signos o síntomas de anemia infantil:
                        </div>
                        <div class="options">
                            <select name="sintomas_anemia" required>
                                <option>Palidez y Cansancio</option>
                                <option>Alegría excesiva y Retraso en el crecimiento</option>
                                <option>Pérdida de apetito y Agilidad extrema</option>
                            </select>
                        </div>
                    </div>
                    <div class="question">
                        <div class="question-text">
                            <span class="question-number">8</span>
                            Marque los alimentos que son fuente importante de hierro:
                        </div>
                        <div class="options">
                            <select name="alimentos_ricos_hierro" required>
                                <option>Hígado de res, Quinua, Sangre de pollo y cushuro</option>
                                <option>Frijol negro, Fideos, espinacas</option>
                                <option>Cushuro, arroz, papa y Camote</option>
                            </select>
                        </div>
                    </div>
                    <div class="question">
                        <div class="question-text">
                            <span class="question-number">9</span>
                            ¿Qué alimentos o bebidas deben evitarse junto con comidas principales para no dificultar la absorción del hierro?
                        </div>
                        <div class="options">
                            <select name="alimentos_evitar" required>
                                <option>Leche, Frutas cítricas y gaseosa</option>
                                <option>Café o té, leche y chocolate caliente</option>
                                <option>Jugo de naranja, té y leche</option>
                            </select>
                        </div>
                    </div>
                    <div class="question">
                        <div class="question-text">
                            <span class="question-number">10</span>
                            ¿Por qué es importante acompañar los alimentos ricos en hierro con vitamina C?
                        </div>
                        <div class="options">
                            <select name="importancia_vitamina_c" required>
                                <option>Porque mejora la absorción del hierro</option>
                                <option>Porque ayuda al crecimiento del niño</option>
                                <option>Porque mejora el sabor de la comida</option>
                            </select>
                        </div>
                    </div>
                    <div class="question">
                        <div class="question-text">
                            <span class="question-number">11</span>
                            Después de revisar la página web, ¿conoce usted la importancia de la lactancia materna exclusiva?
                        </div>
                        <div class="options">
                            <select name="conocimiento_lactancia" required>
                                <option>Sí, completamente</option>
                                <option>Sí, en parte</option>
                                <option>No</option>
                                <option>Me gustaría más información</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="submit-btn">Enviar Post-Test</button>
            </form>
        </div>
        <div class="formulario-imagenes-col imagenes-der">
            <img src="Img/vacuna.png" alt="Vacuna" class="img-efecto img-vacuna">
        </div>
    </div>
    <script src="Js/formulario-imagenes-scrollparallax.js"></script>
    <script>
        // Si el campo hidden está vacío, intentamos completarlo desde localStorage
        const idInput = document.getElementById('id_usuario');
        if (!idInput.value) {
            const idGuardado = localStorage.getItem("id_usuario");
            if (idGuardado) {
                idInput.value = idGuardado;
            } else {
                alert("No se encontró el ID del usuario. El formulario no podrá enviarse correctamente.");
            }
        }
    </script>
</body>

</html>