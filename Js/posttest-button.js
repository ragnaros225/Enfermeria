document.addEventListener("DOMContentLoaded", function() {
    const params = new URLSearchParams(window.location.search);
    let id_usuario = params.get("id_usuario") || localStorage.getItem("id_usuario");
    
    if (!id_usuario) {
        console.log("No se encontró id_usuario");
        return; // No hacer nada si no hay ID
    }

    // Guarda en localStorage para futuras visitas
    localStorage.setItem("id_usuario", id_usuario);

    // Crea el botón (igual que antes)
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

    // Agrega el botón al final del main
    const main = document.querySelector("main") || document.body;
    main.appendChild(btn);
});