document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('input[data-type="validated-number"]').forEach(input => {
        input.addEventListener('input', () => {
            let val = input.value;

            // Видалення всіх символів, крім цифр і мінуса
            val = val.replace(/[^0-9\-]/g, '');

            // Якщо формат некоректний — обрізаємо
            if (val !== '' && !/^[-]?\d*$/.test(val)) {
                val = val.slice(0, -1);
            }

            // Обмеження в межах мінімуму і максимуму
            const min = parseInt(input.dataset.min);
            const max = parseInt(input.dataset.max);
            const num = parseInt(val);
            if (!isNaN(num)) {
                if (num < min) val = min;
                if (num > max) val = max;
            }

            input.value = val;
        });
    });
});
