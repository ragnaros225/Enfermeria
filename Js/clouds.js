//animar nubes aleatorias en dos capas: detrás y delante del contenido
const cloudImages = [
  'Img/nube1.png',
  'Img/nube2.png',
  'Img/nube3.png',
  'Img/nube4.png',
  'Img/nube5.png',
  'Img/nube6.png'
];

const NUM_CLOUDS = 24;

function randomBetween(a, b) {
  return Math.random() * (b - a) + a;
}

const cloudsBgBack = document.getElementById('clouds-bg-back');
const cloudsBgFront = document.getElementById('clouds-bg-front');
const clouds = [];

function createCloudRandomLayer() {
  // Decide aleatoriamente si la nube va en back o front
  const isBack = Math.random() < 0.5;
  const container = isBack ? cloudsBgBack : cloudsBgFront;
  const img = document.createElement('img');
  img.src = cloudImages[Math.floor(Math.random() * cloudImages.length)];
  img.className = 'cloud-bg';
  // Tamaño aleatorio
  const scale = randomBetween(isBack ? 0.5 : 0.7, isBack ? 1.1 : 1.3);
  img.style.width = `${180 * scale}px`;
  img.style.position = 'absolute';
  img.style.top = `${randomBetween(0, 90)}vh`;
  img.style.left = `${randomBetween(100, 120)}vw`;
  img.style.opacity = randomBetween(0.4, isBack ? 0.7 : 0.85);
  img.dataset.speed = randomBetween(isBack ? 0.03 : 0.04, isBack ? 0.09 : 0.13); // velocidad más lenta
  img.dataset.layer = isBack ? 'back' : 'front';
  container.appendChild(img);
  clouds.push(img);
}

for (let i = 0; i < NUM_CLOUDS; i++) {
  createCloudRandomLayer();
}

function animateClouds() {
  for (const cloud of clouds) {
    let left = parseFloat(cloud.style.left);
    left -= parseFloat(cloud.dataset.speed);
    if (left < -30) {
      // Reinicia la nube a la derecha y decide aleatoriamente la capa
      const isBack = Math.random() < 0.5;
      const container = isBack ? cloudsBgBack : cloudsBgFront;
      cloud.style.left = `${randomBetween(100, 120)}vw`;
      cloud.style.top = `${randomBetween(0, 90)}vh`;
      cloud.style.width = `${180 * randomBetween(isBack ? 0.5 : 0.7, isBack ? 1.1 : 1.3)}px`;
      cloud.style.opacity = randomBetween(0.4, isBack ? 0.7 : 0.85);
      cloud.src = cloudImages[Math.floor(Math.random() * cloudImages.length)];
      cloud.dataset.speed = randomBetween(isBack ? 0.03 : 0.04, isBack ? 0.09 : 0.13);
      cloud.dataset.layer = isBack ? 'back' : 'front';
      // Mover el elemento al nuevo contenedor si cambia de capa
      if ((isBack && cloud.parentElement !== cloudsBgBack) || (!isBack && cloud.parentElement !== cloudsBgFront)) {
        cloud.parentElement.removeChild(cloud);
        container.appendChild(cloud);
      }
    } else {
      cloud.style.left = `${left}vw`;
    }
  }
  requestAnimationFrame(animateClouds);
}

animateClouds();
