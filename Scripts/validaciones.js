// Permite solo letras (incluyendo acentos) y espacios al presionar teclas.
// Allows only letters (including accents) and spaces when typing.
function soloLetrasConAcentos(event) {
    const tecla = event.key;
    const regex = /^[a-zA-ZáéíóúàèìòùâêîôûãñõüïçÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÃÑÕÜÏÇ\s]$/;
    if (!regex.test(tecla)) {
        alert("Solo se permiten letras y caracteres con acentos especiales.");
        event.preventDefault();
    }
}

// Permite solo números y guiones (-) al presionar teclas.
// Allows only numbers and hyphens (-) when typing.
function soloNumerosYGuion(event) {
    const tecla = event.key;
    const regex = /^[0-9-]$/;
    if (!regex.test(tecla)) {
        alert("Solo se permiten números y el guion (-).");
        event.preventDefault();
    }
}

// Valida el formato de un número de teléfono (XXXX-XXXX).
// Validates the format of a phone number (XXXX-XXXX).
function validarTelefono(input) {
    const regex = /^\d{4}-\d{4}$/;

    if (regex.test(input.value)) {
        input.setCustomValidity('');
    } else {
        input.setCustomValidity('El teléfono debe tener el formato XXXX-XXXX');
    }
}

// Valida la entrada de caracteres permitidos para un código PEN.
// Validates allowed characters for a PEN code input.
function validarPEN(event, inputElement) {
    const tecla = event.key.toUpperCase();
    const allowedNumbers = /^[0-9]$/;

    inputElement.value = inputElement.value.toUpperCase();
    const valor = inputElement.value;

    const countP = (valor.match(/P/g) || []).length;
    const countE = (valor.match(/E/g) || []).length;
    const countN = (valor.match(/N/g) || []).length;
    const countGuion = (valor.match(/-/g) || []).length;

    if (allowedNumbers.test(tecla)) return;

    if (tecla === '-') {
        if (countGuion >= 2) {
            alert("Solo se permiten hasta dos guiones (-).");
            event.preventDefault();
        }
        return;
    }

    if (!['P', 'E', 'N'].includes(tecla)) {
        alert("Solo se permiten números, las letras P, E, N y guiones (-).");
        event.preventDefault();
        return;
    }

    const posibleValor = valor + tecla;
    if (/EN|EP|NP|NE|PN/.test(posibleValor)) {
        alert("No se permiten combinaciones EN, EP, NP, NE ni PN.");
        event.preventDefault();
        return;
    }

    if (tecla === 'P' && countP >= 1) {
        alert("La letra 'P' solo puede usarse una vez.");
        event.preventDefault();
    }

    if (tecla === 'N' && countN >= 1) {
        alert("La letra 'N' solo puede usarse una vez.");
        event.preventDefault();
    }

    if (tecla === 'E') {
        if (countE >= 2) {
            alert("La letra 'E' solo puede usarse hasta dos veces.");
            event.preventDefault();
        } else if (valor.startsWith('E') && countE >= 1) {
            alert("Si hay una 'E' al inicio, no se permite otra 'E' después.");
            event.preventDefault();
        }
    }
}

// Valida las reglas finales para un código PEN.
// Validates final rules for a PEN code.
function validarPENFinal(inputElement) {
    const valor = inputElement.value.toUpperCase();
    const posP = valor.indexOf('P');
    const countE = (valor.match(/E/g) || []).length;
    const countGuion = (valor.match(/-/g) || []).length;

    if (posP === -1) {
        alert("Debe incluir una letra 'P'.");
        return false;
    }

    const eDespuesDeP = valor.slice(posP + 1).includes('E');
    if (!eDespuesDeP) {
        alert("La letra 'P' debe tener al menos una 'E' después.");
        return false;
    }

    if (countE > 2) {
        alert("No se permiten más de dos letras 'E'.");
        return false;
    }

    if (countGuion > 3) {
        alert("No se permiten más de tres guiones (-).");
        return false;
    }

    return true;
}

// Valida un código PEN completo y pegado sin restricciones de entrada.
// Validates a complete and concatenated PEN code without input restrictions.
function validarPENPegado(inputElement) {
    const valor = inputElement.value.toUpperCase();

    if (!/^[0-9PEN-]*$/.test(valor)) {
        alert("Solo se permiten números, letras P, E, N y guiones (-).");
        return false;
    }

    const countGuion = (valor.match(/-/g) || []).length;
    if (countGuion > 2) {
        alert("No se permiten más de dos guiones (-).");
        return false;
    }

    if (/EN|EP|NP|NE|PN/.test(valor)) {
        alert("No se permiten combinaciones EN, EP, NP, NE ni PN.");
        return false;
    }

    const countP = (valor.match(/P/g) || []).length;
    const countE = (valor.match(/E/g) || []).length;
    const countN = (valor.match(/N/g) || []).length;

    if (countP > 1) {
        alert("La letra 'P' solo puede usarse una vez.");
        return false;
    }
    if (countN > 1) {
        alert("La letra 'N' solo puede usarse una vez.");
        return false;
    }
    if (countE > 2) {
        alert("La letra 'E' solo puede usarse hasta dos veces.");
        return false;
    }

    if (valor.startsWith('E') && countE > 1) {
        alert("Si hay una 'E' al inicio, no se permite otra 'E' después.");
        return false;
    }

    const posP = valor.indexOf('P');
    if (posP !== -1) {
        const eDespuesDeP = valor.slice(posP + 1).includes('E');
        if (!eDespuesDeP) {
            alert("La letra 'P' debe tener al menos una 'E' después.");
            return false;
        }
    }

    return true;
}

// Valida si un correo electrónico tiene un formato válido.
// Validates if an email has a valid format.
function validarEmail(inputElement) {
    const emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    const valor = inputElement.value.trim();

    if (valor === "") return;

    if (!emailRegex.test(valor)) {
        alert("Por favor, ingrese un correo electrónico válido.");
        inputElement.value = "";
        inputElement.focus();
    }
} 

// Convierte la primera letra de un texto a mayúscula.
// Converts the first letter of a text to uppercase.
function primeraLetraMayuscula(inputElement) {
    const valor = inputElement.value;
    if (valor.length === 0) return;
    inputElement.value = valor.charAt(0).toUpperCase() + valor.slice(1);
}
