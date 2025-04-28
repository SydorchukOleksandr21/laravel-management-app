@extends('layouts.admin')

@section('content')
    <x-item-show-card>
        <x-slot name="title">{{ __('property.room-sample.view', ['name' => $model->name]) }}</x-slot>

        <x-slot name="urlEdit">{{ route('room-sample.edit', $model) }}</x-slot>
        <x-slot name="urlDelete">{{ route('room-sample.destroy', $model) }}</x-slot>
        <x-slot name="itemId">{{ $model->id }}</x-slot>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Left Column -->
            <div class="space-y-3">
                <x-display.label label="{{ __('property.name') }}" :value="$model->name" />
                <x-display.label label="{{ __('property.person_count') }}" :value="$model->person_count" />
                <x-display.label label="{{ __('property.square_area') }}" :value="$model->square_area" />
                <x-display.label label="{{ __('property.price') }}" :value="$model->price" />
                <x-display.label label="{{ __('property.description') }}" :value="$model->description" />
            </div>

            <!-- Right Column -->
            <x-display.image
                label="{{ __('property.room_image') }}"
                :src="route('image.show', [
                    'modelName' => class_basename($model),
                    'modelId' => $model,
                    'property' => 'image_path'
                ])"
                alt="{{ __('property.room_image') }}"
            />
        </div>

        <!-- Parameters Table -->
        @if ($model->roomParameters->isNotEmpty())
            <x-display.param-table :parameters="$model->roomParameters" />
        @endif

    </x-item-show-card>
@endsection
