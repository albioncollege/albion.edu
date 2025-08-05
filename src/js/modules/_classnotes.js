

addEventListener("load", (event) => {
        
    const classNotes = document.querySelectorAll( '.alum-listing .alum' );

// loop through contact lists
    [...classNotes].forEach( (note) => {
        const noteContent = note.querySelector( '.alum-details').innerHTML;
        note.addEventListener( 'click', (event) => {
            document.querySelector( '.lightbox-content' ).innerHTML = noteContent;
            document.querySelector( '.lightbox' ).classList.add( 'visible' );
        });
    })
    
});

