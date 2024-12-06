document.addEventListener('DOMContentLoaded', () => {
    const serviciosContainer = document.getElementById('servicios-container');
    const agregarServicioBtn = document.getElementById('agregar-servicio');
    const importeTotalInput = document.getElementById('importe_total');

    // Función para actualizar campos relacionados con el servicio seleccionado
    function actualizarCampos(selectServicio) {
        const selectedOption = selectServicio.options[selectServicio.selectedIndex];
        const duracion = selectedOption.dataset.duracion || '';
        const precio = parseFloat(selectedOption.dataset.precio || 0);

        const servicioItem = selectServicio.closest('.servicio-item');
        const duracionSelect = servicioItem.querySelector('.duracion');
        const precioUnitarioInput = servicioItem.querySelector('.precio_unitario');
        const subtotalInput = servicioItem.querySelector('.precio');
        const cantidadInput = servicioItem.querySelector('.cantidad');

        // Actualizar duración
        if (duracionSelect) {
            duracionSelect.innerHTML = `<option value="${duracion}">${duracion} minutos</option>`;
            duracionSelect.value = duracion;
        }

        // Actualizar precio unitario
        if (precioUnitarioInput) {
            precioUnitarioInput.value = precio.toFixed(2);
        }

        // Calcular subtotal
        const cantidad = parseInt(cantidadInput.value) || 1;
        const subtotal = cantidad * precio;
        if (subtotalInput) {
            subtotalInput.value = subtotal.toFixed(2);
        }

        // Actualizar el importe total de la venta
        actualizarImporteTotal();
    }

    // Autocompletar duración y precio al seleccionar un servicio
    serviciosContainer.addEventListener('change', (event) => {
        if (event.target.classList.contains('servicio-nombre')) {
            actualizarCampos(event.target);
        }
    });

    // Actualizar precio total por servicio cuando cambia cantidad
    serviciosContainer.addEventListener('input', (event) => {
        if (event.target.classList.contains('cantidad')) {
            const servicioItem = event.target.closest('.servicio-item');
            actualizarPrecioTotal(servicioItem);
        }
    });

    // Añadir un nuevo servicio
    agregarServicioBtn.addEventListener('click', () => {
        const servicioItem = serviciosContainer.querySelector('.servicio-item');
        const nuevoServicio = servicioItem.cloneNode(true);

        // Asignar índices únicos a los nuevos elementos
        const index = serviciosContainer.children.length;

        // Clonar las opciones originales del select y reiniciar valores
        nuevoServicio.querySelectorAll('input, select').forEach(input => {
            const name = input.name;
            if (name) {
                input.name = name.replace(/\[0\]/, `[${index}]`);
            }

            if (input.tagName === 'SELECT' && input.classList.contains('servicio-nombre')) {
                const originalSelect = servicioItem.querySelector('.servicio-nombre');
                input.innerHTML = originalSelect.innerHTML; // Copiar las opciones originales
                input.value = ''; // Restablecer valor
            } else if (input.tagName === 'SELECT') {
                input.value = '';
                input.innerHTML = '<option value="">Seleccione una opción</option>';
            } else if (input.type === 'text') {
                input.value = '';
            } else if (input.type === 'number') {
                input.value = 1;
            }
        });

        serviciosContainer.appendChild(nuevoServicio);
    });

    // Función para actualizar el precio total por servicio
    function actualizarPrecioTotal(servicioItem) {
        const cantidad = parseInt(servicioItem.querySelector('.cantidad').value) || 0;
        const precioUnitario = parseFloat(servicioItem.querySelector('.precio_unitario').value) || 0;
        const precioTotalInput = servicioItem.querySelector('.precio');

        const precioTotal = cantidad * precioUnitario;
        precioTotalInput.value = precioTotal.toFixed(2);

        actualizarImporteTotal();
    }

    // Función para actualizar el importe total de la venta
    function actualizarImporteTotal() {
        let total = 0;
        document.querySelectorAll('.precio').forEach(input => {
            total += parseFloat(input.value) || 0;
        });
        importeTotalInput.value = total.toFixed(2);
    }

    // Precargar los datos existentes en el formulario (para edición)
    document.querySelectorAll('.servicio-nombre').forEach(select => {
        if (select.value) {
            actualizarCampos(select);
        }
    });
});
