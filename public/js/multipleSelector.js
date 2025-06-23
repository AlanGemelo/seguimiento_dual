class MultipleSelectior {
    constructor() {
        this.selectedContainer = document.getElementById('selected-direcciones-container');
        this.countSelected = document.getElementById('count-selected');
        this.availableContainer = document.getElementById('available-direcciones-container');

        this.initEvents();
        this.updateCounter();
    }

    initEvents() {
        // Delegación de eventos para mejor performance
        this.availableContainer.addEventListener('click', (e) => {
            if (e.target.closest('.add-item')) {
                const button = e.target.closest('.add-item');
                this.addDireccion(
                    button.getAttribute('data-id'),
                    button.getAttribute('data-name'),
                    button
                );
            }
        });

        this.selectedContainer.addEventListener('click', (e) => {
            if (e.target.closest('.remove-item')) {
                const item = e.target.closest('.selected-item');
                this.removeItem(item);
            }
        });

        // Opcional: Doble click para agregar
        this.availableContainer.addEventListener('dblclick', (e) => {
            const item = e.target.closest('.list-group-item');
            if (item) {
                const button = item.querySelector('.add-item');
                if (button) button.click();
            }
        });
    }

    addDireccion(id, name, button) {
        if (!document.querySelector(`input[value="${id}"]`)) {
            const item = document.createElement('div');
            item.className = 'selected-item';
            item.innerHTML = `
              <span class="badge mb-2 p-2 d-flex align-items-center text-white" style="background-color: #66BB6A; width: min-content;">
                    ${name}
                    <input type="hidden" name="direcciones_ids[]" value="${id}">
                    <button type="button" class="btn-close btn-close-white ms-1 remove-item" aria-label="Remover"></button>
                </span>
            `;

            if (this.selectedContainer.firstChild?.classList?.contains('text-muted')) {
                this.selectedContainer.innerHTML = '';
            }

            this.selectedContainer.appendChild(item);
            this.updateCounter();
            this.showFeedback(button);
        }
    }

    removeItem(item) {
        item.remove();
        this.updateCounter();

        if (this.selectedContainer.children.length === 0) {
            this.selectedContainer.innerHTML = '<div class="text-muted">No hay direcciones seleccionadas</div>';
        }
    }

    updateCounter() {
        const selectedCount = document.querySelectorAll('input[name="direcciones_ids[]"]').length;
        this.countSelected.textContent = selectedCount;
    }

    showFeedback(button) {
        if (button) {
            const originalHTML = button.innerHTML;
            const originalClass = button.className;

            button.innerHTML = '<i class="fas fa-check"></i> Seleccionado';
            button.className = button.className.replace('btn-primary', 'btn-success');
            button.disabled = true;

            setTimeout(() => {
                button.innerHTML = originalHTML;
                button.className = originalClass;
                button.disabled = false;
            }, 1500);
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new MultipleSelectior();
});
