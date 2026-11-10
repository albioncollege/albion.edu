// show the lightbox with content of choice (optional parameter)


addEventListener("load", (event) => {

    const searchInput = document.querySelector('.area-filter-search'); // adjust selector as needed
    const categorySelect = document.querySelector('.area-filter-category'); // adjust selector as needed
    const entries = document.querySelectorAll('.area-listing .area-entry');

    if (!searchInput || !categorySelect) return;

    const handleFilter = () => {
        const query = searchInput.value.trim().toLowerCase();
        const selectedCategory = categorySelect.value; // empty string means no filter

        entries.forEach(entry => {
            const title = entry.textContent.trim().toLowerCase();
            const categories = entry.dataset.category ? entry.dataset.category.split(',') : [];

            const matchesSearch = !query || title.includes(query);
            const matchesCategory = selectedCategory === '' || categories.includes(selectedCategory);

            const parentA = entry.parentNode; // <a>
            if (matchesSearch && matchesCategory) {
                // Hide non‑matching entries
                if (!parentA.classList.contains('visible')) {
                    parentA.classList.add('visible');
                }
            } else {
                // Hide non‑matching entries
                if (parentA.classList.contains('visible')) {
                    parentA.classList.remove('visible');
                }
            }
        });
    };

    searchInput.addEventListener('input', handleFilter);
    categorySelect.addEventListener('change', handleFilter);

});