document.addEventListener('DOMContentLoaded', function() {
    const saveButton = document.getElementById('saveGuest');
    const nameInput = document.getElementById('name');
    const phoneInput = document.getElementById('phone_number');
    const emailInput = document.getElementById('email');

    function validateEmail(email) {
        const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        return emailRegex.test(email);
    }

    function toggleSaveButton() {
        const isFormValid = nameInput.value && phoneInput.value && validateEmail(emailInput.value);
        saveButton.disabled = !isFormValid;
    }

    // Перевірка полів при кожній зміні
    nameInput.addEventListener('input', toggleSaveButton);
    phoneInput.addEventListener('input', toggleSaveButton);
    emailInput.addEventListener('input', toggleSaveButton);

    saveButton.addEventListener('click', function() {
        saveButton.disabled = true;

        const guestData = {
            name: nameInput.value,
            phone_number: phoneInput.value,
            email: emailInput.value
        };

        // Відправляємо запит через fetch
        fetch('/guest/update', {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Для CSRF захисту
            },
            body: JSON.stringify(guestData)
        })
            .then(response => response.json())
            .then(data => {
                if (data.existed) {
                } else {
                    localStorage.setItem('guestData', JSON.stringify(data));
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });

    //init
    toggleSaveButton();
});
