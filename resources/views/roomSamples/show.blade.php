@extends('app')

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('content')
    <div class="flex flex-col items-center justify-center min-h-screen bg-warm-gray-50 px-4">
        <!-- View Container -->
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl">
            <div class="text-center mb-6">
                <h2 class="text-3xl font-bold">Room Sample Details</h2>
            </div>

            <!-- Room Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Left Column -->
                <div class="space-y-3">
                    <div>
                        <label class="block text-lg font-semibold text-gray-700">Name:</label>
                        <p class="p-3 border rounded-md bg-gray-100 text-lg">{{ $roomSample->name }}</p>
                    </div>

                    <div>
                        <label class="block text-lg font-semibold text-gray-700">Person Count:</label>
                        <p class="p-3 border rounded-md bg-gray-100 text-lg">{{ $roomSample->person_count }}</p>
                    </div>

                    <div>
                        <label class="block text-lg font-semibold text-gray-700">Square Area (m²):</label>
                        <p class="p-3 border rounded-md bg-gray-100 text-lg">{{ $roomSample->square_area }}</p>
                    </div>

                    <div>
                        <label class="block text-lg font-semibold text-gray-700">Description:</label>
                        <p class="p-3 border rounded-md bg-gray-100 text-lg">{{ $roomSample->description }}</p>
                    </div>
                </div>

                <!-- Right Column (Image) -->
                <div class="flex flex-col items-center">
                    <label class="block text-lg font-semibold text-gray-700">Room Image</label>
                    <div class="w-full h-96 border-2 border-gray-300 rounded-md flex items-center justify-center overflow-hidden">
                        <img src="{{ route('room-sample.image', $roomSample) }}" alt="Room Image"
                             class="w-full h-full object-cover">
                    </div>
                </div>
            </div>

            <!-- Room Parameters -->
            <div class="mt-8">
                <label class="block text-xl font-semibold text-gray-700">Room Parameters</label>
                <div class="mt-4 overflow-x-auto">
                    <table class="min-w-full border-collapse rounded-lg">
                        <thead>
                        <tr>
                            <th class="px-4 py-2 text-left font-semibold text-gray-700">Name</th>
                            <th class="px-4 py-2 text-left font-semibold text-gray-700">Value</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($roomSample->roomParameters)
                            @foreach ($roomSample->roomParameters as $param)
                                @php
                                    $bgColor = match($param->value_type) {
                                        0 => 'bg-gray-200',
                                        1 => 'bg-blue-200',
                                        2 => 'bg-green-200',
                                        default => 'bg-gray-50'
                                    };
                                @endphp
                                <tr class="{{ $bgColor }} border-b">
                                    <td class="px-4 py-2">{{ $param->name }}</td>
                                    <td class="px-4 py-2">
                                        @if($param->value_type === 1 && is_numeric($param->value))
                                            <input type="checkbox" class="cursor-not-allowed" {{ $param->value == 1 ? 'checked' : '' }} disabled />
                                        @else
                                            {{ $param->value }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex justify-between">
                <a href="{{ route('room-sample.edit', $roomSample) }}"
                   class="btn btn-secondary py-2">Edit</a>
                <button onclick="openModal('{{ route('room-sample.destroy', $roomSample) }}')"
                        class="btn btn-error py-2">
                    Delete
                </button>
            </div>
        </div>
    </div>

    @include('components.confirmModal')
@endsection
