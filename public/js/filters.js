document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('filter-toggle-btn');
    const filterContent = document.querySelector('.filters-content');

    if (toggleBtn && filterContent) {
        toggleBtn.addEventListener('click', function () {
            filterContent.classList.toggle('d-none');
        });
    }
});
