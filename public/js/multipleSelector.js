class MultipleSelector {
    constructor() {
        this.selectedContainer = document.getElementById('selected-direcciones-container');
        this.countElement = document.getElementById('count-selected');
        this.availableContainer = document.getElementById('available-direcciones-container');
        
        this.initEvents();
        this.updateCounter();
    }

    initEvents() {
        // Delegación de eventos para mejor performance
        this.availableContainer.addEventListener('click', (e) => {
            const addButton = e.target.closest('.add-item');
            if (addButton) {
                this.addItem(
                    addButton.dataset.id,
                    addButton.dataset.name
                );
            }
        });

        this.selectedContainer.addEventListener('click', (e) => {
            const removeButton = e.target.closest('.remove-item');
            if (removeButton) {
                this.removeItem(removeButton.closest('.selected-item'));
            }
        });
    }

    addItem(id, name) {
        // Verificar si ya existe
        if (document.querySelector(`input[value="${id}"]`)) return;

        // Crear nuevo elemento
        const item = document.createElement('div');
        item.className = 'selected-item';
        item.innerHTML = `
            <span class="badge mb-2 p-2 d-flex align-items-center" style="background-color: #66BB6A;">
                ${name}
                <input type="hidden" name="direcciones_ids[]" value="${id}">
                <button type="button" class="btn-close btn-close-white ms-2 remove-item"></button>
            </span>
        `;

        // Eliminar mensaje de "no seleccionadas" si existe
        if (this.selectedContainer.querySelector('.text-muted')) {
            this.selectedContainer.innerHTML = '';
        }

        this.selectedContainer.appendChild(item);
        this.updateCounter();
    }

    removeItem(item) {
        item.remove();
        this.updateCounter();
        
        // Mostrar mensaje si no hay seleccionados
        if (this.selectedContainer.children.length === 0) {
            this.selectedContainer.innerHTML = '<div class="text-muted py-3 text-center">No hay direcciones seleccionadas</div>';
        }
    }

    updateCounter() {
        const count = document.querySelectorAll('input[name="direcciones_ids[]"]').length;
        this.countElement.textContent = count;
    }
}

// Inicialización
document.addEventListener('DOMContentLoaded', () => {
    new MultipleSelector();
});