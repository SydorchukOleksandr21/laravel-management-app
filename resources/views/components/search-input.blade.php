@props(['url', 'placeholder', 'name'])

<div class="relative">
    <input
        type="text"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        class="form-input w-full"
        id="search-input"
        autocomplete="off"
    />
    <ul id="search-results" class="absolute bg-white border border-gray-300 w-full mt-1 rounded shadow-md max-h-60 overflow-auto z-10 hidden">
        <!-- Results will be populated here -->
    </ul>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('search-input');
        const resultsContainer = document.getElementById('search-results');

        let timeout = null;

        input.addEventListener('input', function () {
            const query = input.value;
            if (query.length < 1) {
                resultsContainer.classList.add('hidden');
                return;
            }

            // Debounced search to avoid sending requests too often
            clearTimeout(timeout);
            timeout = setTimeout(async function () {
                try {
                    const response = await fetch(`{{ $url }}?search=${query}`);
                    const data = await response.json();

                    // Clear previous results
                    resultsContainer.innerHTML = '';

                    // If there are results, show them
                    if (data.items && data.items.length > 0) {
                        data.items.forEach(item => {
                            const li = document.createElement('li');
                            li.classList.add('cursor-pointer', 'p-2', 'hover:bg-gray-200');
                            li.textContent = item.name;
                            li.addEventListener('click', function () {
                                input.value = item.name;
                                // Assuming the selected item's ID should be passed through a hidden input field
                                document.querySelector(`[name='{{ $name }}']`).value = item.id;
                                resultsContainer.classList.add('hidden');
                            });
                            resultsContainer.appendChild(li);
                        });
                        resultsContainer.classList.remove('hidden');
                    } else {
                        resultsContainer.classList.add('hidden');
                    }
                } catch (error) {
                    console.error('Error fetching data:', error);
                }
            }, 300); // Wait 300ms after typing to make the request
        });
    });
</script>
