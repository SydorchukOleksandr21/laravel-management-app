@php use Illuminate\Support\Str; @endphp

@props([
    'item' => null,
    'property',
    'label' => null,
    'placeholder' => '',
    'type' => 'text',
    'required' => false,
    'min' => null,
    'max' => null,
    'default' => '',
])

@php
    $value = old($property, $item?->$property ?? $default);
    $labelText = $label ?? Str::headline($property);
    $inputClasses = 'form-input w-full p-2 border rounded-md';
@endphp

<div class="mb-4">
    <label for="{{ $property }}" class="block text-sm font-medium text-gray-700">
        {{ $labelText }}@if($required)
            <span class="marker-important">*</span>
        @endif
    </label>

    @switch($type)
        @case('textarea')
            <textarea
                id="{{ $property }}"
                name="{{ $property }}"
                class="{{ $inputClasses }}"
                placeholder="{{ $placeholder }}"
                @if($required) required @endif
            >{{ old($property, $value) }}</textarea>
            @break

        @case('number')
            <input
                type="number"
                id="{{ $property }}"
                name="{{ $property }}"
                value="{{ $value }}"
                class="{{ $inputClasses }}"
                placeholder="{{ $placeholder }}"
                @if($min !== null) min="{{ $min }}" @endif
                @if($max !== null) max="{{ $max }}" @endif
                @if($required) required @endif
                data-type="validated-number"
                data-min="{{ $min }}"
                data-max="{{ $max }}"
            >
            @break

        @default
            <input
                type="{{ $type }}"
                id="{{ $property }}"
                name="{{ $property }}"
                value="{{ $value }}"
                class="{{ $inputClasses }}"
                placeholder="{{ $placeholder }}"
                @if($required) required @endif
            >
    @endswitch

    @error($property)
    <p class="text-destructive text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
