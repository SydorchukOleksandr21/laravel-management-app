@php use Illuminate\Support\Str;
@endphp
@extends('app')

@section('content')

    @php
        $modelInstance = new $className;

        $labels = method_exists($modelInstance, 'attributeLabels')
            ? $modelInstance->attributeLabels()
            : array_combine($modelInstance->getFillable(), $modelInstance->getFillable());

        $urlPrefix = \Illuminate\Support\Str::kebab(class_basename($modelInstance));

        $indexUrl = $viewUrl ?? $urlPrefix . '.index';
        $createUrl = $createUrl ?? $urlPrefix . '.create';
        $viewUrl = $viewUrl ?? $urlPrefix . '.show';
        $editUrl = $editUrl ?? $urlPrefix . '.edit';
        $deleteUrl = $deleteUrl ?? $urlPrefix . '.destroy';
    @endphp

    <div class="container mx-auto py-6 px-4">
        <div class="flex justify-between items-center mb-2">
            <h1 class="text-3xl font-bold text-gray-800">{{ $className }} List</h1>

            <a href="{{ route($createUrl) }}"
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


        <form method="GET" action="{{ route($indexUrl) }}" class="relative w-full sm:w-64 py-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="absolute left-3 top-1/2 transform -translate-y-1/2 text-muted-foreground">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..."
                   class="pl-10 bg-secondary border-none h-10 w-full rounded-md px-3 py-2 text-base">
        </form>


        @if ($items->count())
            <div class="overflow-x-auto rounded-xl shadow-lg">
                <table class="min-w-full bg-white text-base text-left border border-gray-200">
                    <thead class="bg-gray-200">
                    <tr>
                        @foreach ($modelInstance->getFillable() as $field)
                            <th class="px-6 py-2 font-semibold text-gray-700 uppercase tracking-wider whitespace-nowrap">
                                {{ __($labels[$field]['name'] ?? ucfirst(str_replace('_', ' ', $field))) }}                            </th>
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

                                <td class="px-6 py-2 text-gray-900 whitespace-nowrap">
                                    @switch($type)
                                        @case(\App\Enums\GridValueType::Image)
                                            <img
                                                src="{{ route('image.show', ['modelName' => class_basename($items->first()), 'modelId' => $item, 'property' => $field]) }}"
                                                class="w-16 h-16 object-cover rounded-md border"/>
                                            @break

                                        @case(\App\Enums\GridValueType::Checkbox)
                                            <input type="checkbox"
                                                   class="form-checkbox h-5 w-5 text-green-500 cursor-default"
                                                   @checked($value)
                                                   onclick="return false;"/>
                                            @break

                                        @case(\App\Enums\GridValueType::Currency)
                                            {{ $value }} $
                                            @break

                                        @case(\App\Enums\GridValueType::Link)
                                            @php
                                                if (!isset($labels[$field]['route']) ) {
                                                    throw new \RuntimeException("Missing 'route' for GridValueType::Link");
                                                }

                                                $funcName = $labels[$field]['object'];
                                                $property = $labels[$field]['property'];
                                            @endphp

                                            <a href="{{ route($labels[$field]['route'], ["model" => $value]) }}"
                                               class="text-blue-600 hover:underline">
                                                {{ $item->$funcName->$property }}
                                            </a>
                                            @break

                                        @default
                                            {{ $value ?? '-' }}
                                    @endswitch
                                </td>
                            @endforeach

                            <td class="px-6 py-2 whitespace-nowrap text-center">
                                <div class="flex items-center justify-center gap-2">
                                    {{-- View --}}
                                    <a href="{{ route($viewUrl, $item->id) }}"
                                       class="sidebar-icon-button text-blue-500 hover:text-blue-600"
                                       title="View">
                                        <x-icon name="view"/>
                                    </a>

                                    {{-- Edit --}}
                                    <a href="{{ route($editUrl, $item->id) }}"
                                       class="sidebar-icon-button text-yellow-500 hover:text-yellow-600"
                                       title="{{__('label.edit')}}">
                                        <x-icon name="edit"/>
                                    </a>

                                    {{-- Delete --}}
                                    <button type="button"
                                            onclick="openModal('{{ route($deleteUrl, $item->id) }}')"
                                            class="sidebar-icon-button text-red-500 hover:text-red-600"
                                            title="{{__('label.delete')}}">
                                        <x-icon name="trash"/>
                                    </button>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500 text-lg">No records found.</p>
        @endif

        @include('components.pagination', ['paginator' => $items])

    </div>
    @include('components.confirmModal')
@endsection
