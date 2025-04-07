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

    function toggleSaveButton() {
        const isValid = nameInput.value.trim() && personCountInput.value.trim() && squareAreaInput.value.trim();
        saveButton.disabled = !isValid;
    }

    function handleImageUpload(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.classList.remove('hidden');
                placeholderText.classList.add('hidden');
                removeButton.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    }

    function removeImage() {
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
});
