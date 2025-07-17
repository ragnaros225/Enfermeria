function showTab(tab) {
const tabs = ['dashboard', 'usuarios', 'pretest', 'posttest', 'valoraciones', 'cuestionario', 'cuestionario2'];
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
});