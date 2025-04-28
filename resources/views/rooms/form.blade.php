@props(['buttonMethod', 'buttonLabel', 'buttonUrl', 'model'])

@php
    $isEdit = isset($model);
@endphp

<x-form.form
    :isEdit="intval(isset($model))"
    :labelEdit="__('property.room.edit')"
    :labelCreate="__('property.room.create')"
    :action="$buttonUrl"
    :method="$buttonMethod"
>

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
</x-form.form>

@push('scripts')
    <script src="{{ asset('js/components/requiredFieldsButtonActivation.js') }}" defer></script>
@endpush
