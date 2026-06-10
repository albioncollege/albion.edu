// show the lightbox with content of choice (optional parameter)


addEventListener("load", (event) => {
    var catSelect = document.querySelector(".quick-category-nav");
    // handle clicks on the lightbox shade
    catSelect.addEventListener('change', (event) => {
        location.href = '/category/' + catSelect.value + '/';
    });

});