

// select all showcase containers in the page
const showcaseContainers = document.querySelectorAll( '.showcase-container' );

// loop through the showcase containers (handles multiple showcases)
[...showcaseContainers].forEach( (showcaseContainer) => {

    // get the showcase and controls
    const showcase = showcaseContainer.querySelector( '.showcase' );
    const controls = showcaseContainer.querySelector( '.controls' );


    // function to advance to the next slide
    // we need this for both the controls and the auto-advance feature
    var nextSlide = function(){
        // get and store the current slide and what we expect is the next one (if it exists)
        var currentSlide = showcase.querySelector('.slide.active');
        var nextSlide = currentSlide.nextElementSibling;

        // remove the active class from the current slide
        currentSlide.classList.remove("active");

        // if we don't have a next slide
        if ( nextSlide === null ) {
            
            // select the first slide in the list
            showcase.querySelectorAll('.slide')[0].classList.add('active');

        } else {

            // otherwise, make next slide active
            nextSlide.classList.add("active");

        }
    }


    // select all the controls
    controls.querySelectorAll('a').forEach( (control) => {

        // when the user clicks a control
        control.addEventListener( 'click', function( event ){

            // if we're trying to go to the next slide
            if ( this.className.match( 'next' ) ) {

                nextSlide();

            } else if ( this.className.match( 'prev' ) ) {

                // get and store the current slide and what we expect is the next one (if it exists)
                var currentSlide = showcase.querySelector('.slide.active');
                var prevSlide = currentSlide.previousElementSibling;

                // remove the active class from the current slide
                currentSlide.classList.remove("active");

                // if we don't have a next slide
                if ( prevSlide === null ) {
                    
                    var allSlides = showcase.querySelectorAll('.slide');

                    // select the first slide in the list
                    allSlides[ allSlides.length-1 ].classList.add('active');

                } else {

                    // otherwise, make next slide active
                    prevSlide.classList.add("active");

                }

            } else {

                // get and store the current slide
                var currentSlide = showcase.querySelector('.slide.active');

                // this is the catch-all for the controls, if it gets here, it means that
                // they selected a specific slide in the showcase by pushing
                var selectedSlide = showcase.querySelector( '[data-slide="'+this.dataset.slide+'"]' );
                console.log( selectedSlide );

                // remove the active class from the current slide
                currentSlide.classList.remove("active");

                // select the first slide in the list
                selectedSlide.classList.add('active');

            }

        });
        
    });

});
