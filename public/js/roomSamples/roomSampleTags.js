document.addEventListener("DOMContentLoaded", function () {
    const container = document.getElementById("roomParametersContainer");
    const addButton = document.getElementById("addParameterButton");
    const template = document.getElementById("roomParameterTemplate").innerHTML;

    // Додавання нового параметра
    addButton.addEventListener("click", function () {
        const newElement = document.createElement("div");
        newElement.innerHTML = template;
        container.appendChild(newElement.firstElementChild);
    });

    // Видалення параметра
    container.addEventListener("click", function (event) {
        if (event.target.closest(".remove-parameter")) {
            event.target.closest(".room-parameter").remove();
        }
    });

    // Обробка зміни типу параметра
    container.addEventListener("change", function (event) {
        if (event.target.classList.contains("parameter-type")) {
            const parameterRow = event.target.closest(".room-parameter");

            if (!parameterRow) return; // Перевірка, що блок існує

            console.log("Changed type to:", event.target.value);

            // Отримуємо всі варіанти полів значень
            const textInput = parameterRow.querySelector(".parameter-text");
            const numberInput = parameterRow.querySelector(".parameter-number");
            const booleanInput = parameterRow.querySelector(".parameter-boolean");

            // Приховуємо всі варіанти
            textInput.classList.add("hidden");
            numberInput.classList.add("hidden");
            booleanInput.classList.add("hidden");

            // Відображаємо потрібне поле
            if (event.target.value === "1") { // String
                textInput.classList.remove("hidden");
            } else if (event.target.value === "0") { // Number
                numberInput.classList.remove("hidden");
            } else if (event.target.value === "2") { // Boolean
                booleanInput.classList.remove("hidden");
            }

        }
    });
});
