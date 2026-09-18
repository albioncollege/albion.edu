import Flickity from 'flickity';
import 'flickity-imagesloaded';

var elem = document.querySelector('.main-carousel');

var flkty = new Flickity( elem , {
   wrapAround: true,
   autoPlay: true,
   lazyLoad: true,
   prevNextButtons: false
});

// Update card text when image changes
const cards = document.querySelectorAll('.card');

flkty.on( 'change', function( index ) {
	function updateCards(index) {
		cards.forEach((card, cardIndex) => {
			card.classList.toggle('active', cardIndex === index);
		});
	}
	
	flkty.on('change', updateCards);
	updateCards(flkty.selectedIndex);
});