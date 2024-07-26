import minimodal from 'minimodal';

const targets = document.querySelectorAll('[data-minimodal]');

[...targets].forEach((target) => {
  const modal = minimodal(target, {
    statusTimeout: 300,
    removeTimeout: 300,
    closeTimeout: 300,
    closeButtonHTML: 'Close',
  });
  modal.init();
});
