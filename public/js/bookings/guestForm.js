document.addEventListener('DOMContentLoaded', function() {
    const saveButton = document.getElementById('saveGuest');
    const nameInput = document.getElementById('name');
    const phoneInput = document.getElementById('phone_number');
    const emailInput = document.getElementById('email');
    const guestFormContainer = document.getElementById('guestFormContainer');
    const bookingFormContainer = document.getElementById('bookingFormContainer');
    const saveBookingButton = document.getElementById('saveBooking');
    const roomSelect = document.getElementById('room_id');

    function validateEmail(email) {
        const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        return emailRegex.test(email);
    }

    function toggleSaveButton() {
        const isFormValid = nameInput.value && phoneInput.value && validateEmail(emailInput.value);
        saveButton.disabled = !isFormValid;
    }

    function loadRooms() {
        const rooms = [
            { id: 1, name: 'Room 1' },
            { id: 2, name: 'Room 2' },
            { id: 3, name: 'Room 3' }
        ];

        rooms.forEach(room => {
            const option = document.createElement('option');
            option.value = room.id;
            option.textContent = room.name;
            roomSelect.appendChild(option);
        });
    }

    function showBookingForm() {
        guestFormContainer.classList.add('hidden');
        bookingFormContainer.classList.remove('hidden');
    }

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

        fetch('/guest/update', {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(guestData)
        })
            .then(response => response.json())
            .then(data => {
                localStorage.setItem('guestData', JSON.stringify(data));
                showBookingForm();
                loadRooms();
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });

    saveBookingButton.addEventListener('click', function(event) {
        event.preventDefault();

        const bookingData = {
            room_id: roomSelect.value,
            guest_id: JSON.parse(localStorage.getItem('guestData')).id,
            date_start: document.getElementById('date_start').value,
            date_end: document.getElementById('date_end').value
        };

        fetch('/bookings/save-booking', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(bookingData)
        })
            .then(response => response.json())
            .then(data => {
                console.log('Booking saved:', data);
            })
            .catch(error => {
                console.error('Booking Error:', error);
            });
    });

    toggleSaveButton();
});
