@props(['label', 'src', 'alt'])

<div class="flex flex-col items-center">
    <label class="block text-lg font-semibold text-gray-700">{{ $label }}</label>
    <div class="w-full h-96 border-2 border-gray-300 rounded-md flex items-center justify-center overflow-hidden">
        <img src="{{ $src }}" alt="{{ $alt }}" class="w-full h-full object-cover">
    </div>
</div>
