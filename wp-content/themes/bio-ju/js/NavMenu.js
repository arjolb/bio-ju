let menuBtn = document.querySelector('.primary-nav__navigation--btn');

menuBtn.addEventListener('click',function(e){
    e.stopPropagation();

    if (e.target.classList.contains('primary-nav__navigation--menu')) {
        return ;
    }

    menuBtn.classList.toggle('active');
    document.querySelector('.primary-nav__navigation--links').classList.toggle('hide');
});

document.querySelector('.primary-nav__navigation--menu').addEventListener('click',function(e){
    e.stopPropagation();
});

document.addEventListener('click',function (e) {
    if(menuBtn.classList.contains('active')){
        menuBtn.classList.toggle('active');
        document.querySelector('.primary-nav__navigation--links').classList.toggle('hide');
    }
})