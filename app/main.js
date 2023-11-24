const menuButton = document.querySelector('.header__menu');
const menu = document.querySelector('.sidebar-menu');

menuButton = addEventListener('click', () => {
    menu.classList.toggle('sidebar-menu--active');
})