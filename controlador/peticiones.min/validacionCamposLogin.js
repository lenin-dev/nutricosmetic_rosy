'use strict';
verificacion();

// Verifica si hay campos vacios en el form
function verificacion() {
    // Obtine el nombre de la clase de todo el form
    const forms = document.querySelectorAll(".needs-validation");
  
    // Separa con from todo el forms para verificar los inputs
    Array.from(forms).forEach((form) => {
      form.addEventListener(
        "submit",
        (event) => {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add("was-validated");
        },false);
    });
  }