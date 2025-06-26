// Configuración inicial
document.addEventListener('DOMContentLoaded', function() {
  // Inicializar PDF.js
  pdfjsLib.GlobalWorkerOptions.workerSrc = 
    'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.worker.min.js';

  // Elementos del DOM
  const canvas = document.getElementById('pdfCanvas'),
        ctx = canvas.getContext('2d'),
        pageCount = document.getElementById('pageCount'),
        prevBtn = document.getElementById('prevPage'),
        nextBtn = document.getElementById('nextPage');

  let pdfDoc = null,
      pageNum = 1,
      pageRendering = false;

  // Cargar PDF
  function loadPDF() {
    const pdfPath = 'docs/guia.pdf'; // Ajusta esta ruta

    // Cambia esta línea:
    // pdfjsLib.getDocument(pdfPath).promise.then(pdf => {
    // Por esto:
    pdfjsLib.getDocument({
      url: pdfPath,
      disableAutoFetch: true,
      disableStream: true
    }).promise.then(pdf => {
      pdfDoc = pdf;
      pageCount.textContent = `Página 1 de ${pdf.numPages}`;
      renderPage(1);
    }).catch(error => {
      console.error("Error al cargar el PDF:", error);
      pageCount.textContent = "PDF no disponible";
      canvas.style.background = "#f8f9fa";
      canvas.innerHTML = `
        <div style="padding:20px;color:#dc3545;text-align:center">
          <p>No se pudo cargar el PDF</p>
          <small>Verifica que el archivo exista en: ${pdfPath}</small>
        </div>
      `;
    });
  }

  // Renderizar página
  function renderPage(num) {
    pageRendering = true;
    pdfDoc.getPage(num).then(page => {
      const viewport = page.getViewport({ scale: 1.5 });
      canvas.height = viewport.height;
      canvas.width = viewport.width;

      const renderContext = {
        canvasContext: ctx,
        viewport: viewport
      };

      page.render(renderContext).promise.then(() => {
        pageRendering = false;
      });
    });
  }

  // Navegación
  function onPrevPage() {
    if (pageNum <= 1) return;
    pageNum--;
    renderPage(pageNum);
    pageCount.textContent = `Página ${pageNum} de ${pdfDoc.numPages}`;
  }

  function onNextPage() {
    if (pageNum >= pdfDoc.numPages) return;
    pageNum++;
    renderPage(pageNum);
    pageCount.textContent = `Página ${pageNum} de ${pdfDoc.numPages}`;
  }

  // Eventos
  prevBtn.addEventListener('click', onPrevPage);
  nextBtn.addEventListener('click', onNextPage);

  // Navegación con teclado
  document.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowLeft') onPrevPage();
    if (e.key === 'ArrowRight') onNextPage();
  });

  // Iniciar
  loadPDF();
});