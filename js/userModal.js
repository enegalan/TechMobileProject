document.addEventListener('DOMContentLoaded', function (event) {
    const dropdownTrigger = document.querySelector('.js-dropdown__trigger');
    const dropdown = document.querySelector('.js-dropdown');

    dropdownTrigger.addEventListener('click', function (e) {
        if (!dropdown.classList.contains('is-active')) {
            dropdown.classList.add('is-active');
            e.stopPropagation();
            e.preventDefault();
        }
    });

    document.querySelector('html').addEventListener('click', function (e) {
        if (dropdown.classList.contains('is-active') && !dropdown.contains(e.target)) {
            dropdown.classList.remove('is-active');
            e.preventDefault();
        }
    });
});