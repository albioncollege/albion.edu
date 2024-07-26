var tabs = document.querySelectorAll('.tabs');
var mq = window.matchMedia("(min-width: 1025px)");
for (var i = 0; i < tabs.length; i++) {
  var tab = tabs[i];
  var toggleButtons = tab.querySelectorAll('.tabs__toggle');
  var mobileButtons = tab.querySelectorAll('.tabs__mobile__toggle');
  var tabItems = tab.querySelectorAll('.tabs__content__item');

  if (mq.matches) {
    var setActiveTab = toggleButtons[0];
    var setActiveMobileTab = mobileButtons[0];
    var setActiveContent = tabItems[0];

    setActiveTab.classList.add('tabs__toggle--active');
    setActiveTab.setAttribute('aria-expanded', 'true');

    setActiveContent.setAttribute('aria-hidden', 'false');
    setActiveContent.classList.add('tabs__content__item--active');
  }
  
  var toggle = function toggle(e) {
    var target = this;
    var toggleButtons = target.parentNode.querySelectorAll('.tabs__toggle');
    var mobileButtons = target.parentNode.parentNode.querySelectorAll('.tabs__mobile__toggle');
    var tabItems = target.parentNode.parentNode.querySelectorAll('.tabs__content__item');
    if (!mq.matches) {
      target.classList.toggle('tabs__toggle--active');
      target.nextElementSibling.classList.toggle('mobile__tabs__content__item--active');
      var ariaToggle = target.getAttribute('aria-expanded');
      if (ariaToggle === 'true') {
        target.setAttribute("aria-expanded", 'false');
        target.nextElementSibling.setAttribute('aria-hidden', 'true')
      }
      else {
        target.setAttribute('aria-expanded', 'true');
        target.nextElementSibling.setAttribute('aria-hidden', 'false');
      }
    }
    else {
      for (var t = 0; t < toggleButtons.length; t++) {
        var toggleButton = toggleButtons[t];
        var mobileButton = mobileButtons[t];
        var tabItem = tabItems[t];
        if (toggleButton === target) {
          toggleButton.classList.add('tabs__toggle--active');
          toggleButton.setAttribute('aria-expanded', 'true');
          mobileButton.classList.add('tabs__toggle--active');
          mobileButton.setAttribute('aria-expanded', 'true');
          tabItem.classList.add('tabs__content__item--active');
          tabItem.classList.add('mobile__tabs__content__item--active');
          tabItem.setAttribute('aria-hidden', 'false');
        }
        else {
          toggleButton.classList.remove('tabs__toggle--active');
          toggleButton.setAttribute('aria-expanded', 'false');
          mobileButton.classList.remove('tabs__toggle--active');
          mobileButton.setAttribute('aria-expanded', 'false');
          tabItem.classList.remove('tabs__content__item--active');
          tabItem.classList.remove('mobile__tabs__content__item--active');
          tabItem.setAttribute('aria-hidden', 'true');
        }
      }
    }
  };
  
  for (var z = 0; z < toggleButtons.length; z++) {
    var toggleButton = toggleButtons[z];
    toggleButton.addEventListener('click', toggle);
  }

  for (var m = 0; m < mobileButtons.length; m++) {
    var mobileButton = mobileButtons[m];
    mobileButton.addEventListener('click', toggle);
  }
}

var scroll = function (e) {
  var anchor = window.location.hash;
  var ele = document.getElementById(anchor.substr(1));
  if (anchor && ele.classList.contains('tabs__toggle')) {
    if (mq.matches) {
      e.preventDefault();
      var offset = 86;
      var bodyRect = document
      .body
      .getBoundingClientRect()
      .top;
      var elementRect = ele
      .getBoundingClientRect()
      .top;
      var elementPosition = elementRect - bodyRect;
      var offsetPosition = elementPosition - offset;
      window.scrollTo({top: offsetPosition, behavior: "smooth"});
    }
    
    var newToggle = ele;
    newToggle.click();
    newToggle.blur();
  }
}

window.addEventListener('load', scroll);





// const imgArea = document.getElementById("picArea");

// var images = [
//   "https://picsum.photos/1208/600?asfee", "https://picsum.photos/1208/600?asdfas" ];
// var currentImage = 0;

// function changeImage() {
// 	currentImage++;
// 	if (currentImage > images.length - 1) {
// 	  currentImage = 0;
// 	}
// 	imgArea.style.backgroundImage = "url(' "+ images[currentImage] + "')";

// }
// setInterval(function(){
// 	changeImage();
// }, 6000);