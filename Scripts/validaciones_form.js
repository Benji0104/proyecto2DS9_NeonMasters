/**
 * Referencia al formulario con ID "formulario" para validación.
 * Reference to the form with ID "formulario" for validation.
 */
document.addEventListener("DOMContentLoaded", function () {
    const formulario = document.getElementById("formulario");
    formulario.onsubmit = function () {
        return validarPEFinal(document.getElementById("cedula"));
    };
});

/**
 * Actualiza la visibilidad del campo "Apellido de Casada" según el sexo y estado civil seleccionados.
 * Updates the visibility of the "Married Last Name" field based on the selected gender and marital status.
 */
document.addEventListener("DOMContentLoaded", function () {
    const sexo = document.getElementById("sexo");
    const estado = document.getElementById("estado");
    const apellidoCasadaContainer = document.getElementById("apellidoCasadaContainer");
    const usaApellidoCasada = document.getElementById("usa_apellido_casada");
    const apellidoCasadaInput = document.getElementById("apellido_casada");

    function actualizarCampoCasada() {
        if (sexo.value === "Femenino" && estado.value === "Casado") {
            apellidoCasadaContainer.style.display = "block";
        } else {
            apellidoCasadaContainer.style.display = "none";
            usaApellidoCasada.checked = false;
            apellidoCasadaInput.value = '';
        }
    }

    sexo.addEventListener("change", actualizarCampoCasada);
    estado.addEventListener("change", actualizarCampoCasada);
});

 /**
 * Busca un distrito en la lista de distritos de la provincia que coincida con el valor seleccionado.
 * Finds a district in the province's district list that matches the selected value.
 */
document.addEventListener("DOMContentLoaded", function () {
    const provinciasSelect = document.getElementById("provincia");
    const distritoSelect = document.getElementById("distrito");
    const corregimientoSelect = document.getElementById("corregimiento");

    fetch("../Assets/data/provincias.json")
        .then(response => response.json())
        .then(data => {
            data.provincia.forEach(prov => {
                const option = document.createElement("option");
                option.value = prov.nombre;
                option.textContent = prov.nombre;
                provinciasSelect.appendChild(option);
            });

            provinciasSelect.addEventListener("change", () => {
                distritoSelect.innerHTML = '<option value="">Selecciona</option>';
                corregimientoSelect.innerHTML = '<option value="">Selecciona</option>';

                const provincia = data.provincia.find(p => p.nombre === provinciasSelect.value);
                if (provincia) {
                    provincia.distrito.forEach(dist => {
                        const option = document.createElement("option");
                        option.value = dist.nombre;
                        option.textContent = dist.nombre;
                        distritoSelect.appendChild(option);
                    });
                }
            });

            distritoSelect.addEventListener("change", () => {
                corregimientoSelect.innerHTML = '<option value="">Selecciona</option>';
                const provincia = data.provincia.find(p => p.nombre === provinciasSelect.value);
                if (provincia) {
                    const distrito = provincia.distrito.find(d => d.nombre === distritoSelect.value);
                    if (distrito) {
                        distrito.corregimientos.forEach(correg => {
                            const option = document.createElement("option");
                            option.value = correg;
                            option.textContent = correg;
                            corregimientoSelect.appendChild(option);
                        });
                    }
                }
            });
        })
        .catch(error => {
            console.error("Error al cargar provincias.json:", error);
        });
});

// Calcula la edad en tiempo real al cambiar la fecha de nacimiento.
// Calculates the age in real-time when the birth date is changed.
document.getElementById('nacimiento').addEventListener('change', function () {
    const fechaNacimiento = new Date(this.value);
    const hoy = new Date();
    let edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
    const m = hoy.getMonth() - fechaNacimiento.getMonth();
    if (m < 0 || (m === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
        edad--;
    }
    document.getElementById('edad').value = edad;
});

// Bloques dinámicos para agregar y quitar datos académicos.
// Dynamic blocks to add and remove academic data.
document.addEventListener("DOMContentLoaded", function () {
    let contador = 1;

    const bloqueAcademico = document.getElementById("bloque-academico");
    const agregarBtn = document.getElementById("agregarTitulo");
    const quitarBtn = document.getElementById("quitarTitulo");

    // Inicializa el botón para quitar bloques.
    // Initializes the button to remove blocks.
    actualizarBotonQuitar();

    agregarBtn.addEventListener("click", function () {
        contador++;

        const bloque = document.createElement("div");
        bloque.classList.add("row", "g-3", "bloque-titulo", "align-items-end", "mt-3");

        bloque.innerHTML = `
            <div class="col-md-8">
                <label for="titulo_${contador}" class="form-label">Nombre del Título</label>
                <input type="text" id="titulo_${contador}" name="titulo[]" class="form-control titulo-input" required>
            </div>
            <div class="col-md-3">
                <label for="archivo_${contador}" class="form-label">Seleccionar Archivo</label>
                <input type="file" id="archivo_${contador}" name="archivo[]" class="form-control archivo-input" accept=".pdf,.jpg,.png" required>
            </div>
            <div class="col-md-1 text-end">
                <button type="button" class="btn btn-danger btn-sm eliminar-bloque" title="Eliminar bloque">🗑</button>
            </div>
        `;

        bloqueAcademico.appendChild(bloque);
        actualizarBotonQuitar();
    });

    quitarBtn.addEventListener("click", function () {
        const bloques = bloqueAcademico.getElementsByClassName("bloque-titulo");
        if (bloques.length > 1) {
            bloqueAcademico.removeChild(bloques[bloques.length - 1]);
            contador--;
            actualizarBotonQuitar();
        } else {
            alert("Debe haber al menos un título.");
        }
    });

    // Elimina un bloque individual con el botón interno.
    // Deletes an individual block using the internal button.
    bloqueAcademico.addEventListener("click", function (event) {
        if (event.target.classList.contains("eliminar-bloque")) {
            const bloques = bloqueAcademico.getElementsByClassName("bloque-titulo");
            if (bloques.length > 1) {
                const bloque = event.target.closest(".bloque-titulo");
                bloque.remove();
                contador--;
                actualizarBotonQuitar();
            } else {
                alert("Debe haber al menos un título.");
            }
        }
    });

    // Valida letras con acentos en los inputs de títulos.
    // Validates accented letters in title inputs.
    bloqueAcademico.addEventListener("keypress", function(event) {
        if (event.target.classList.contains("titulo-input")) {
            soloLetrasConAcentos(event); // asegúrate de tener esta función definida
        }
    });

    // Desactiva el botón quitar si solo queda un bloque.
    // Disables the remove button if only one block remains.
    function actualizarBotonQuitar() {
        const bloques = bloqueAcademico.getElementsByClassName("bloque-titulo");
        quitarBtn.disabled = bloques.length <= 1;
    }
});

/**
 * Bloquea la entrada de texto y pegado en el campo de fecha de nacimiento.
 * Prevents text input and pasting in the birth date field.
 */
function bloquearEntradaNacimiento() {
    const nacimientoInput = document.getElementById("nacimiento");
    if (!nacimientoInput) return;

    nacimientoInput.addEventListener("keydown", function(e) {
        e.preventDefault();
    });

    nacimientoInput.addEventListener("paste", function(e) {
        e.preventDefault();
    });
}

// Ejecutar la función bloquearEntradaNacimiento cuando el DOM esté completamente cargado.
// Execute the bloquearEntradaNacimiento function when the DOM is fully loaded.
document.addEventListener("DOMContentLoaded", function() {
    bloquearEntradaNacimiento();
});

