document.addEventListener('DOMContentLoaded', function() {
    const tagsContainer = document.getElementById('tagsContainer');
    const addTagButton = document.getElementById('addTagButton');

    function createTagRow() {
        const row = document.createElement('div');
        row.classList.add('flex', 'items-center', 'gap-4', 'mb-2');

        // Name Field
        const nameInput = document.createElement('input');
        nameInput.type = 'text';
        nameInput.name = 'room_parameters[][name]';
        nameInput.placeholder = 'Parameter Name';
        nameInput.classList.add('form-input', 'border', 'rounded-md', 'p-2', 'w-1/3');

        // Type Dropdown
        const typeSelect = document.createElement('select');
        typeSelect.name = 'room_parameters[][type]';
        typeSelect.classList.add('form-select', 'border', 'rounded-md', 'p-2', 'w-1/3');

        const options = ['String', 'Number', 'Boolean'];
        options.forEach(option => {
            const opt = document.createElement('option');
            opt.value = option.toLowerCase();
            opt.textContent = option;
            typeSelect.appendChild(opt);
        });

        // Value Field (default to text input)
        let valueInput = document.createElement('input');
        valueInput.type = 'text';
        valueInput.name = 'room_parameters[][value]';
        valueInput.classList.add('form-input', 'border', 'rounded-md', 'p-2', 'w-1/3');

        // Remove Button
        const removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.textContent = '✖';
        removeButton.classList.add('px-2', 'py-1', 'bg-red-500', 'text-white', 'rounded-md');

        removeButton.addEventListener('click', () => row.remove());

        // Change input type based on selection
        typeSelect.addEventListener('change', function() {
            if (this.value === 'string') {
                valueInput.type = 'text';
            } else if (this.value === 'number') {
                valueInput.type = 'number';
            } else if (this.value === 'boolean') {
                const checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.name = 'room_parameters[][value]';
                checkbox.classList.add('w-5', 'h-5');
                row.replaceChild(checkbox, valueInput);
                valueInput = checkbox;
            } else {
                valueInput.type = 'text';
            }
        });

        row.appendChild(nameInput);
        row.appendChild(typeSelect);
        row.appendChild(valueInput);
        row.appendChild(removeButton);

        tagsContainer.appendChild(row);
    }

    addTagButton.addEventListener('click', createTagRow);
});
