    document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('#roomSampleForm');
    const saveButton = document.querySelector('#saveButton');

    if (!form || !saveButton) return;

    const requiredFields = form.querySelectorAll('[required]');

    const checkRequiredFields = () => {
    let allFilled = true;

    requiredFields.forEach(field => {
    if (!field.value.trim()) {
    allFilled = false;
}
});

    saveButton.disabled = !allFilled;
};

    // Повісити індивідуальний input/change event на кожне поле
    requiredFields.forEach(field => {
    const eventType = field.tagName === 'SELECT' ? 'change' : 'input';
    field.addEventListener(eventType, checkRequiredFields);
});

    checkRequiredFields(); // первинна перевірка при завантаженні
});
