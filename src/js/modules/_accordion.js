const toggleButtons = document.querySelectorAll('.accordion__toggle');

const toggle = function toggle() {
  this.classList.toggle('active');
};

[...toggleButtons].forEach((toggleButton) => {
  toggleButton.addEventListener('click', toggle);
});
