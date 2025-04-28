@props(['parameters'])

<div class="mt-8">
    <label class="block text-xl font-semibold text-gray-700">Room Parameters</label>
    <div class="overflow-x-auto rounded-xl">
        <table class="min-w-full text-sm text-left text-gray-700 bg-white border border-gray-200 rounded-xl overflow-hidden">
            <thead class="bg-blue-200 text-gray-700 uppercase">
            <tr>
                <th class="px-6 py-3">{{__('label.name')}}</th>
                <th class="px-6 py-3">{{__('label.value')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($parameters as $param)
                @php
                    $bgColor = match($param->value_type) {
                        \App\Enums\ValueType::String => 'bg-blue-100',
                        \App\Enums\ValueType::Number => 'bg-blue-100',
                        \App\Enums\ValueType::Boolean => 'bg-blue-100',
                        default => 'bg-white'
                    };
                @endphp
                <tr class="{{ $bgColor }} border-b border-gray-200 hover:bg-opacity-80 transition-colors">
                    <td class="px-6 py-4 font-medium">{{ $param->name }}</td>
                    <td class="px-6 py-4">
                        @if($param->value_type == \App\Enums\ValueType::Boolean)
                            <input type="checkbox" class="w-5 h-5" {{ $param->value ? 'checked' : '' }} onclick="event.preventDefault()">
                        @else
                            {{ $param->value }}
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
