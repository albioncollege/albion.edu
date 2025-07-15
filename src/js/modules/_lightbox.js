
// show the lightbox with content of choice (optional parameter)


addEventListener("load", (event) => {

    // handle clicks on the lightbox shade
    document.querySelector(".lightbox-shade").addEventListener( 'click', (event) => {
        if ( !event.target.closest('.lightbox-inner') && !event.target.closest('.lightbox-content') ) {
            document.querySelector(".lightbox").classList.remove('visible');
        }
    });

    // handle clicking on the close button
    document.querySelector(".lightbox-close").addEventListener( 'click', (event) => {
        document.querySelector(".lightbox").classList.remove('visible');
    });

});

