
const swiper = new Swiper('#property-slider .swiper', {
    loop: true,
    slidesPerView: 1,
    spaceBetween: 10,
    centredSlides: true,
    breakpoints: {
        640: {
            slidesPerView: 1,
            spaceBetween: 10,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        1024: {
            slidesPerView: 4,
            spaceBetween: 30,
        }
    }
});

const tswiper = new Swiper('#testimonials-slider .swiper', {
    loop: true
});