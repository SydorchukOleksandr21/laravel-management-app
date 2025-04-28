@extends('layouts.admin')

@section('content')
    <x-item-show-card
        :title="__('property.guest.view', ['name' => $model->name])"
        :urlEdit="route('guest.edit', $model)"
        :urlDelete="route('guest.destroy', $model)"
        :itemId="$model->id"
    >
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Left Column -->
            <div class="space-y-4">
                <!-- Name -->
                <x-display.label
                    :label="__('property.guest.name')"
                    :value="$model->name"
                />

                <!-- Email -->
                <x-display.label
                    :label="__('property.guest.email')"
                    :value="$model->email"
                />
            </div>

            <!-- Right Column -->
            <div class="space-y-4">
                <!-- Phone Number -->
                <x-display.label
                    :label="__('property.guest.phone_number')"
                    :value="$model->phone_number"
                />
            </div>
        </div>
    </x-item-show-card>
@endsection
