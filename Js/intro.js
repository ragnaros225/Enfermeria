// Animar el tamaño del video mientras se reproduce
window.addEventListener('DOMContentLoaded', function() {
  const introVideo = document.getElementById('intro-video');
  const introScreen = document.getElementById('intro-screen');
  let animationFrameId;
  function animateVideoShrink() {
    const duration = introVideo.duration || 4; // segundos, fallback 4s
    const startW = 90, startH = 90, endW = 30, endH = 30; // porcentajes
    function step() {
      if (introVideo.paused || introVideo.ended) return;
      const t = introVideo.currentTime / duration;
      const w = startW + (endW - startW) * t;
      const h = startH + (endH - startH) * t;
      introVideo.style.maxWidth = w + 'vw';
      introVideo.style.maxHeight = h + 'vh';
      animationFrameId = requestAnimationFrame(step);
    }
    step();
  }
  function showMainContent() {
    cancelAnimationFrame(animationFrameId);
    introScreen.style.display = 'none';
    document.getElementById('main-content').style.display = 'block';
  }
  if (introVideo) {
    introVideo.addEventListener('play', animateVideoShrink);
    introVideo.addEventListener('ended', showMainContent);
  }
  if (introScreen) {
    introScreen.addEventListener('click', showMainContent);
  }
  setTimeout(showMainContent, 4000);
});