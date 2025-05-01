@props([
    'isEdit',
    'labelCreate',
    'labelEdit',
    'action',
    'method'
])

<div class="flex flex-col items-center justify-center min-h-screen bg-warm-gray-50 px-4">
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-4xl">
        <h2 class="text-2xl font-semibold text-center mb-4">
            {{ $isEdit ? $labelEdit : $labelCreate }}
        </h2>

        <form
            id="submitForm"
            action="{{ $action }}"
            method="POST"
            enctype="multipart/form-data"
            autocomplete="off"
            class="grid grid-cols-1 md:grid-cols-2 gap-6"
        >
                @method($method)

            @csrf

            {{ $slot }}

            {{-- Button Row --}}
            <div class="col-span-2 mt-6 flex flex-col md:flex-row items-center gap-4">
                <a
                    href="{{ url()->previous() }}"
                    class="btn btn-secondary py-2 px-4 w-full md:w-auto text-center"
                >
                    {{ __('label.back') }}
                </a>

                <button
                    type="submit"
                    id="saveButton"
                    class="btn btn-primary py-2 px-6 w-full md:w-auto"
                >
                    {{ $isEdit ? __('label.edit') : __('label.create') }}
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/components/requiredFieldsButtonActivation.js') }}" defer></script>
@endpush
