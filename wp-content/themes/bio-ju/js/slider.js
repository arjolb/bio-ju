let slideDot = document.querySelector('.hero__slider--dots');
let activeDot = document.querySelector('.hero__slider--dots-active');

let sliderOne = document.querySelector('.hero__slider-1');
let sliderTwo = document.querySelector('.hero__slider-2');
let sliderThree = document.querySelector('.hero__slider-3');

let activeSlide = sliderOne;

if (slideDot) {
    slideDot.addEventListener('click',function(e){

        if (e.target.classList.contains('hero__slider--dots')) {
            return;
        }
    
        // console.log(e.target);
        
        e.target.appendChild(activeDot);
        let className = e.target.classList[0];
        let index = className[className.length-1];
        
        
        if (index==1) {
            activeSlide.classList.remove('active');
    
            sliderOne.classList.add('active');
            
            activeSlide = sliderOne;
        }
        if (index==2) {
            activeSlide.classList.remove('active');
            
            sliderTwo.classList.add('active');
    
            activeSlide = sliderTwo;
        }
        if (index==3) {
            activeSlide.classList.remove('active');
    
            sliderThree.classList.add('active');
    
            activeSlide = sliderThree;
           
        }
    
    });
}