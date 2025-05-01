@props(['buttonMethod', 'buttonLabel', 'buttonUrl', 'model' => null])

<x-form.form
    :isEdit="intval(isset($model))"
    :labelEdit="__('property.booking.edit')"
    :labelCreate="__('property.booking.create')"
    :action="$buttonUrl"
    :method="$buttonMethod"
>
    <div class="space-y-4">

        <x-form.search-input
            :item="$model"
            url="{{ route('api.guest.list') }}"
            placeholder="Search for guest..."
            property="guest_id"
            label="Guest"
            labelField="name"
            required="true"
        />

        {{-- Name --}}
        <x-form.input
            :item="$model"
            property="name"
            type="text"
            label="{{ __('property.guest.name') }}"
            disabled
        />

        {{-- Phone Number --}}
        <x-form.input
            :item="$model"
            property="phone_number"
            type="text"
            label="{{ __('property.guest.phone_number') }}"
            disabled

            class="w-full"
        />

        {{-- Email --}}
        <x-form.input
            :item="$model"
            property="email"
            type="text"
            label="{{ __('property.guest.email') }}"
            disabled

            class="w-full"
        />

    </div>

    <div class="space-y-4">
        <x-form.input
            :item="$model"
            property="date_start"
            type="date"
            required
            label="{{ __('property.booking.date_start') }}"
            required
        />

        <x-form.input
            :item="$model"
            property="date_end"
            type="date"
            required
            label="{{ __('property.booking.date_end') }}"
            required
        />

        <x-form.search-input
            :item="$model"
            url="{{ route('api.room-sample.list') }}"
            placeholder="Search for room sample..."
            property="room_sample_id"
            label="{{__('property.booking.room_sample_id')}}"
            labelField="name"
            required="true"
        />

        <!-- Template for JavaScript use -->
        <div id="roomItemTemplate" class="hidden">
            @include('components.room-box-item')
        </div>

    </div>

    <div class="mt-4">
        @error("room_id")
        <p class="text-destructive text-sm mb-2">{{ $message }}</p>
        @enderror

        <div id="availableRooms" class="room-grid">
            {{-- Тут будуть вставлятися блоки --}}
        </div>
    </div>


    <input name="room_id" hidden/>


</x-form.form>


@push('scripts')
    <script src="{{ asset('js/bookings/guestSelection.js') }}"></script>
    <script src="{{ asset('js/bookings/roomSelection.js') }}"></script>
@endpush
