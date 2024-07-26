const splashes = document.querySelectorAll('.splash');
import anime from 'animejs/lib/anime.es.js';

[...splashes].forEach((splash) => {
  let effect;
  const control = splash.querySelector('.splash__control');
  
  const headlines = splash.querySelector('.splash__content__headlines');
  
  if (headlines) {
    //const strings = headlines.dataset.strings.split(';');
    
    let stringIdx = 0;
    let headline = {};
    headline.opacityIn = [0,1];
    headline.transformIn = [100, 0];
    headline.transformOut = [-50];
    headline.durationIn = 2000;
    // headline.durationOut = 2000;
    // headline.delay = 4000;
    
    effect = anime.timeline({
      loop: false,
      easing: 'easeOutExpo',
      delay: 1000
    });
    
    effect
    .add({
      targets: `.splash__content__headlines`,
      opacity: headline.opacityIn,
      translateY: headline.transformIn,
      duration: headline.durationIn
    })
    // .add({
    //   targets: `.splash__content__headlines`,
    //   opacity: 0,
    //   translateY: headline.transformOut,
    //   duration: headline.durationOut,
    //   delay: headline.delay,
    // })
  }
  
  if (control) {
    const video = control.nextElementSibling.querySelector('.splash__video video');
    
    const toggle = function toggle() {
      if (video.paused) {
        video.play();
        control.classList.remove('video--paused');
        // if (effect) {
        //   effect.play();
        // }
      } else {
        video.pause();
        control.classList.add('video--paused');
        // if (effect) {
        //   effect.pause();
        // }
      }
    };
    
    video.addEventListener('paused', () => {
      control.classList.add('video--paused');
    });
    
    control.addEventListener('click', toggle);
  }
});
