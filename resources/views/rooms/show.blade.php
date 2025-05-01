@extends('layouts.admin')

@section('content')
    <x-item-show-card
        :title="__('property.room.view', ['number' => $model->number])"
        :urlEdit="route('room.edit', $model)"
        :urlDelete="route('room.destroy', $model)"
        :itemId="$model->id"
    >

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Left Column -->
            <div class="space-y-4">
                <x-display.label label="{{ __('property.room_number') }}" :value="$model->number"/>
                <x-display.label label="{{ __('property.floor') }}" :value="$model->floor"/>
            </div>

            <!-- Right Column -->
            <div class="space-y-4">
                <x-display.label label="{{ __('property.notes') }}" :value="$model->notes ?: __('label.notes-empty')"/>

                <x-display.link-label
                    :label="__('property.room.room-sample')"
                    itemName="name"
                    :value="$model->roomSample"
                    :itemHref="route('room-sample.show', $model->roomSample)"
                />
            </div>
        </div>
    </x-item-show-card>
@endsection
