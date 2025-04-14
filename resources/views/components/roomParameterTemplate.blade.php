
@php
    if(!isset($parameter)){
        $parameter = null;
    }

    $parameterValue = $parameter->value ?? '';
    $parameterType = $parameter->value_type ?? null;
@endphp
<table class="w-full border-separate room-parameters-table">
    <tbody>
    <tr class="room-parameter">
        <td class="p-3 w-1/3">
            <input type="text" name="room_parameters[][name]" placeholder="Name"
                   class="form-input w-full p-3"
                   value="{{ $parameter->name ?? '' }}">
        </td>

        <td class="p-3 w-1/3">
            <select name="room_parameters[][type]" class="form-select parameter-type w-full p-3">
                <option
                    value="1"
                    @selected($parameterType == \App\Enums\ValueType::String)
                >
                    String
                </option>
                <option
                    value="0"
                    @selected($parameterType == \App\Enums\ValueType::Number)
                >
                    Number
                </option>
                <option
                    value="2"
                    @selected($parameterType == \App\Enums\ValueType::Boolean)

                >
                    Boolean
                </option>
            </select>
        </td>

        {{--        <td class="p-3 w-1/3">--}}
        {{--            <!-- Text input for String type -->--}}
        {{--            <input type="text" name="room_parameters[{{ $i ?? '' }}][value]"--}}
        {{--                   class="form-input w-full p-3 border rounded-sm parameter-value parameter-text"--}}
        {{--                   placeholder="Value"--}}
        {{--                   value="{{ old("room_parameters.$i.value", $parameter->value ?? '') }}"--}}
        {{--                {{ (old("room_parameters.$i.type", $parameter->type ?? null) != \App\Enums\ValueType::String) ? 'hidden' : '' }}>--}}

        {{--            <!-- Number input for Number type -->--}}
        {{--            <input type="number" name="room_parameters[{{ $i ?? '' }}][value]"--}}
        {{--                   class="form-input w-full p-3 border rounded-sm parameter-value parameter-number"--}}
        {{--                   placeholder="Value"--}}
        {{--                   value="{{ old("room_parameters.$i.value", $parameter->value ?? '') }}"--}}
        {{--                   step="any"--}}
        {{--                   title="Enter a numerical value"--}}
        {{--                   oninput="this.value = this.value.replace(/[^0-9.-]/g, '')"--}}
        {{--                {{ (old("room_parameters.$i.type", $parameter->type ?? null) !=\App\Enums\ValueType::Number) ? 'hidden' : '' }}>--}}

        {{--            <!-- Checkbox for Boolean type -->--}}
        {{--            <div class="parameter-value parameter-boolean flex justify-center"--}}
        {{--                {{ (old("room_parameters.$i.type", $parameter->type ?? null) != \App\Enums\ValueType::Boolean) ? 'hidden' : '' }}>--}}
        {{--                <input type="checkbox" name="room_parameters[{{ $i ?? '' }}][value]" value="1"--}}
        {{--                       class="w-6 h-6"--}}
        {{--                    {{ (old("room_parameters.$i.value", $parameter->value ?? '') == 1) ? 'checked' : '' }}>--}}
        {{--            </div>--}}

        <td class="p-3 w-1/3">
            <!-- Поле для тексту -->
            <input type="text" name="room_parameters[][value]"
                   value="{{ $parameterValue }}"

                   class="form-input w-full p-3 border rounded-sm parameter-value parameter-text
                   {{ ($parameterType == \App\Enums\ValueType::String) ? '' : 'hidden' }}
                   "
                   placeholder="Value"
            >

            <!-- Поле для чисел -->
            <input type="number" name="room_parameters[][value]"
                   class="form-input w-full p-3 border rounded-sm parameter-value parameter-number
                    {{ ($parameterType == \App\Enums\ValueType::Number) ? '' : 'hidden' }}
                   "
                   placeholder="Value"
                   step="any"
                   title="Введіть числове значення"
                   value="{{ $parameterValue }}"
                   oninput="this.value = this.value.replace(/[^0-9.-]/g, '')"
            >
            <!-- Чекбокс -->
            <div class="parameter-value parameter-boolean flex justify-center
               {{ ($parameterType == \App\Enums\ValueType::Boolean) ? '' : 'hidden' }}
            ">
                <input type="checkbox" name="room_parameters[][value]"
                       {{ ($parameterValue == 1) ? 'checked' : '' }}
                       class="w-6 h-6"
                >

            </div>
        </td>

        <td class="p-3 w-[60px] text-center">
            <button type="button" class="btn btn-error rounded-md px-4 py-3 remove-parameter">
                <i class="fas fa-trash-alt"></i>
            </button>
        </td>
    </tr>
    </tbody>

</table>
