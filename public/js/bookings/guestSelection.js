document.addEventListener('DOMContentLoaded', function () {
    const customDataField = 'data-json';
    const guestIdInput = document.querySelector('input[name="guest_id"]');

    if (!guestIdInput) return;

    guestIdInput.addEventListener('searchInputChange', function () {
        const json = guestIdInput.getAttribute(customDataField);

        if (!json) {
            return;
        }

        try {
            const data = JSON.parse(json);

            const nameField = document.querySelector('input[name="name"]');
            const phoneField = document.querySelector('input[name="phone_number"]');
            const emailField = document.querySelector('input[name="email"]');

            if (nameField) nameField.value = data.name || '';
            if (phoneField) phoneField.value = data.phone_number || '';
            if (emailField) emailField.value = data.email || '';

        } catch (e) {
            console.error('Invalid JSON in data-json of guest_id input:', e);
        }
    });
});
