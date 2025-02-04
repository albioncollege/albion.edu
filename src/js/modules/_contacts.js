

const contactLists = document.querySelectorAll( '.people' );

// loop through contact lists
[...contactLists].forEach( (contactList) => {
    var contactSearch = contactList.querySelector( '.people-search input' );
    var contactEntries = contactList.querySelectorAll( '.people-listing .person-entry' );

    if ( contactEntries != null ) {
        localStorage.setItem( 'contactListingName', document.title.replace( ' | Albion College', '' ) );
        localStorage.setItem( 'contactListingURL', window.location.href )
    }

    if ( contactSearch != null ) {
        // search event listener
        contactSearch.addEventListener( 'keyup', (event) => {
            
            // store the search term
            var searchTerm = contactSearch.value;

            // loop through the entries and show/hide based on match
            [...contactEntries].forEach( (contact) => {
                if ( ( contact.innerHTML ).toLowerCase().search( searchTerm.toLowerCase() ) > 0 || searchTerm.length === 0 ) {
                    contact.classList.add("visible");
                } else {
                    contact.classList.remove("visible");
                }
            });
            
        });
    }

})


addEventListener("load", (event) => {
    
    // if we're on a single bio page
    if ( document.body.classList.contains( 'single-contact_card' ) ) {

        // get stored contact listing values
        let contactListingName = localStorage.getItem( 'contactListingName' );
        let contactListingURL = localStorage.getItem( 'contactListingURL' );

        // adjust the breadcrumb with correct 'back' value
        document.querySelector( '.breadcrumb span span' ).innerHTML = '<a href="'+contactListingURL+'">'+contactListingName+'</a>';

    }
   
});

