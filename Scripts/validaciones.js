document.addEventListener("DOMContentLoaded", function () {
    const soloLetrasIds = [
        "nombre1", "nombre2", "apellido1", "apellido2", "apellido_casada"
    ];
    const soloNumerosIds = [
        "telefono"
    ];
    const campoCedulaId = "cedula";
    const camposObligatorios = ["cedula", "telefono", "nombre1", "apellido1"];
    const formulario = document.getElementById("formulario");

    function mostrarError(campo, valido) {
        let errorSpan = campo.parentNode.querySelector(".error-feedback");
        if (!errorSpan) {
            errorSpan = document.createElement("div");
            errorSpan.classList.add("error-feedback");
            campo.parentNode.appendChild(errorSpan);
        }

        if (valido) {
            campo.classList.remove("is-invalid");
            errorSpan.textContent = "";
        } else {
            campo.classList.add("is-invalid");
            errorSpan.textContent = "Entrada inválida.";
            errorSpan.style.color = "red";
            errorSpan.style.fontSize = "0.85rem";
            errorSpan.style.marginTop = "5px";
        }
    }

    function mostrarContador(campo) {
        let contadorSpan = campo.parentNode.querySelector(".char-count");
        if (!contadorSpan) {
            contadorSpan = document.createElement("span");
            contadorSpan.classList.add("char-count");
            contadorSpan.style.marginLeft = "10px";
            contadorSpan.style.fontSize = "0.8rem";
            campo.parentNode.appendChild(contadorSpan);
        }
        contadorSpan.textContent = `(${campo.value.length})`;
    }

    function validarCampo(campo, tipo) {
        let valor = campo.value;
        let valido = true;

        if (tipo === "letras") {
            const regex = /^[\p{L}\p{M}\s]+$/u;
            valido = regex.test(valor);
        }

        if (tipo === "numeros") {
            valor = valor.replace(/[^0-9\-]/g, "");
            valido = campo.value === valor;
        }

        if (tipo === "cedula") {
            valor = valor.toUpperCase().replace(/[^0-9PEN\-]/g, "");
            const letras = (valor.match(/[PEN]/g) || []);
            valido = /^[0-9PEN\-]*$/.test(valor) && letras.length <= 1;
        }

        campo.value = valor;
        mostrarError(campo, valido);
        mostrarContador(campo);
        return valido;
    }

    function impedirAvanceSiInvalido(campo, tipo) {
        campo.addEventListener("blur", function () {
            const valido = validarCampo(campo, tipo);
            if (!valido) campo.focus();
        });
    }

    // Validación en tiempo real para nombres y apellidos
    soloLetrasIds.forEach(id => {
        const campo = document.getElementById(id);
        if (campo) {
            campo.addEventListener("input", () => validarCampo(campo, "letras"));
        }
    });

    // Validación en tiempo real para los campos de título
    const camposTitulo = document.querySelectorAll(".titulo-input");
    camposTitulo.forEach(campo => {
        campo.addEventListener("input", () => validarCampo(campo, "letras"));
    });

    // Validación en tiempo real para números
    soloNumerosIds.forEach(id => {
        const campo = document.getElementById(id);
        if (campo) {
            campo.addEventListener("input", () => validarCampo(campo, "numeros"));
        }
    });

    // Validación en tiempo real para cédula
    const cedulaCampo = document.getElementById(campoCedulaId);
    if (cedulaCampo) {
        cedulaCampo.addEventListener("input", () => validarCampo(cedulaCampo, "cedula"));
    }

    // Prevenir blur si no es válido (campos obligatorios)
    camposObligatorios.forEach(id => {
        const campo = document.getElementById(id);
        if (campo) {
            let tipo = "letras";
            if (id === "cedula") tipo = "cedula";
            else if (id === "telefono") tipo = "numeros";
            impedirAvanceSiInvalido(campo, tipo);
        }
    });

    // Validación al enviar
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

            camposTitulo.forEach(campo => {
                if (!validarCampo(campo, "letras")) {
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

            if (cedulaCampo && !validarCampo(cedulaCampo, "cedula")) {
                esValido = false;
                if (!primerCampoInvalido) primerCampoInvalido = cedulaCampo;
            }

            if (!esValido) {
                e.preventDefault();
                primerCampoInvalido.focus();
            }
        });
    }
});


