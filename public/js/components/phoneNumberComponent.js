document.addEventListener('DOMContentLoaded', function() {
    const phoneInput = document.querySelector("#phone_number");
    const iti = window.intlTelInput(phoneInput, {
        initialCountry: "ua",
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        dropdownContainer: document.body,
        autoPlaceholder: "aggressive",
        customPlaceholder: function (selectedCountryPlaceholder, selectedCountryData) {
            return selectedCountryPlaceholder;
        }
    });
});
