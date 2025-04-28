@props(['label', 'value', 'itemHref', 'itemName'])

<div>
    <label class="block font-semibold text-gray-700">{{ $label }}:</label>
    @if($value)
        <a href="{{ $itemHref }}"
           class="p-3 block border rounded-md bg-indigo-50 text-indigo-700 hover:bg-indigo-100 transition font-medium">
            {{ $value->$itemName }}
        </a>
    @else
        <p class="p-3 border rounded-md bg-gray-100 text-gray-500 italic">{{__("label.not-assigned")}}</p>
    @endif
</div>
