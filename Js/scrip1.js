const form = document.getElementById('anemiaForm');
        const submitBtn = document.getElementById('submitBtn');
        const progressFill = document.getElementById('progressFill');
        const progressText = document.getElementById('progressText');
        const resultContainer = document.getElementById('resultContainer');
        
        // Actualizar progreso
        function updateProgress() {
            const totalQuestions = 6;
            const answeredQuestions = document.querySelectorAll('input[type="radio"]:checked').length;
            
            const progress = (answeredQuestions / totalQuestions) * 100;
            progressFill.style.width = progress + '%';
            progressText.textContent = `${answeredQuestions} de ${totalQuestions} preguntas respondidas`;
            
            submitBtn.disabled = answeredQuestions < totalQuestions;
        }
        
        // Escuchar cambios en los radio buttons
        form.addEventListener('change', updateProgress);
        
        // Procesar formulario
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Contar respuestas "sí"
            let yesCount = 0;
            for (let i = 1; i <= 6; i++) {
                const radio = document.querySelector(`input[name="p${i}"]:checked`);
                if (radio && radio.value === 'si') {
                    yesCount++;
                }
            }
            
            // Mostrar resultados
            showResults(yesCount);
        });
        
        function showResults(yesCount) {
            const resultTitle = document.getElementById('resultTitle');
            const resultDescription = document.getElementById('resultDescription');
            const recommendations = document.getElementById('recommendations');

            // Ocultar formulario y mostrar resultados
            form.style.display = 'none';
            resultContainer.style.display = 'block';
            let extraBtn = `<button class="reset-btn" onclick="window.location.href='sintomas.html'">Ver Sintomas</button>`;

            if (yesCount === 0) {
                // Riesgo muy bajo
                resultContainer.className = 'result-container result-low';
                resultTitle.innerHTML = '✅ Riesgo Muy Bajo de Anemia';
                resultDescription.innerHTML = 'Excelente. No se identificaron señales de alerta de anemia en las respuestas. Tu hijo(a) parece estar en buen estado general.';
                recommendations.innerHTML = `
                    <h4>Recomendaciones Preventivas:</h4>
                    <ul>
                        <li>Mantén una alimentación balanceada rica en hierro</li>
                        <li>Incluye alimentos como carnes, pescado, lentejas y vegetales verdes</li>
                        <li>Realiza controles pediátricos regulares</li>
                        <li>Mantén la higiene para prevenir infecciones</li>
                    </ul>
                    ${extraBtn}
                `;
            } else if (yesCount <= 2) {
                // Riesgo bajo
                resultContainer.className = 'result-container result-low';
                resultTitle.innerHTML = '⚠️ Riesgo Bajo de Anemia';
                resultDescription.innerHTML = 'Se identificaron algunas señales menores. Es recomendable prestar atención y tomar medidas preventivas.';
                recommendations.innerHTML = `
                    <h4>Recomendaciones:</h4>
                    <ul>
                        <li>Mejora la alimentación con alimentos ricos en hierro</li>
                        <li>Observa si los síntomas persisten o aumentan</li>
                        <li>Considera una consulta pediátrica preventiva</li>
                        <li>Asegúrate de que duerma las horas necesarias</li>
                        <li>Fomenta la actividad física apropiada para su edad</li>
                    </ul>
                    ${extraBtn}
                `;
            } else if (yesCount <= 4) {
                // Riesgo moderado
                resultContainer.className = 'result-container result-medium';
                resultTitle.innerHTML = '🔶 Riesgo Moderado de Anemia';
                resultDescription.innerHTML = 'Se identificaron varias señales de alerta. Es importante tomar medidas y consultar con un profesional de la salud.';
                recommendations.innerHTML = `
                    <h4>Recomendaciones Importantes:</h4>
                    <ul>
                        <li>Programa una cita con el pediatra en las próximas semanas</li>
                        <li>Implementa una dieta rica en hierro inmediatamente</li>
                        <li>Considera suplementos de hierro (bajo supervisión médica)</li>
                        <li>Monitorea los síntomas diariamente</li>
                        <li>Mejora los hábitos de sueño y descanso</li>
                    </ul>
                    ${extraBtn}
                `;
            } else {
                // Riesgo alto
                resultContainer.className = 'result-container result-high';
                resultTitle.innerHTML = '🚨 Riesgo Alto de Anemia';
                resultDescription.innerHTML = 'Se identificaron múltiples señales de alerta importantes. Es crucial buscar atención médica profesional lo antes posible.';
                recommendations.innerHTML = `
                    <h4>Acción Inmediata Requerida:</h4>
                    <ul>
                        <li>Consulta con un pediatra URGENTEMENTE</li>
                        <li>Solicita análisis de sangre (hemograma completo)</li>
                        <li>No esperes, agenda la cita esta semana</li>
                        <li>Mejora la alimentación con supervisión médica</li>
                        <li>Considera llevar un registro diario de síntomas</li>
                    </ul>
                    ${extraBtn}
                `;
            }
        }
        
        function resetForm() {
            form.reset();
            form.style.display = 'block';
            resultContainer.style.display = 'none';
            updateProgress();
        }