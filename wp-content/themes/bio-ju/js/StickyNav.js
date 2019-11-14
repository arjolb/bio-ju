let primaryNav = document.querySelector('.primary-nav');
let c = document.querySelector('.primary-nav--container');


window.addEventListener('scroll',stickyNav);

function stickyNav(e) {
    let navOffset = c.offsetTop;
    let scrollPos = window.scrollY;
    
    if (scrollPos>navOffset) {
        primaryNav.classList.add('fixed');
        
    } else {
        primaryNav.classList.remove('fixed');
    }    
}