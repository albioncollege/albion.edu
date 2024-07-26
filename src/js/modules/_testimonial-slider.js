import Flickity from 'flickity';
import 'flickity-imagesloaded';
import 'flickity-as-nav-for';
import utils from 'fizzy-ui-utils';

const sliders = document.querySelectorAll('.testimonial-slider__container');

[...sliders].forEach((slider) => {
  const textContent = slider.querySelector('.testimonial-slider__contents');
  const mediaContent = slider.querySelector('.testimonial-slider__items');
  const sliderCounter = slider.querySelector('.testimonial-slider__counter');

  const slides = slider.querySelectorAll('.testimonial-slider__content');

  if (slides.length > 1) {
    const mediaFlkty = new Flickity(mediaContent, {
      cellAlign: 'right',
      cellSelector: '.testimonial-slider__media',
      imagesLoaded: true,
      prevNextButtons: false,
      pageDots: false,
    });

    // elements
    var cellsButtonGroup = document.querySelector('.testimonial-slider__nav');
    var cellsButtons = utils.makeArray( cellsButtonGroup.children );

    // cell select
    cellsButtonGroup.addEventListener( 'click', function( event ) {
      var index = cellsButtons.indexOf( event.target );
      mediaFlkty.select( index );
    });
    // previous
    var previousButton = document.querySelector('.testimonial-slider__previous');
    previousButton.addEventListener( 'click', function() {
      mediaFlkty.previous();
    });
    // next
    var nextButton = document.querySelector('.testimonial-slider__next');
    nextButton.addEventListener( 'click', function() {
      mediaFlkty.next();
    });

    if(sliderCounter) {
      function updateStatus() {
        var slideNumber = mediaFlkty.selectedIndex + 1;
        sliderCounter.textContent = slideNumber + '/' + mediaFlkty.slides.length;
      }
      updateStatus();
      mediaFlkty.on( 'select', updateStatus );
    }

  } else {
    slider.querySelector('.testimonial-slider__nav').style.display = 'none';
    const mediaFlkty = new Flickity(mediaContent, {
      cellAlign: 'right',
      cellSelector: '.testimonial-slider__media',
      imagesLoaded: true,
      prevNextButtons: false,
      pageDots: false,
    });
  }



  const textFlickity = new Flickity(textContent, {
    cellAlign: 'left',
    draggable: false,
    asNavFor: mediaContent,
    adaptiveHeight: true,
    prevNextButtons: false,
    pageDots: false
  });


  // const max = flkty.cells.length * 318 + (flkty.cells.length - 1) * 72;
  // const check = function check() {
  //   const width = slider.offsetWidth;
  //   if (width >= max) {
  //     slider.classList.add('testimonial-slider__slider--hide-nav');
  //   } else {
  //     slider.classList.remove('testimonial-slider__slider--hide-nav');
  //   }
  // };
  // window.addEventListener('load', check);
  // window.addEventListener('resize', check);
});
