document.addEventListener('DOMContentLoaded', function() {
    const saveButton = document.getElementById('saveButton');
    const nameInput = document.getElementById('name');
    const personCountInput = document.getElementById('person_count');
    const squareAreaInput = document.getElementById('square_area');
    const imageInput = document.getElementById('image');
    const uploadButton = document.getElementById('uploadButton');
    const removeButton = document.getElementById('removeButton');
    const imagePreview = document.getElementById('imagePreview');
    const placeholderText = document.getElementById('placeholderText');
    const roomParametersContainer = document.getElementById('roomParametersContainer');

    let base64Image = null;

    function toggleSaveButton() {
        const isValid = nameInput.value.trim() && personCountInput.value.trim() && squareAreaInput.value.trim();
        saveButton.disabled = !isValid;
    }

    function handleImageUpload(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                base64Image = e.target.result; // Зберігаємо зображення у Base64 форматі
                imagePreview.src = base64Image;
                imagePreview.classList.remove('hidden');
                placeholderText.classList.add('hidden');
                removeButton.classList.remove('hidden');
            };
            reader.readAsDataURL(file); // Конвертуємо у Base64
        }
    }

    function removeImage() {
        base64Image = null;
        imagePreview.src = '';
        imagePreview.classList.add('hidden');
        placeholderText.classList.remove('hidden');
        removeButton.classList.add('hidden');
        imageInput.value = '';
    }

    uploadButton.addEventListener('click', () => imageInput.click());
    imageInput.addEventListener('change', handleImageUpload);
    removeButton.addEventListener('click', removeImage);

    nameInput.addEventListener('input', toggleSaveButton);
    personCountInput.addEventListener('input', toggleSaveButton);
    squareAreaInput.addEventListener('input', toggleSaveButton);

    toggleSaveButton();

    // Function to collect parameters data as an array of objects
    function collectParameters() {
        const parameters = [];
        const parameterElements = roomParametersContainer.querySelectorAll('.room-parameter');

        parameterElements.forEach(element => {
            const name = element.querySelector('input[name*="room_parameters[][name]"]').value;
            const type = element.querySelector('select[name*="room_parameters[][type]"]').value;

            // Get the correct value input based on visibility (not hidden)
            let value = null;
            const valueInputs = element.querySelectorAll('input[name*="room_parameters[][value]"]:not(.hidden)');

            valueInputs.forEach(valueInput => {
                if (valueInput.type === 'checkbox') {
                    value = valueInput.checked ? 1 : 0;
                } else {
                    value = valueInput.value;
                }
            });

            // Only add parameter if name and value are filled
            if (name && value !== null) {
                parameters.push({ name, type, value });
            }
        });

        return parameters;
    }

    // Form submission
    saveButton.addEventListener('click', function() {
        // Create a JSON object
        const formData = {
            name: nameInput.value,
            person_count: personCountInput.value,
            square_area: squareAreaInput.value,
            room_parameters: collectParameters(),
            image: base64Image // Додаємо Base64-зображення
        };

        // Send the data as a JSON object in a POST request
        fetch('/room-sample/create', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(formData) // Відправляємо JSON
        })
            .then(response => response.json())
            .then(data => {
                console.log('Data successfully sent:', data);
            })
            .catch(error => {
                console.error('Error sending data:', error);
            });
    });
});
