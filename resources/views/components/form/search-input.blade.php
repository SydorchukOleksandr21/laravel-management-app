@props([
    'url',
    'placeholder',
    'property',
    'label',
    'item',
    'labelField' => 'name',
    'required' => false,
    'default' => '',
])

@php
    $value = old($property, $item?->$property ?? $default);
@endphp

<div class="mb-4 relative">
    <label for="{{ $property }}" class="block text-sm font-medium text-gray-700">
        {{ $label ?? '' }}{{ $required ? ' *' : '' }}
    </label>
    <input
        type="text"
        id="search-input-{{ $property }}"
        placeholder="{{ $placeholder }}"
        class="form-input w-full"
        autocomplete="off"
        {{ $required ? 'required' : '' }}
    />
    <input type="hidden" name="{{ $property }}" id="hidden-input-{{ $property }}" value="{{ $value }}">

    <ul id="search-results-{{ $property }}"
        class="absolute bg-white border border-gray-300 w-full mt-1 rounded shadow-md max-h-60 overflow-auto z-10 hidden">
        <!-- Results will be populated here -->
    </ul>

    @error($property)
    <p class="text-destructive text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('search-input-{{ $property }}');
        const hiddenInput = document.getElementById('hidden-input-{{ $property }}');
        const resultsContainer = document.getElementById('search-results-{{ $property }}');
        let timeout = null;

        // Load label by ID if value is already set
        const initialId = hiddenInput.value;
        if (initialId) {
            fetch(`{{ $url }}?id=${initialId}`)
                .then(res => res.json())
                .then(json => {
                    const data = json;

                    if (data && data['{{ $labelField }}']) {
                        input.value = data['{{ $labelField }}'];
                        input.dispatchEvent(new Event('input')); // тригеримо подію input
                    }
                })
                .catch(err => console.error('Failed to fetch initial value:', err));
        }

        input.addEventListener('input', function () {
            const query = input.value;
            if (query.length < 1) {
                resultsContainer.classList.add('hidden');
                hiddenInput.value = '';
                return;
            }

            clearTimeout(timeout);
            timeout = setTimeout(async function () {
                try {
                    const response = await fetch(`{{ $url }}?search=${query}`);
                    const json = await response.json();
                    const data = json.data || [];

                    resultsContainer.innerHTML = '';

                    if (data.length > 0) {
                        data.forEach(item => {
                            const li = document.createElement('li');
                            li.classList.add('cursor-pointer', 'p-2', 'hover:bg-gray-200');
                            li.textContent = item['{{ $labelField }}'] ?? '';
                            li.addEventListener('click', function () {
                                input.value = item['{{ $labelField }}'];
                                hiddenInput.value = item.id;
                                resultsContainer.classList.add('hidden');
                            });
                            resultsContainer.appendChild(li);
                        });
                        resultsContainer.classList.remove('hidden');
                    } else {
                        resultsContainer.classList.add('hidden');
                        hiddenInput.value = '';
                    }
                } catch (error) {
                    console.error('Error fetching data:', error);
                }
            }, 300);
        });
    });
</script>
