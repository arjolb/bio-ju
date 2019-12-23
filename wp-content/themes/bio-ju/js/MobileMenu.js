let siteHeader = document.querySelector('.site-header');

let logo  = document.querySelector('.primary-nav__navigation--logo');
// let logoContainer = document.querySelector('.primary-nav__navigation li')



let menuIcon = document.querySelector('.site-header__menu-icon');

menuIcon.addEventListener('click',mobileMenu);


// function removeAddLogo() {
//     let style, width;
//     style = window.getComputedStyle(siteHeader);
//     width = style.getPropertyValue('width');

//     if (width=='200px') {
//         logoContainer.removeChild(logo);
//         siteHeader.append(logo);
//     }
// }


function mobileMenu(e) {
    menuIcon.classList.toggle('site-header__menu-icon--mobile-toggler');
    document.querySelector('.navs-container').classList.toggle('active');
    // siteHeader.classList.toggle('active');
}


// removeAddLogo();





let next = document.querySelector('.next');
let prev = document.querySelector('.prev');


if (next) {
    next.textContent='>';
}

if (prev) {
    prev.textContent='<';
}