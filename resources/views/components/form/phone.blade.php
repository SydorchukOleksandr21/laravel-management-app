@php use Illuminate\Support\Str; @endphp
@props([
    'item' => null,
    'property' => 'phone_number',
    'label' => null,
    'placeholder' => '+380501234567',
    'required' => false,
    'default' => '',
])

@php
    $value = old($property, $item?->$property ?? $default);
    $labelText = $label ?? Str::headline($property);
@endphp

<div class="mb-4 w-full phone-number">
    <label for="{{ $property }}" class="block text-sm font-medium text-gray-700">
        {{ $labelText }}
        @if($required)
            <span class="marker-important">*</span>
        @endif
    </label>

    <input
        type="tel"
        id="{{ $property }}"
        name="{{ $property }}"
        value="{{ $value }}"
        {{ $required ? 'required' : '' }}
        class="form-input w-full p-2 border rounded-md"
        placeholder="{{ $placeholder }}"
    >

    @error($property)
    <p class="text-destructive text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
