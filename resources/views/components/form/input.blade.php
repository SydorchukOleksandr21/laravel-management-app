@php use Illuminate\Support\Str; @endphp
@props([
    'item' => null,
    'property',
    'label' => null,
    'type' => 'text',
    'required' => false,
    'min' => -999999999,
    'max' => 999999999,
    'default' => '',
])

@php
    $value = old($property, $item?->$property ?? $default);
    $labelText = $label ?? Str::headline($property);
@endphp

<div class="mb-4">
    <label for="{{ $property }}" class="block text-sm font-medium text-gray-700">
        {{ $labelText }}{{ $required ? ' *' : '' }}
    </label>

    @if($type === 'textarea')
        <textarea
            id="{{ $property }}"
            name="{{ $property }}"
            {{ $required ? 'required' : '' }}
            class="form-input w-full p-2 border rounded-md"
        >{{ e($value) }}</textarea>
    @elseif($type === 'number')
        <input
            type="number"
            id="{{ $property }}"
            name="{{ $property }}"
            min="{{ $min }}"
            max="{{ $max }}"
            value="{{ $value }}"
            {{ $required ? 'required' : '' }}
            class="form-input w-full p-2 border rounded-md"
            data-type="validated-number"
            data-min="{{ $min }}"
            data-max="{{ $max }}"
        >
    @else
        <input
            type="text"
            id="{{ $property }}"
            name="{{ $property }}"
            value="{{ $value }}"
            {{ $required ? 'required' : '' }}
            class="form-input w-full p-2 border rounded-md"
        >
    @endif
</div>
