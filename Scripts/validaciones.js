document.addEventListener("DOMContentLoaded", function () {
    const soloLetrasIds = [
        "nombre1", "nombre2", "apellido1", "apellido2", "apellido_casada"
    ];
    const soloNumerosIds = [
        "cedula", "telefono"
    ];
    const formulario = document.getElementById("formulario");

    function mostrarError(campo, mensaje, valido) {
        let errorSpan = campo.nextElementSibling;
        if (!errorSpan || !errorSpan.classList.contains("error-feedback")) {
            errorSpan = document.createElement("div");
            errorSpan.classList.add("error-feedback");
            campo.parentNode.appendChild(errorSpan);
        }

        if (valido) {
            campo.classList.remove("is-invalid");
            errorSpan.textContent = "";
        } else {
            campo.classList.add("is-invalid");
            errorSpan.textContent = mensaje;
            errorSpan.style.color = "red";
            errorSpan.style.fontSize = "0.85rem";
            errorSpan.style.marginTop = "5px";
        }
    }

    function validarCampo(campo, tipo) {
        const valor = campo.value;
        let limpio = "";
        let valido = true;

        if (tipo === "letras") {
            limpio = valor.replace(/[^a-zA-Z\u00E1\u00E9\u00ED\u00F3\u00FA\u00C1\u00C9\u00CD\u00D3\u00DA\u00F1\u00D1\u00FC\u00DC\s]/g, "");
            valido = valor === limpio;
            campo.value = limpio;
            mostrarError(campo, "Solo se permiten letras, espacios y diéresis (ü).", valido);
        }        
        
        if (tipo === "numeros") {
            limpio = valor.replace(/[^0-9\-]/g, "");
            valido = valor === limpio;
            campo.value = limpio;
            mostrarError(campo, "Solo se permiten números y guiones.", valido);
        }

        return valido;
    }

    // Validación en tiempo real
    soloLetrasIds.forEach(id => {
        const campo = document.getElementById(id);
        if (campo) {
            campo.addEventListener("input", () => validarCampo(campo, "letras"));
        }
    });

    soloNumerosIds.forEach(id => {
        const campo = document.getElementById(id);
        if (campo) {
            campo.addEventListener("input", () => validarCampo(campo, "numeros"));
        }
    });

    // Validación al enviar el formulario
    if (formulario) {
        formulario.addEventListener("submit", function (e) {
            let esValido = true;
            let primerCampoInvalido = null;

            soloLetrasIds.forEach(id => {
                const campo = document.getElementById(id);
                if (campo && !validarCampo(campo, "letras")) {
                    esValido = false;
                    if (!primerCampoInvalido) primerCampoInvalido = campo;
                }
            });

            soloNumerosIds.forEach(id => {
                const campo = document.getElementById(id);
                if (campo && !validarCampo(campo, "numeros")) {
                    esValido = false;
                    if (!primerCampoInvalido) primerCampoInvalido = campo;
                }
            });

            if (!esValido) {
                e.preventDefault();
                primerCampoInvalido.focus();
            }
        });
    }
});

