  
const contactLists = document.querySelectorAll( '.people' );

// loop through contact lists
[...contactLists].forEach( (contactList) => {
    var contactSearch = contactList.querySelector( '.people-search input' );
    var contactEntries = contactList.querySelectorAll( '.people-listing .person-entry' );
    console.log( contactEntries );

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
        })
    });

})

