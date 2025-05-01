document.addEventListener('DOMContentLoaded', function () {
    const url = "/api/room/available";
    const roomSampleInput = document.querySelector('input[name="room_sample_id"]');
    const hiddenRoomIdInput = document.querySelector('input[name="room_id"]');

    const dateStartInput = document.querySelector('input[name="date_start"]');
    const dateEndInput = document.querySelector('input[name="date_end"]');

    const roomContainer = document.getElementById('availableRooms');
    const template = document.getElementById('roomItemTemplate').querySelector('.room-box');

    if (!roomSampleInput || !roomContainer || !template) return;

    const roomSelectionEvent = async function () {
        const json = roomSampleInput.getAttribute('data-json');

        if (!json) {
            return;
        }

        const {id} = JSON.parse(json);

        if (!id) {
            return;
        }

        try {
            const dateStart = dateStartInput.value;
            const dateEnd = dateEndInput.value;

            const response = await fetch(`${url}?roomSampleId=${id}&dateStart=${dateStart}&dateEnd=${dateEnd}`);
            const data = await response.json();

            console.log('Rooms data:', data);  // Перевіримо, чи є дані в відповіді

            if (!data || data.length === 0) {
                console.log('No available rooms found');
                return;
            }

            roomContainer.innerHTML = '';

            data.forEach(room => {
                const clone = template.cloneNode(true);
                const numberEl = clone.querySelector('.room-number');

                clone.dataset.id = room.id;
                numberEl.textContent = room.number;

                clone.addEventListener('click', function () {
                    // Remove active from others
                    document.querySelectorAll('.room-box.selected').forEach(el =>
                        el.classList.remove('selected', 'border-green-500')
                    );

                    // Select current
                    clone.classList.add('selected', 'border-green-500');
                    hiddenRoomIdInput.value = room.id;
                });

                console.log('Appending room box:', room.number);  // Дивимося, чи додаються елементи

                roomContainer.appendChild(clone);

                console.log(roomContainer.innerHTML)
            });
        } catch (e) {
            console.error('Error fetching available rooms:', e);
        }
    }

    roomSampleInput.addEventListener('searchInputChange', roomSelectionEvent);
    dateStartInput.addEventListener('input', roomSelectionEvent);
    dateEndInput.addEventListener('input', roomSelectionEvent);
});
