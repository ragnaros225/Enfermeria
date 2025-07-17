// Modal de ver respuestas en Cuestionario 2
function closeModalRespuestas2() {
  document.getElementById('modalRespuestas2').style.display = 'none';
  document.body.style.overflow = '';
}
function openModalRespuestas2(respuestas) {
  const modal = document.getElementById('modalRespuestas2');
  const cont = document.getElementById('modalPreguntasRespuestas2');
  cont.innerHTML = '';
  respuestas.forEach((item, idx) => {
    const card = document.createElement('div');
    card.className = 'pregunta-respuesta-card';
    let html = `<div class=\"pregunta\"><strong>${idx + 1}. ${item.pregunta}</strong></div>`;
    html += `<div class=\"respuesta\">Respuesta: <span>${(item.respuesta || '').trim()}</span></div>`;
    card.innerHTML = html;
    cont.appendChild(card);
  });
  modal.style.display = 'flex';
  document.body.style.overflow = 'hidden';
}
function showTab(tab) {
  const tabs = ['dashboard', 'usuarios', 'valoraciones', 'cuestionario', 'cuestionario2'];
  tabs.forEach(function(t) {
    const element = document.getElementById('tab-' + t);
    if (element) {
      element.style.display = (t === tab) ? 'block' : 'none';
    }
  });

  const btns = document.querySelectorAll('.tab-btn:not(.logout-tab)');
  btns.forEach(function(btn, idx) {
    btn.classList.toggle('active', tabs[idx] === tab);
  });
}

// Inicializar el tab "dashboard" al cargar la página
document.addEventListener('DOMContentLoaded', function() {
  showTab('dashboard');

  // --- GRAFICOS DASHBOARD ---
  // Usuarios por mes (barras)
  if (typeof usuariosLabels !== 'undefined' && document.getElementById('graficoUsuarios')) {
    const ctx = document.getElementById('graficoUsuarios').getContext('2d');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: usuariosLabels,
        datasets: [{
          label: 'Usuarios registrados',
          data: usuariosData,
          backgroundColor: ['#7c3aed', '#a78bfa', '#6366f1', '#818cf8', '#f472b6', '#fbbf24', '#34d399', '#60a5fa', '#f87171', '#a3e635', '#facc15', '#f472b6'],
          borderRadius: 8
        }]
      },
      options: {
        responsive: false,
        plugins: {
          legend: {
            display: false
          }
        },
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  }
  // Comparativa Pre-Test (barras)
  if (typeof comparativaPreLabels !== 'undefined' && document.getElementById('graficoComparativaPre')) {
    const ctx = document.getElementById('graficoComparativaPre').getContext('2d');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: comparativaPreLabels,
        datasets: [{
          label: 'Primer Cuestionario: ¿Conoces la importancia de la lactancia materna exclusiva?',
          data: comparativaPreData,
          backgroundColor: ['#6366f1', '#f87171'],
          borderRadius: 8
        }]
      },
      options: {
        responsive: false,
        plugins: {
          legend: {
            display: false
          }
        },
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  }
  // Comparativa Post-Test (barras)
  if (typeof comparativaPostLabels !== 'undefined' && document.getElementById('graficoComparativaPost')) {
    const ctx = document.getElementById('graficoComparativaPost').getContext('2d');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: comparativaPostLabels,
        datasets: [{
          label: 'Segundo Cuestionario: ¿Conoces la importancia de la lactancia materna exclusiva?',
          data: comparativaPostData,
          backgroundColor: ['#34d399', '#fbbf24'],
          borderRadius: 8
        }]
      },
      options: {
        responsive: false,
        plugins: {
          legend: {
            display: false
          }
        },
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  }
  // Valoraciones (doughnut)
  if (typeof valoracionesLabels !== 'undefined' && document.getElementById('graficoValoraciones')) {
    const ctx = document.getElementById('graficoValoraciones').getContext('2d');
    new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: valoracionesLabels,
        datasets: [{
          label: 'Valoraciones',
          data: valoracionesData,
          backgroundColor: ['#fbbf24', '#7c3aed', '#a78bfa', '#6366f1', '#818cf8', '#f472b6']
        }]
      },
      options: {
        responsive: false
      }
    });
  }
  // Modal de ver respuestas en Cuestionario
  function closeModalRespuestas() {
    document.getElementById('modalRespuestas').style.display = 'none';
    document.body.style.overflow = '';
  }
function openModalRespuestas(respuestas) {
  const modal = document.getElementById('modalRespuestas');
  const cont = document.getElementById('modalPreguntasRespuestas');
  cont.innerHTML = '';
  respuestas.forEach((item, idx) => {
    const card = document.createElement('div');
    card.className = 'pregunta-respuesta-card';
    let html = `<div class="pregunta"><strong>${idx + 1}. ${item.pregunta}</strong></div>`;
    html += `<div class="respuesta">Respuesta: <span>${(item.respuesta || '').trim()}</span></div>`;
    card.innerHTML = html;
    cont.appendChild(card);
  });
  modal.style.display = 'flex';
  document.body.style.overflow = 'hidden';
}
  document.body.addEventListener('click', function(e) {
    if (e.target.closest('.ver-respuestas-btn')) {
      const btn = e.target.closest('.ver-respuestas-btn');
      let respuestas = btn.getAttribute('data-respuestas');
      try {
        respuestas = JSON.parse(respuestas);
      } catch { respuestas = []; }
      openModalRespuestas(respuestas);
    }
    if (e.target.classList.contains('close-modal')) {
      closeModalRespuestas();
    }
    if (e.target.id === 'modalRespuestas') {
      closeModalRespuestas();
    }
    // Cuestionario 2
    if (e.target.closest('.ver-respuestas2-btn')) {
      const btn = e.target.closest('.ver-respuestas2-btn');
      let respuestas = btn.getAttribute('data-respuestas');
      try {
        respuestas = JSON.parse(respuestas);
      } catch { respuestas = []; }
      openModalRespuestas2(respuestas);
    }
    if (e.target.classList.contains('close-modal2')) {
      closeModalRespuestas2();
    }
    if (e.target.id === 'modalRespuestas2') {
      closeModalRespuestas2();
    }
  });
});