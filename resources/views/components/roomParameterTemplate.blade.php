<table class="w-full border-separate room-parameters-table">
    <tbody>
    <tr class="room-parameter">
        <td class="p-3 w-1/3">
            <input type="text" name="room_parameters[][name]" placeholder="Name"
                   class="form-input w-full p-3">
        </td>

        <td class="p-3 w-1/3">
            <select name="room_parameters[][type]" class="form-select parameter-type w-full p-3">
                <option value="1">String</option>
                <option value="0">Number</option>
                <option value="2">Boolean</option>
            </select>
        </td>

        <td class="p-3 w-1/3">
            <!-- Поле для тексту -->
            <input type="text" name="room_parameters[][value]"
                   class="form-input w-full p-3 border rounded-sm parameter-value parameter-text"
                   placeholder="Value">

            <!-- Поле для чисел -->
            <input type="number" name="room_parameters[][value]"
                   class="form-input w-full p-3 border rounded-sm parameter-value parameter-number hidden"
                   placeholder="Value"
                   step="any"
                   title="Введіть числове значення"
                   oninput="this.value = this.value.replace(/[^0-9.-]/g, '')">

            <!-- Чекбокс -->
            <div class="parameter-value parameter-boolean hidden flex justify-center">
                <input type="checkbox" name="room_parameters[][value]" value="1" class="w-6 h-6">
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
