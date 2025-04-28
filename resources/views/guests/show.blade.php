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
                {{-- Name --}}
                <div>
                    <label class="block font-semibold text-gray-700">{{ __('property.guest.name') }}:</label>
                    <p class="p-3 border rounded-md bg-gray-100">{{ $model->name }}</p>
                </div>

                {{-- Email --}}
                <div>
                    <label class="block font-semibold text-gray-700">{{ __('property.guest.email') }}:</label>
                    <p class="p-3 border rounded-md bg-gray-100">{{ $model->email }}</p>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-4">
                {{-- Phone Number --}}
                <div>
                    <label class="block font-semibold text-gray-700">{{ __('property.guest.phone_number') }}:</label>
                    <p class="p-3 border rounded-md bg-gray-100">{{ $model->phone_number }}</p>
                </div>
            </div>
        </div>
    </x-item-show-card>
@endsection
