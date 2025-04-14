@extends('app')

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('content')
    {{--    <div class="flex flex-col items-center justify-center min-h-screen bg-warm-gray-50 px-4">--}}
    {{--        <!-- View Container -->--}}
    {{--        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl">--}}
    {{--            <div class="text-center mb-6">--}}
    {{--                <h2 class="text-2xl font-semibold text-center">--}}
    {{--                    Room Sample Details--}}
    {{--                </h2>--}}
    {{--            </div>--}}

    {{--            <!-- Room Details -->--}}
    {{--            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">--}}
    {{--                <!-- Left Column -->--}}
    {{--                <div class="space-y-3">--}}
    {{--                    <div>--}}
    {{--                        <label class="block text-lg font-semibold text-gray-700">Name:</label>--}}
    {{--                        <p class="p-3 border rounded-md bg-gray-100 text-lg">{{ $roomSample->name }}</p>--}}
    {{--                    </div>--}}

    {{--                    <div>--}}
    {{--                        <label class="block text-lg font-semibold text-gray-700">Person Count:</label>--}}
    {{--                        <p class="p-3 border rounded-md bg-gray-100 text-lg">{{ $roomSample->person_count }}</p>--}}
    {{--                    </div>--}}

    {{--                    <div>--}}
    {{--                        <label class="block text-lg font-semibold text-gray-700">Square Area (m²):</label>--}}
    {{--                        <p class="p-3 border rounded-md bg-gray-100 text-lg">{{ $roomSample->square_area }}</p>--}}
    {{--                    </div>--}}

    {{--                    <div>--}}
    {{--                        <label class="block text-lg font-semibold text-gray-700">Description:</label>--}}
    {{--                        <p class="p-3 border rounded-md bg-gray-100 text-lg">{{ $roomSample->description }}</p>--}}
    {{--                    </div>--}}
    {{--                </div>--}}

    {{--                <!-- Right Column (Image) -->--}}
    {{--                <div class="flex flex-col items-center">--}}
    {{--                    <label class="block text-lg font-semibold text-gray-700">Room Image</label>--}}
    {{--                    <div class="w-full h-96 border-2 border-gray-300 rounded-md flex items-center justify-center overflow-hidden">--}}
    {{--                        <img src="{{ route('room-sample.image', $roomSample) }}" alt="Room Image"--}}
    {{--                             class="w-full h-full object-cover">--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}

    {{--            <!-- Room Parameters -->--}}
    {{--            <div class="mt-8">--}}
    {{--                <label class="block text-xl font-semibold text-gray-700">Room Parameters</label>--}}
    {{--                <div class="overflow-x-auto rounded-xl">--}}
    {{--                    <table class="min-w-full text-sm text-left text-gray-700 bg-white border border-gray-200 rounded-xl overflow-hidden">--}}
    {{--                        <thead class="bg-gray-100 text-gray-700 uppercase">--}}
    {{--                        <tr>--}}
    {{--                            <th class="px-6 py-3">Name</th>--}}
    {{--                            <th class="px-6 py-3">Value</th>--}}
    {{--                        </tr>--}}
    {{--                        </thead>--}}
    {{--                        <tbody>--}}
    {{--                        @if ($roomSample->roomParameters)--}}
    {{--                            @foreach ($roomSample->roomParameters as $param)--}}
    {{--                                @php--}}
    {{--                                    $bgColor = match($param->value_type) {--}}
    {{--                                        0 => 'bg-gray-100',--}}
    {{--                                        1 => 'bg-blue-100',--}}
    {{--                                        2 => 'bg-green-100',--}}
    {{--                                        default => 'bg-white'--}}
    {{--                                    };--}}
    {{--                                @endphp--}}
    {{--                                <tr class="{{ $bgColor }} border-b border-gray-200 hover:bg-opacity-80 transition-colors">--}}
    {{--                                    <td class="px-6 py-4 font-medium">{{ $param->name }}</td>--}}
    {{--                                    <td class="px-6 py-4">--}}
    {{--                                        @if($param->value_type == \App\Enums\ValueType::Boolean)--}}
    {{--                                            <input type="checkbox" class="w-5 h-5" {{ $param->value == 1 ? 'checked' : '' }} onclick="event.preventDefault()">--}}
    {{--                                        @else--}}
    {{--                                            {{ $param->value }}--}}
    {{--                                        @endif--}}
    {{--                                    </td>--}}
    {{--                                </tr>--}}
    {{--                            @endforeach--}}
    {{--                        @endif--}}
    {{--                        </tbody>--}}
    {{--                    </table>--}}
    {{--                </div>--}}

    {{--            </div>--}}

    {{--            <!-- Action Buttons -->--}}
    {{--            <div class="mt-8 flex justify-between">--}}
    {{--                <a href="{{ route('room-sample.edit', $roomSample) }}"--}}
    {{--                   class="btn btn-secondary py-2">Edit</a>--}}
    {{--                <button onclick="openModal('{{ route('room-sample.destroy', $roomSample) }}')"--}}
    {{--                        class="btn btn-error py-2">--}}
    {{--                    Delete--}}
    {{--                </button>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    {{--    @include('components.confirmModal')--}}

    <x-item-show-card>
        <x-slot name="title">
            "Room Sample Details"
        </x-slot>

        <x-slot name="urlEdit">
            {{route('room-sample.edit', $roomSample)}}
        </x-slot>

        <x-slot name="urlDelete">
            {{ route('room-sample.destroy', $roomSample) }}')
        </x-slot>

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
                <div
                    class="w-full h-96 border-2 border-gray-300 rounded-md flex items-center justify-center overflow-hidden">
                    <img src="{{ route('room-sample.image', $roomSample) }}" alt="Room Image"
                         class="w-full h-full object-cover">
                </div>
            </div>
        </div>

        <!-- Room Parameters -->
        <div class="mt-8">
            <label class="block text-xl font-semibold text-gray-700">Room Parameters</label>
            <div class="overflow-x-auto rounded-xl">
                <table
                    class="min-w-full text-sm text-left text-gray-700 bg-white border border-gray-200 rounded-xl overflow-hidden">
                    <thead class="bg-gray-100 text-gray-700 uppercase">
                    <tr>
                        <th class="px-6 py-3">Name</th>
                        <th class="px-6 py-3">Value</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($roomSample->roomParameters)
                        @foreach ($roomSample->roomParameters as $param)
                            @php
                                $bgColor = match($param->value_type) {
                                    0 => 'bg-gray-100',
                                    1 => 'bg-blue-100',
                                    2 => 'bg-green-100',
                                    default => 'bg-white'
                                };
                            @endphp
                            <tr class="{{ $bgColor }} border-b border-gray-200 hover:bg-opacity-80 transition-colors">
                                <td class="px-6 py-4 font-medium">{{ $param->name }}</td>
                                <td class="px-6 py-4">
                                    @if($param->value_type == \App\Enums\ValueType::Boolean)
                                        <input type="checkbox" class="w-5 h-5"
                                               {{ $param->value == 1 ? 'checked' : '' }} onclick="event.preventDefault()">
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
    </x-item-show-card>
@endsection
