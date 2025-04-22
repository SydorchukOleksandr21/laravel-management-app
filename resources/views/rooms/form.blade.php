@props(['buttonMethod', 'buttonLabel', 'buttonUrl', 'model'])

@php
    $isEdit = isset($model);
@endphp

<div class="flex flex-col items-center justify-center min-h-screen bg-warm-gray-50 px-4">
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-4xl">
        <h2 class="text-2xl font-semibold text-center mb-4">
            {{ $isEdit ? __('property.room.edit') : __('property.room.create') }}
        </h2>

        <form
                id="submitForm"
                action="{{ $buttonUrl }}"
                method="{{$isEdit ? $buttonMethod : 'POST'}}"
                enctype="multipart/form-data"
                autocomplete="off"
                class="grid grid-cols-1 md:grid-cols-2 gap-6"
        >
            @csrf

            {{-- Left Column --}}
            <div class="space-y-4">
                <x-form.input
                        :item="$model"
                        property="number"
                        type="number"
                        min="1"
                        required
                        label="{{ __('property.room_number') }}"
                />

                <x-form.input
                        :item="$model"
                        property="floor"
                        type="number"
                        min="1"
                        required
                        label="{{ __('property.floor') }}"
                />
            </div>

            {{-- Right Column --}}
            <div class="space-y-4">

                @if(!$isEdit)
                    <x-form.input
                            :item="$model"
                            property="rooms_count"
                            type="number"
                            min="1"
                            default="1"
                            required
                            label="{{ __('property.rooms_count') }}"
                    />
                @endif

                <x-form.input
                        :item="$model"
                        property="notes"
                        type="textarea"
                        label="{{ __('property.notes') }}"
                />

                <x-form.search-input
                        :item="$model"
                        url="{{ route('room-sample.list') }}"
                        placeholder="Search for room sample..."
                        property="room_sample_id"
                        label="Room Sample"
                        labelField="name"
                        required="true"
                />

            </div>

            {{-- Button Row --}}
            <div class="col-span-2 mt-6 flex flex-col md:flex-row items-center gap-4">
                <a
                        href="{{ url()->previous() }}"
                        class="btn btn-secondary py-2 px-4 w-full md:w-auto text-center"
                >
                    {{ __('Back') }}
                </a>

                <button
                        type="submit"
                        id="saveButton"
                        class="btn btn-primary py-2 px-6 w-full md:w-auto"
                >
                    {{ $buttonLabel }}
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/components/requiredFieldsButtonActivation.js') }}" defer></script>
@endpush
