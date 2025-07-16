function showTab(tab) {
  const tabs = ['dashboard', 'usuarios', 'pretest', 'posttest', 'valoraciones'];
  tabs.forEach(function(t) {
    document.getElementById('tab-' + t).style.display = (t === tab) ? 'block' : 'none';
  });
  const btns = document.querySelectorAll('.tab-btn:not(.logout-tab)');
  btns.forEach(function(btn, idx) {
    btn.classList.toggle('active', tabs[idx] === tab);
  });
}
