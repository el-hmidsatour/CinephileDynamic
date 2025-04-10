document.addEventListener('DOMContentLoaded', function() {
    // Initialisation des carrousels
    const carousels = document.querySelectorAll('.carousel');
    
    carousels.forEach(carousel => {
        const track = carousel.querySelector('.carousel-track');
        const slides = Array.from(carousel.querySelectorAll('.carousel-slide'));
        const nextBtn = carousel.parentElement.querySelector('.carousel-next');
        const prevBtn = carousel.parentElement.querySelector('.carousel-prev');
        
        const slideWidth = slides[0].getBoundingClientRect().width;
        let currentPosition = 0;
        let visibleSlides = 5; // Par défaut pour grands écrans
        
        // Ajuster selon la largeur de l'écran
        function updateVisibleSlides() {
            const width = window.innerWidth;
            if (width < 480) visibleSlides = 1;
            else if (width < 768) visibleSlides = 2;
            else if (width < 992) visibleSlides = 3;
            else if (width < 1200) visibleSlides = 4;
            else visibleSlides = 5;
        }
        
        updateVisibleSlides();
        window.addEventListener('resize', updateVisibleSlides);
        
        // Déplacer le carrousel
        function moveCarousel() {
            track.style.transform = `translateX(-${currentPosition * (100 / visibleSlides)}%)`;
        }
        
        // Bouton suivant
        nextBtn.addEventListener('click', () => {
            if (currentPosition < slides.length - visibleSlides) {
                currentPosition++;
                moveCarousel();
            }
        });
        
        // Bouton précédent
        prevBtn.addEventListener('click', () => {
            if (currentPosition > 0) {
                currentPosition--;
                moveCarousel();
            }
        });
        
        // Navigation au clavier
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowRight') {
                if (currentPosition < slides.length - visibleSlides) {
                    currentPosition++;
                    moveCarousel();
                }
            } else if (e.key === 'ArrowLeft') {
                if (currentPosition > 0) {
                    currentPosition--;
                    moveCarousel();
                }
            }
        });
    });
    
    /* Mode sombre/clair
    const toggle = document.querySelector('.toggle');
    const toggleBall = document.querySelector('.toggle-ball');
    const elements = [
        document.querySelector('.container'),
        document.querySelector('.navbar-container'),
        document.querySelector('.sidebar')
    ];
    
    toggle.addEventListener('click', () => {
        elements.forEach(element => element.classList.toggle('active'));
        toggleBall.classList.toggle('active');
    });*/
});