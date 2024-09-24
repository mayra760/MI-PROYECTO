function filtrarPorColor(t){document.querySelectorAll(".categoria").forEach((o=>{const l=o.getAttribute("data-color");o.style.display="todos"===t||l===t?"block":"none"}))}function filtrarPorTalla(t){document.querySelectorAll(".categoria").forEach((o=>{const l=o.getAttribute("data-talla");o.style.display="todos"===t||l===t?"block":"none"}))}

