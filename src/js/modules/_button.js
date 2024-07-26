var scrollToTopBtn = document.querySelector('.scroll-top');
var rootElement = document.documentElement;

function handleScroll() {
  // Do something on scroll
  var scrollTotal = rootElement.scrollHeight - rootElement.clientHeight;
  if (rootElement.scrollTop / scrollTotal > 0.1) {
    // Show button
    scrollToTopBtn.classList.add('scroll-top--show');
  } else {
    // Hide button
    scrollToTopBtn.classList.remove('scroll-top--show');
  }
}

function scrollToTop() {
  // Scroll to top logic
  rootElement.scrollTo({
    top: 0,
    behavior: 'smooth',
  });
}

if (scrollToTopBtn) {
  scrollToTopBtn.addEventListener('click', scrollToTop);
  document.addEventListener('scroll', handleScroll);
}
