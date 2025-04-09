@extends('app')

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('content')
    <div class="flex flex-col items-center justify-center min-h-screen bg-warm-gray-50 px-4">
        <!-- View Container -->
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-4xl">
            <div class="text-center mb-4">
                <h2 class="text-2xl font-semibold">Room Sample Details</h2>
            </div>

            <!-- Room Details -->
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <p><strong>Name:</strong> {{ $roomSample->name }}</p>
                    <p><strong>Person Count:</strong> {{ $roomSample->person_count }}</p>
                    <p><strong>Square Area (m²):</strong> {{ $roomSample->square_area }}</p>
                    <p><strong>Description:</strong> {{ $roomSample->description }}</p>
                </div>

                <!-- Room Image -->
                <div class="flex flex-col items-center">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Room Image</label>
                    <div
                        class="w-full h-72 border-2 border-gray-300 rounded-md flex items-center justify-center overflow-hidden">
                        <img src="{{ asset($roomSample->image_path) }}" alt="Room Image"
                             class="w-full h-full object-cover">
                    </div>
                </div>
            </div>

            <!-- Room Parameters -->
            <div class="mt-6">
                <label class="block text-lg font-semibold text-gray-700">Room Parameters</label>
                <ul class="mt-2 border-t pt-4">
                    <!-- Numeric Parameters -->
                    <li class="font-semibold text-gray-800">Numeric:</li>

                    @if ($roomSample->roomParameters)
                        @foreach ($roomSample->roomParameters as $param)
                            <li class="ml-4">{{ $param->name }}: {{ $param->value }}</li>
                        @endforeach
                    @endif

                    {{--                    <!-- String Parameters -->--}}
                    {{--                    <li class="font-semibold text-gray-800 mt-4">String:</li>--}}
                    {{--                    @foreach ($roomSample->parameters->where('type', 'string') as $param)--}}
                    {{--                        <li class="ml-4">{{ $param->name }}: {{ $param->value }}</li>--}}
                    {{--                    @endforeach--}}

                    {{--                    <!-- Boolean Parameters -->--}}
                    {{--                    <li class="font-semibold text-gray-800 mt-4">Boolean:</li>--}}
                    {{--                    @foreach ($roomSample->parameters->where('type', 'boolean') as $param)--}}
                    {{--                        <li class="ml-4">{{ $param->name }}: {{ $param->value ? 'Yes' : 'No' }}</li>--}}
                    {{--                    @endforeach--}}

                </ul>
            </div>

            <!-- Action Buttons -->
            <div class="mt-6 flex justify-between">
                <a href="{{ route('room-sample.edit', $roomSample) }}"
                   class="btn btn-primary px-4 py-2 rounded-md">Edit</a>
                <form action="{{ route('room-sample.destroy', $roomSample) }}" method="POST"
                      onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-error px-4 py-2 rounded-md">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection
