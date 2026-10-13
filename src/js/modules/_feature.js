// select all showcase containers in the page
const featureContainers = document.querySelectorAll('.feature__component__v3');

// loop through the showcase containers (handles multiple showcases)
[...featureContainers].forEach((featureContainer) => {

    // get the showcase and controls
    const showcase = featureContainer.querySelector('.feature__grid__v3');
    const controls = featureContainer.querySelector('.feature__grid__controls');


    // function to advance to the next slide
    // we need this for both the controls and the auto-advance feature
    var nextSlide = function() {
        // get and store the current slide and what we expect is the next one (if it exists)
        var currentSlide = showcase.querySelector('.feature__card__v3.visible');
        var nextSlide = currentSlide.nextElementSibling;

        // remove the active class from the current slide
        currentSlide.classList.remove("visible");
        //controls.querySelector('a.active').classList.remove("active");

        // if we don't have a next slide 
        if (nextSlide === null) {

            // select the first slide in the list
            showcase.querySelectorAll('.feature__card__v3')[0].classList.add('visible');
            //controls.querySelector('a:first-child').classList.add('active');

        } else {

            // otherwise, make next slide active
            var slideId = nextSlide.dataset.slide;
            nextSlide.classList.add("visible");
            //controls.querySelector('[data-slide="' + slideId + '"]').classList.add('active');

        }
    }


    // select all the controls
    controls.querySelectorAll('div').forEach((control) => {

        // when the user clicks a control
        control.addEventListener('click', function(event) {

            // if we're trying to go to the next slide
            if (this.className.match('next')) {

                nextSlide();

            } else if (this.className.match('prev')) {

                // get and store the current slide and what we expect is the next one (if it exists)
                var currentSlide = showcase.querySelector('.feature__card__v3.visible');
                var prevSlide = currentSlide.previousElementSibling;

                // remove the active class from the current slide
                currentSlide.classList.remove("visible");

                // if we don't have a next slide
                if (prevSlide === null) {

                    var allSlides = showcase.querySelectorAll('.feature__card__v3');

                    // select the first slide in the list
                    allSlides[allSlides.length - 1].classList.add('visible');

                } else {

                    // otherwise, make next slide active
                    prevSlide.classList.add("visible");

                }

            }

        });

    });

    // set showcase initial height when the first image is loaded.
    setTimeout(function() {

        // once we're loaded up, set a timer to auto-rotate the slides.
        if (showcase.querySelectorAll('.feature__card__v3').length > 1) {
            var autoRotate = setInterval(nextSlide, 10000);
        }
    }, 500);

});