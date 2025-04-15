@php use Illuminate\Support\Str;
@endphp
@extends('app')

@section('content')

    <div class="container mx-auto py-10 px-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">{{ $modelName }} List</h1>

            <a href="{{ route($createUrl ?? Str::kebab(class_basename($items->first())) . '.create') }}"
               class="inline-flex items-center px-4 py-2 btn-primary text-white rounded-xl shadow hover:bg-green-700 transition"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 4v16m8-8H4"/>
                </svg>
                Create
            </a>
        </div>


        @if ($items->count())
            <div class="overflow-x-auto rounded-xl shadow-lg">
                <table class="min-w-full bg-white text-base text-left border border-gray-200">
                    <thead class="bg-gray-200">
                    <tr>
                        @php
                            $modelInstance = $items->first();
                            $labels = method_exists($modelInstance, 'attributeLabels')
                                ? $modelInstance->attributeLabels()
                                : array_combine($modelInstance->getFillable(), $modelInstance->getFillable());

                            $urlPrefix = Str::kebab(class_basename($modelInstance));

                            $viewUrl = $viewUrl ?? $urlPrefix . '.show';
                            $editUrl = $editUrl ?? $urlPrefix . '.edit';
                            $deleteUrl = $deleteUrl ?? $urlPrefix . '.destroy';

                        @endphp

                        @foreach ($modelInstance->getFillable() as $field)
                            <th class="px-6 py-4 font-semibold text-gray-700 uppercase tracking-wider whitespace-nowrap">
                                {{ $labels[$field]['name'] ?? ucfirst(str_replace('_', ' ', $field)) }}                            </th>
                        @endforeach
                        <th class="px-6 py-4 font-semibold text-gray-700 uppercase tracking-wider text-center">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                    @foreach ($items as $item)
                        <tr class="hover:bg-gray-50 transition-all duration-150">
                            @foreach ($item->getFillable() as $field)
                                @php
                                    $type = $labels[$field]['type'] ?? \App\Enums\GridValueType::String;
                                    $value = $item->$field;
                                @endphp

                                <td class="px-6 py-4 text-gray-900 whitespace-nowrap">
                                    @switch($type)
                                        @case(\App\Enums\GridValueType::Image)
                                            <img
                                                src="{{ route("image.show", ["imageModel" => class_basename($items->first()), "modelId" => $item, "property" => $field]) }}"
                                                class="w-16 h-16 object-cover rounded-md border"/>
                                            @break

                                        @case(\App\Enums\GridValueType::Checkbox)
                                            <input type="checkbox"
                                                   class="form-checkbox h-5 w-5 text-green-500 cursor-default"
                                                   @checked($value)
                                                   onclick="return false;"/>
                                            @break

                                        @default
                                            {{ $value }}
                                    @endswitch
                                </td>
                            @endforeach

                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex items-center justify-center gap-2">
                                    {{-- View --}}
                                    <a href="{{ route($viewUrl, $item->id) }}"
                                       class="sidebar-icon-button text-blue-500 hover:text-blue-600"
                                       title="View">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"/>
                                            <circle cx="12" cy="12" r="3"/>
                                        </svg>
                                    </a>

                                    {{-- Edit --}}
                                    <a href="{{ route($editUrl, $item->id) }}"
                                       class="sidebar-icon-button text-yellow-500 hover:text-yellow-600"
                                       title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 20h9"/>
                                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/>
                                        </svg>
                                    </a>

                                    {{-- Delete --}}
                                    <button type="button"
                                            onclick="openModal('{{ route($deleteUrl, $item->id) }}')"
                                            class="sidebar-icon-button text-red-500 hover:text-red-600"
                                            title="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"/>
                                            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                            <path d="M10 11v6"/>
                                            <path d="M14 11v6"/>
                                            <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $items->links() }}
            </div>
        @else
            <p class="text-gray-500 text-lg">No records found.</p>
        @endif
    </div>
    @include('components.confirmModal')
@endsection
