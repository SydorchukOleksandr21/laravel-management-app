@props([
    'id' => 'autocomplete-input',
    'name' => 'search',
    'placeholder' => 'Search...',
    'url' => '', // Наприклад: route('api.search.suggestions')
])

<div x-data="autocompleteInput('{{ $url }}')" class="relative w-full">
    <input
        id="{{ $id }}"
        name="{{ $name }}"
        x-model="query"
        x-on:input.debounce.300ms="fetchResults"
        x-on:focus="show = true"
        x-on:keydown.escape.window="show = false"
        type="text"
        placeholder="{{ $placeholder }}"
        autocomplete="off"
        class="w-full px-4 py-2 border rounded-xl focus:outline-none focus:ring focus:ring-green-300"
    />

    <ul
        x-show="show && results.length"
        x-transition
        class="absolute z-10 bg-white border w-full mt-1 rounded-xl shadow-lg max-h-60 overflow-auto"
    >
        <template x-for="result in results" :key="result.id">
            <li
                class="px-4 py-2 hover:bg-gray-100 cursor-pointer"
                x-text="result.name"
                x-on:click="select(result)"
            ></li>
        </template>
    </ul>

    <input type="hidden" name="{{ $name }}_id" :value="selected?.id">
</div>

@once
    @push('scripts')
        <script>
            function autocompleteInput(url) {
                return {
                    query: '',
                    results: [],
                    show: false,
                    selected: null,

                    async fetchResults() {
                        if (this.query.length < 2) {
                            this.results = []
                            return;
                        }

                        const response = await fetch(`${url}?search=${this.query}`);
                        this.results = await response.json();
                    },

                    select(result) {
                        this.query = result.name;
                        this.selected = result;
                        this.show = false;
                    }
                }
            }
        </script>
    @endpush
@endonce
