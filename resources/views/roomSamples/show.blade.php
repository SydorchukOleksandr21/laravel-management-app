@extends('layouts.admin')

@section('content')
    <x-item-show-card>
        <x-slot name="title">{{ __('label.room_details') }}</x-slot>

        <x-slot name="urlEdit">{{ route('room-sample.edit', $roomSample) }}</x-slot>
        <x-slot name="urlDelete">{{ route('room-sample.destroy', $roomSample) }}</x-slot>
        <x-slot name="itemId">{{ $roomSample->id }}</x-slot>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Left Column -->
            <div class="space-y-3">
                <x-display.label label="{{ __('property.name') }}" :value="$roomSample->name" />
                <x-display.label label="{{ __('property.person_count') }}" :value="$roomSample->person_count" />
                <x-display.label label="{{ __('property.square_area') }}" :value="$roomSample->square_area" />
                <x-display.label label="{{ __('property.price') }}" :value="$roomSample->price" />
                <x-display.label label="{{ __('property.description') }}" :value="$roomSample->description" />
            </div>

            <!-- Right Column -->
            <x-display.image
                label="{{ __('property.room_image') }}"
                :src="route('image.show', [
                    'modelName' => class_basename($roomSample),
                    'modelId' => $roomSample,
                    'property' => 'image_path'
                ])"
                alt="{{ __('property.room_image') }}"
            />
        </div>

        <!-- Parameters Table -->
        @if ($roomSample->roomParameters->isNotEmpty())
            <x-display.param-table :parameters="$roomSample->roomParameters" />
        @endif

    </x-item-show-card>
@endsection
