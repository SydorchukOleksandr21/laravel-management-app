@extends('app')

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
    <div class="flex flex-col items-center justify-center min-h-screen bg-warm-gray-50 px-4">

        <!-- Form Container for Guest -->
        <div id="guestFormContainer" class="bg-white p-6 rounded-lg shadow-md w-full max-w-md transition-all duration-500 ease-in-out">
            <div class="text-center">
                <h2 class="text-2xl font-semibold">Create New Guest</h2>
                <p class="text-sm text-gray-500 mt-1">Please enter guest details to proceed.</p>
            </div>
            <form id="guestForm" class="mt-4">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="name" name="name" class="form-input w-full p-2 border rounded-md" placeholder="John Doe" required>
                </div>
                <div class="mb-4 w-full phone-number">
                    <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="tel" id="phone_number" name="phone_number" class="form-input w-full p-2 border rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="form-input w-full p-2 border rounded-md" placeholder="your@email.com" required>
                </div>
                <div class="mt-6">
                    <button type="button" id="saveGuest" class="btn btn-primary w-full py-2 rounded-md">Next</button>
                </div>
            </form>
        </div>

        <!-- Form Container for Booking (Initially hidden) -->
        <div id="bookingFormContainer" class="bg-white p-6 rounded-lg shadow-md w-full max-w-md hidden transition-all duration-500 ease-in-out">
            <div class="text-center">
                <h2 class="text-2xl font-semibold">Booking Information</h2>
                <p class="text-sm text-gray-500 mt-1">Please select the room and dates for booking.</p>
            </div>
            <form id="bookingForm" class="mt-4">
                @csrf
                <div class="mb-4">
                    <label for="room_id" class="block text-sm font-medium text-gray-700">Room</label>
                    <select id="room_id" name="room_id" class="form-input w-full p-2 border rounded-md" required>
                        <!-- Rooms will be dynamically loaded here -->
                    </select>
                </div>
                <div class="mb-4">
                    <label for="date_start" class="block text-sm font-medium text-gray-700">Start Date</label>
                    <input type="date" id="date_start" name="date_start" class="form-input w-full p-2 border rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="date_end" class="block text-sm font-medium text-gray-700">End Date</label>
                    <input type="date" id="date_end" name="date_end" class="form-input w-full p-2 border rounded-md" required>
                </div>
                <div class="mt-6">
                    <button type="submit" id="saveBooking" class="btn btn-primary w-full py-2 rounded-md">Book Now</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Include intl-tel-input library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

    <!-- External JS file -->
    <script src="{{ asset('js/components/phoneNumberComponent.js') }}"></script>
    <script src="{{ asset('js/bookings/guestForm.js') }}"></script>

@endsection
