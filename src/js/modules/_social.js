//import minimodal from 'minimodal';
import dev from './_env';

import Flickity from 'flickity';
import 'flickity-imagesloaded';

import utils from 'fizzy-ui-utils';

import MultiClamp from 'multi-clamp';

const social = document.querySelector('.social__grid')

if (social) {
  const feed = social.getAttribute('data-feedUrl');

  (async () => {

    const grid = document.querySelector('.social__grid');

    const url = 'https://www.juicer.io/api/feeds/' + feed + '?per=' + 30 + '&page=' + 1 + '&filter=Instagram';

    const getData = async () => {
      const response = await fetch(url);
      const json = await response.json();
      const dirty = json.posts.items;
      return removeDuplicates(dirty);
    }

    function removeDuplicates(jsonAll) {
      let arr = [];
      let collection = [];

      jsonAll.forEach((value) => {
        if (!arr.includes(value.external_id)) {
          arr.push(value.external_id);
          collection.push(value);
        }
      });
      return collection;
    }

    const posts = await getData();



    const itemTemplate = (post, index) => {
      const social = post.source.source.toLowerCase();
      const socialIcon = 'icon-' + social;

      let urlPath;
      if (dev) {
        urlPath = "";
      }
      else {
        urlPath = "/wp-content/themes/albion";
      }

      const numbers = ["one", "two", "three", "four"];
      const number = numbers[index];
  
      return `
      <div class="social-slider__content-wrapper">
        <a href="${post.full_url}" class="social-slider__content social-modal social__img__${number}" style="background-image: url('${post.image}');">
          <div class="social-slider__overlay">
            <div class="social-slider__text">
              ${post.unformatted_message}
            </div>
          </div>
        </a>
      </div>`
    }

    const updateItems = (posts, startt, endd) => {
      //let html = '<div class="social__page">';
      let html = '';
      posts.slice(startt,endd).forEach((post, index) => {
        html += itemTemplate(post, index);
      });
      //html += '</div>';

      grid.insertAdjacentHTML('afterbegin', html)
    }

    updateItems(posts, 0, 4);
    updateItems(posts, 5, 9);
    updateItems(posts, 10, 14);
    updateItems(posts, 15, 19);

    const messagesTwo = document.querySelectorAll('.social__img__two .social-slider__text');
    const messagesThree = document.querySelectorAll('.social__img__three .social-slider__text');
    const messagesOne = document.querySelectorAll('.social__img__one .social-slider__text');
    const messagesFour = document.querySelectorAll('.social__img__four .social-slider__text');

    //const targets = document.querySelectorAll(".social-modal");

    Array.from(messagesTwo).forEach(target => {
      new MultiClamp(target, {
        ellipsis: '...',
        clamp: 8
      });
    });
    Array.from(messagesThree).forEach(target => {
      new MultiClamp(target, {
        ellipsis: '...',
        clamp: 8
      });
    });
    Array.from(messagesOne).forEach(target => {
      new MultiClamp(target, {
        ellipsis: '...',
        clamp: 13
      });
    });
    Array.from(messagesFour).forEach(target => {
      new MultiClamp(target, {
        ellipsis: '...',
        clamp: 13
      });
    });

    const sliders = document.querySelectorAll('.social__grid');

    [...sliders].forEach((slider) => {
      const textContent = slider.querySelector('.social-slider__contents');

      const slides = slider.querySelectorAll('.social-slider__content-wrapper');

      if (slides.length > 1) {
        const textContent = new Flickity(slider, {
          cellAlign: 'left',
          cellSelector: '.social-slider__content-wrapper',
          setGallerySize: false,
          imagesLoaded: true,
          groupCells: true,
          prevNextButtons: false,
          //arrowShape: 'M0,0v100h100V0H0z M51.1,37.1v10.2h10.8v4.9H51.1v10.2L38.5,49.8L51.1,37.1z',
          pageDots: false
        });
        // elements
        var cellsButtonGroup = document.querySelector('.social-slider__nav');
        var cellsButtons = utils.makeArray( cellsButtonGroup.children );

        // var checkIndex = function (event) {
        //   // enable/disable previous/next buttons
        //   if ( !textContent.cells[ textContent.selectedIndex - 1 ] ) {
        //     // on first cell
        //     previousButton.setAttribute( 'disabled', 'disabled' );
        //   } else if ( textContent.selectedIndex === 3 ) {
        //     // on last cell
        //     nextButton.setAttribute( 'disabled', 'disabled' );
        //   } else {
        //     previousButton.removeAttribute('disabled');
        //     nextButton.removeAttribute('disabled');
        //   }
        // };

        //window.addEventListener('load', checkIndex, false);

        // cell select
        cellsButtonGroup.addEventListener( 'click', function( event ) {
          var index = cellsButtons.indexOf( event.target );
          textContent.select( index );
        });
        // previous
        var previousButton = document.querySelector('.social-slider__previous');
        previousButton.addEventListener( 'click', function() {
          textContent.previous();
          //checkIndex();
        });
        // next
        var nextButton = document.querySelector('.social-slider__next');
        nextButton.addEventListener( 'click', function() {
          textContent.next();
          //checkIndex();
        });
      } else {
        const textContent = new Flickity(slider, {
          cellAlign: 'left',
          cellSelector: '.social-slider__content-wrapper',
          setGallerySize: false,
          imagesLoaded: true,
          prevNextButtons: false,
          //arrowShape: 'M0,0v100h100V0H0z M51.1,37.1v10.2h10.8v4.9H51.1v10.2L38.5,49.8L51.1,37.1z',
          pageDots: false
        });
      }
    });

  })();
}