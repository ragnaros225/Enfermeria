document.addEventListener("DOMContentLoaded", function () {
    // Intenta leer el ID desde la URL
    const params = new URLSearchParams(window.location.search);
    let id_usuario = params.get("id_usuario");

    // Si no está en la URL, intenta desde localStorage
    if (!id_usuario) {
        id_usuario = localStorage.getItem("id_usuario");
    }

    // Si aún no hay id_usuario, no hagas nada
    if (!id_usuario) return;

    // Crear el botón
    const btn = document.createElement("button");
    btn.textContent = "Responder Post-Test";
    btn.style.padding = "12px 20px";
    btn.style.backgroundColor = "#007BFF";
    btn.style.color = "#fff";
    btn.style.border = "none";
    btn.style.borderRadius = "6px";
    btn.style.cursor = "pointer";
    btn.style.marginTop = "40px";

    btn.onclick = () => {
        window.location.href = `posttest.php?id_usuario=${id_usuario}`;
    };

    // Insertarlo al final del contenido principal o body
    const main = document.querySelector("main") || document.body;
    main.appendChild(btn);
});
