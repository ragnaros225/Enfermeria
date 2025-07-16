// Mostrar el main-content-wrapper en vez de main-content
document.addEventListener('DOMContentLoaded', function() {
  var mainContent = document.getElementById('main-content');
  var mainContentWrapper = document.getElementById('main-content-wrapper');
  if (mainContent) mainContent.style.display = 'none';
  if (mainContentWrapper) mainContentWrapper.style.display = 'block';
});