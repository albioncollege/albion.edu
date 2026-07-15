// show the lightbox with content of choice (optional parameter)


addEventListener("load", (event) => {

    var catSelect = document.querySelector(".quick-category-nav");
    if (catSelect !== null) {
        catSelect.addEventListener('change', (event) => {
            location.href = '/category/' + catSelect.value + '/';
        });
    }

});