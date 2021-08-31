document.addEventListener('DOMContentLoaded', function() {

  const btn = document.querySelector('.mobile-menu__btn');
  const menu = document.querySelector('.mobile-menu');

  btn.addEventListener('touchstart', function() {
    menu.classList.toggle('menu-open')
  });
});