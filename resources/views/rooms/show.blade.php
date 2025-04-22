@extends('layouts.admin')

@section('content')
    <x-item-show-card>
        <x-slot name="title">{{ __('property.room.view', ['number' => $model->number]) }}</x-slot>


        <x-slot name="urlEdit">
            {{ route('room.edit', $model) }}
        </x-slot>

        <x-slot name="urlDelete">
            {{ route('room.destroy', $model) }}
        </x-slot>

        <x-slot name="itemId">
            {{ $model->id }}
        </x-slot>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Left Column -->
            <div class="space-y-4">
                <div>
                    <label class="block font-semibold text-gray-700">{{ __('property.room_number') }}:</label>
                    <p class="p-3 border rounded-md bg-gray-100">{{ $model->number }}</p>
                </div>

                <div>
                    <label class="block font-semibold text-gray-700">{{ __('property.floor') }}:</label>
                    <p class="p-3 border rounded-md bg-gray-100">{{ $model->floor }}</p>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-4">
                <div>
                    <label class="block font-semibold text-gray-700">{{ __('property.notes') }}:</label>
                    <p class="p-3 border rounded-md bg-gray-100 whitespace-pre-wrap">{{ $model->notes ?: __('label.notes-empty') }}</p>
                </div>

                <div>
                    <label class="block font-semibold text-gray-700">Room Sample:</label>
                    @if($model->roomSample)
                        <a href="{{ route('room-sample.show', $model->roomSample) }}"
                           class="p-3 block border rounded-md bg-indigo-50 text-indigo-700 hover:bg-indigo-100 transition font-medium">
                            {{ $model->roomSample->name }}
                        </a>
                    @else
                        <p class="p-3 border rounded-md bg-gray-100 text-gray-500 italic">{{__("label.not-assigned")}}</p>
                    @endif
                </div>

            </div>
        </div>
    </x-item-show-card>
@endsection
