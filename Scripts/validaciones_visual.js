 document.addEventListener('DOMContentLoaded', function () {
    const visorContainer = document.getElementById('visor-iframe-container');
    const iframe = document.getElementById('visor-iframe');
    const btnCerrar = document.getElementById('cerrar-visor');
    const btnEliminar = document.getElementById('eliminar-archivo');
    let botonActual = null; // Referencia al botón que abrió el visor

    // Mostrar visor al hacer clic en "Ver archivo"
    document.querySelectorAll('.ver-archivo-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation(); // Evita que el clic se propague al document
            const url = btn.dataset.url;
            iframe.src = url;
            visorContainer.style.display = 'block';
            iframe.scrollIntoView({ behavior: 'smooth' });
            botonActual = btn; // Guardamos el botón activo para saber cuál eliminar luego
        });
    });

    // Cerrar visor con botón ❌
    btnCerrar.addEventListener('click', function () {
        visorContainer.style.display = 'none';
        iframe.src = '';
    });

    // Cerrar visor al hacer clic fuera del contenedor
    document.addEventListener('click', function (e) {
        if (visorContainer.style.display === 'block' && !visorContainer.contains(e.target)) {
            visorContainer.style.display = 'none';
            iframe.src = '';
        }
    });
});