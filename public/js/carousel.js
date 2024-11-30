let currentIndex = 0;
const slides = document.querySelectorAll('.carousel-slide');
const totalSlides = slides.length;


function updateCarousel() {
    const offset = -currentIndex * 101.5;
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.transform = `translateX(${offset}%)`;
    }
}

function nextSlide() {
    currentIndex = (currentIndex + 1) % totalSlides;
    updateCarousel();
}

function prevSlide() {
    currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
    updateCarousel();
}


setInterval(nextSlide, 3000);
