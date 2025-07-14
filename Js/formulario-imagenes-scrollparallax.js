// Parallax scroll para imágenes: estetoscopio baja, vacuna y frasco suben
function parallaxImagenesScroll() {
  const estetoscopio = document.querySelector('.img-estetoscopio');
  const frasco = document.querySelector('.img-frasco');
  const vacuna = document.querySelector('.img-vacuna');
  const scrollY = window.scrollY || window.pageYOffset;
  const wh = window.innerHeight;

  // Estetoscopio: baja suavemente
  if (estetoscopio) {
    const base = 0;
    const factor = 0.25; // velocidad
    const offset = Math.min(scrollY * factor, 120);
    estetoscopio.style.transform = `translateY(${base + offset}px) scale(1.12) rotate(-2deg)`;
    estetoscopio.style.opacity = 1;
    estetoscopio.style.filter = 'drop-shadow(0 8px 32px #AEE9FF99)';
  }
  // Vacuna: baja suavemente (igual que estetoscopio)
  if (vacuna) {
    const base = -40; // Empieza más arriba
    const factor = 0.22;
    const offset = Math.min(scrollY * factor, 120);
    vacuna.style.transform = `translateY(${base + offset}px) scale(1.12) rotate(-2deg)`;
    vacuna.style.opacity = 1;
    vacuna.style.filter = 'drop-shadow(0 8px 32px #AEE9FF99)';
  }
  // Frasco: sube más cuando el scroll es mayor
  if (frasco) {
    const frascoRect = frasco.getBoundingClientRect();
    const base = 0;
    const factor = 0.18;
    let offset = 0;
    if (frascoRect.top < wh) {
      offset = Math.max((wh - frascoRect.top) * factor, 0);
    }
    frasco.style.transform = `translateY(${-offset}px) scale(1.12) rotate(-2deg)`;
    frasco.style.opacity = 1;
    frasco.style.filter = 'drop-shadow(0 8px 32px #AEE9FF99)';
  }
}
window.addEventListener('scroll', parallaxImagenesScroll);
window.addEventListener('DOMContentLoaded', parallaxImagenesScroll);
