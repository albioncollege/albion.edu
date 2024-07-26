const toggleButtons = document.querySelectorAll('.has-submenu > button');

const toggle = function toggle() {
  if (this.parentNode.classList.contains('open')) {
    this.parentNode.classList.remove('open');
    this.setAttribute('aria-expanded', 'false');
  }
  else {
    this.parentNode.classList.add('open');
    this.setAttribute('aria-expanded', 'true');
  }
};

[...toggleButtons].forEach((toggleButton) => {
  toggleButton.addEventListener('click', toggle);
});
