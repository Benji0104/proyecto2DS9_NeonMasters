function soloLetrasConAcentos(event) {
    const tecla = event.key;
    const regex = /^[a-zA-ZáéíóúàèìòùâêîôûãñõüïçÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÃÑÕÜÏÇ\s]$/;
    if (!regex.test(tecla)) {
        alert("Solo se permiten letras y caracteres con acentos especiales.");
        event.preventDefault();
    }
}

function soloNumerosYGuion(event) {
    const tecla = event.key;
    const regex = /^[0-9-]$/;
    if (!regex.test(tecla)) {
        alert("Solo se permiten números y el guion (-).");
        event.preventDefault();
    }
}


function validarTelefono(input) {
    // Expresión regular para formato 4 dígitos - 4 dígitos
    const regex = /^\d{4}-\d{4}$/;

    if (regex.test(input.value)) {
        input.setCustomValidity(''); // válido
    } else {
        input.setCustomValidity('El teléfono debe tener el formato XXXX-XXXX');
    }
}

function validarPEN(event, inputElement) {
    const tecla = event.key.toUpperCase();
    const allowedNumbers = /^[0-9]$/;

    // Convertir y mantener en mayúsculas
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

function validarPENPegado(inputElement) {
    const valor = inputElement.value.toUpperCase();

    // Validar solo caracteres permitidos: números, P, E, N, y hasta 3 guiones
    if (!/^[0-9PEN-]*$/.test(valor)) {
        alert("Solo se permiten números, letras P, E, N y guiones (-).");
        return false;
    }

    // Validar cantidad de guiones
    const countGuion = (valor.match(/-/g) || []).length;
    if (countGuion > 2) {
        alert("No se permiten más de dos guiones (-).");
        return false;
    }

    // Validar que no existan combinaciones prohibidas
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

    // Validar E al inicio y que no haya más después
    if (valor.startsWith('E') && countE > 1) {
        alert("Si hay una 'E' al inicio, no se permite otra 'E' después.");
        return false;
    }

    // Validar que P tenga al menos una E después
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

function validarEmail(inputElement) {
    const emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    const valor = inputElement.value.trim();

    if (valor === "") return; // No validar si está vacío (el atributo required lo manejará)

    if (!emailRegex.test(valor)) {
        alert("Por favor, ingrese un correo electrónico válido.");
        inputElement.value = "";
        inputElement.focus();
    }
} 

function primeraLetraMayuscula(inputElement) {
    const valor = inputElement.value;
    if (valor.length === 0) return;
    inputElement.value = valor.charAt(0).toUpperCase() + valor.slice(1);
}
