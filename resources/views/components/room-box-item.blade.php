@props(['number' => 0])

@php
    $classes = [
        'room-box',
        'font-semibold',
        'rounded-xl',
        'p-4',
        'text-center',
        'shadow-sm',
        'transition-colors',
        'cursor-pointer',
        'hover:bg-gray-100',
        'hover:text-gray-900',
    ];
@endphp

<div @class($classes)>
    <span class="room-number">{{ $number }}</span>
</div>
