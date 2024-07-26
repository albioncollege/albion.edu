const header = document.querySelector('.header');
const searchToggles = document.querySelectorAll('.toggle-search');
const menuToggles = document.querySelectorAll('.toggle-menu');
const infoToggles = document.querySelectorAll('.toggle-info');

const createFocusTrap = require('focus-trap');
let focusTrapViewSearch, focusTrapViewMenu, focusTrapViewInfo;


const activateSearch = () => {
  document.body.style.overflow = 'hidden';
  header.classList.add('search-active');
  searchToggles.forEach((searchToggle) => {
    searchToggle.setAttribute('aria-expanded', 'true');
  });

  focusTrapViewSearch = createFocusTrap('.search', {
    initialFocus: () => {
      return document.querySelector('.search__input');
    },
    clickOutsideDeactivates: false,
    onDeactivate: () => {
      deactivateSearch(false);
    }
  });

  focusTrapViewSearch.activate();  
  
}

const deactivateSearch = (deactivateSearchTrap = true) => {
  if (deactivateSearchTrap && focusTrapViewSearch) {
    focusTrapViewSearch.deactivate();
  }

  document.body.style.overflow = '';
  header.classList.remove('search-active');
  searchToggles.forEach((searchToggle) => {
    searchToggle.setAttribute('aria-expanded', 'false');
  });
}
const toggleSearch = () => {
  if (header.classList.contains('search-active')) {
    deactivateSearch();
  }
  else {
    activateSearch();
  }
}
const activateMenu = () => {
  document.body.style.overflow = 'hidden';
  header.classList.add('menu-active');
  menuToggles.forEach((menuToggle) => {
    menuToggle.setAttribute('aria-expanded', 'true');
  });

  focusTrapViewMenu = createFocusTrap('.nav', {
    clickOutsideDeactivates: false,
    onDeactivate: () => {
      deactivateMenu(false);
    }
  });

  focusTrapViewMenu.activate();  
}
const deactivateMenu = (deactivateMenuTrap = true) => {
  if (deactivateMenuTrap && focusTrapViewMenu) {
    focusTrapViewMenu.deactivate();
  }
  document.body.style.overflow = '';
  header.classList.remove('menu-active');
  menuToggles.forEach((menuToggle) => {
    menuToggle.setAttribute('aria-expanded', 'false');
  });

  deactivateInfo();
  
}
const toggleMenu = () => {
  if (header.classList.contains('menu-active')) {
    deactivateMenu();
  }
  else {
    activateMenu();
  }
}

const activateInfo = () => {
  header.classList.add('info-active');
  infoToggles.forEach((infoToggle) => {
    infoToggle.setAttribute('aria-expanded', 'true');
  });

  focusTrapViewInfo = createFocusTrap('.header__info', {
    initialFocus: () => {
      return document.querySelector('.nav__info-toggle--back');
    },
    clickOutsideDeactivates: false,
    onDeactivate: () => {
      deactivateInfo(false);
    }
  });

  focusTrapViewInfo.activate();  
}

const deactivateInfo = (deactivateInfoTrap = true) => {
  if (deactivateInfoTrap && focusTrapViewInfo) {
    focusTrapViewInfo.deactivate();
  }
  header.classList.remove('info-active');
  infoToggles.forEach((infoToggle) => {
    infoToggle.setAttribute('aria-expanded', 'false');
  });
}

const toggleInfo = () => {
  if (header.classList.contains('info-active')) {
    deactivateInfo();
  }
  else {
    activateInfo();
  }
}

searchToggles.forEach((searchToggle) => {
  searchToggle.addEventListener('click', toggleSearch);
});

menuToggles.forEach((menuToggle) => {
  menuToggle.addEventListener('click', toggleMenu);
});

infoToggles.forEach((infoToggle) => {
  infoToggle.addEventListener('click', toggleInfo);
});



const checkFixed = function checkFixed(e) {
  const { boundingClientRect, target } = e[0];
  if (boundingClientRect.y <= boundingClientRect.height * -1) {
    target.classList.add('header--pinned');
  } else {
    target.classList.remove('header--pinned');
  }
};

const observerFixed = new IntersectionObserver(checkFixed);

observerFixed.observe(header);
