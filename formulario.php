<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detección Temprana de Anemia Infantil</title>
    <link rel="stylesheet" href="estilos/styles.css">
    <link rel="stylesheet" href="estilos/formulario-imagenes.css">
</head>
<body>
    
    <div class="formulario-layout">
      <div class="formulario-imagenes-col imagenes-izq">
        <img src="img/estetoscopio.png" alt="Estetoscopio" class="img-efecto img-estetoscopio">
        <img src="img/frasco.png" alt="Frasco" class="img-efecto img-frasco">
      </div>
      <div class="container">
        <div class="header">
            <h1>Detección Temprana de<br>Anemia Infantil</h1>
            <p>Responde las siguientes preguntas para identificar<br>posibles señales de anemia en tu hijo(a)</p>
        </div>
        <div class="form-container">
            <div class="progress-container">
                <div class="progress-bar-wrapper">
                    <div class="progress-bar">
                        <div class="progress-fill" id="progressFill"></div>
                    </div>
                    <img src="img/nube1.png" alt="Nube" class="progress-cloud" id="progressCloud">
                </div>
                <div class="progress-text" id="progressText">0 de 6 preguntas respondidas</div>
            </div>
            <form id="anemiaForm">
                <div class="question">
                    <div class="question-text">
                        <span class="question-number">1</span>
                        ¿Observas que tu hijo(a) está más pálido de lo normal?
                    </div>
                    <div class="options">
                        <div class="option">
                            <input type="radio" name="p1" value="si" id="p1_si">
                            <label for="p1_si">Sí</label>
                        </div>
                        <div class="option">
                            <input type="radio" name="p1" value="no" id="p1_no">
                            <label for="p1_no">No</label>
                        </div>
                    </div>
                </div>
                
                <div class="question">
                    <div class="question-text">
                        <span class="question-number">2</span>
                        ¿Parece cansado o sin energía con frecuencia?
                    </div>
                    <div class="options">
                        <div class="option">
                            <input type="radio" name="p2" value="si" id="p2_si">
                            <label for="p2_si">Sí</label>
                        </div>
                        <div class="option">
                            <input type="radio" name="p2" value="no" id="p2_no">
                            <label for="p2_no">No</label>
                        </div>
                    </div>
                </div>
                
                <div class="question">
                    <div class="question-text">
                        <span class="question-number">3</span>
                        ¿Tiene poco apetito?
                    </div>
                    <div class="options">
                        <div class="option">
                            <input type="radio" name="p3" value="si" id="p3_si">
                            <label for="p3_si">Sí</label>
                        </div>
                        <div class="option">
                            <input type="radio" name="p3" value="no" id="p3_no">
                            <label for="p3_no">No</label>
                        </div>
                    </div>
                </div>
                
                <div class="question">
                    <div class="question-text">
                        <span class="question-number">4</span>
                        ¿Se enferma seguido o le cuesta recuperarse?
                    </div>
                    <div class="options">
                        <div class="option">
                            <input type="radio" name="p4" value="si" id="p4_si">
                            <label for="p4_si">Sí</label>
                        </div>
                        <div class="option">
                            <input type="radio" name="p4" value="no" id="p4_no">
                            <label for="p4_no">No</label>
                        </div>
                    </div>
                </div>
                
                <div class="question">
                    <div class="question-text">
                        <span class="question-number">5</span>
                        ¿Sus uñas se quiebran fácilmente o la piel está reseca?
                    </div>
                    <div class="options">
                        <div class="option">
                            <input type="radio" name="p5" value="si" id="p5_si">
                            <label for="p5_si">Sí</label>
                        </div>
                        <div class="option">
                            <input type="radio" name="p5" value="no" id="p5_no">
                            <label for="p5_no">No</label>
                        </div>
                    </div>
                </div>
                
                <div class="question">
                    <div class="question-text">
                        <span class="question-number">6</span>
                        ¿Ha tenido episodios frecuentes de respiración acelerada sin razón aparente?
                    </div>
                    <div class="options">
                        <div class="option">
                            <input type="radio" name="p6" value="si" id="p6_si">
                            <label for="p6_si">Sí</label>
                        </div>
                        <div class="option">
                            <input type="radio" name="p6" value="no" id="p6_no">
                            <label for="p6_no">No</label>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="submit-btn" id="submitBtn" disabled>
                    Obtener Evaluación
                </button>
            </form>
            <div class="result-container" id="resultContainer">
                <div class="result-title" id="resultTitle"></div>
                <div class="result-description" id="resultDescription"></div>
                <div class="recommendations" id="recommendations"></div>
                <button class="reset-btn" onclick="resetForm()">Realizar Nueva Evaluación</button>
            </div>
        </div>
      </div>
      <div class="formulario-imagenes-col imagenes-der">
        <img src="img/vacuna.png" alt="Vacuna" class="img-efecto img-vacuna">
      </div>
    </div>
    
    <script src="js/scrip1.js"></script>
    <script src="js/formulario-imagenes-scrollparallax.js"></script>
</body>
</html>