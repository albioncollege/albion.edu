import Flickity from 'flickity';
import 'flickity-imagesloaded';
import anime from 'animejs/lib/anime.es.js';
import imagesLoaded from 'imagesloaded';

const sliders = document.querySelectorAll('.media--slider');

[...sliders].forEach((slider) => {
  const slide = slider.querySelectorAll('.media__slide');
  
  if (slide.length > 1) {
    const flkty = new Flickity(slider, {
      imagesLoaded: true,
      pageDots: false,
      adaptiveHeight: true,
      arrowShape: 'M0,0v100h100V0H0z M51.1,37.1v10.2h10.8v4.9H51.1v10.2L38.5,49.8L51.1,37.1z',
    });  
  }
  
});
