document.addEventListener('DOMContentLoaded', () => {
    const hamburger = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobile-menu-placeholder');
    const searchIcon = document.getElementById('search-icon');
    const searchField = document.getElementById('search-field');
    const carousels = document.querySelectorAll('[data-carousel]');

    if (hamburger && mobileMenu) {
        hamburger.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        mobileMenu.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });
    }

    if (searchIcon && searchField) {
        searchIcon.addEventListener('click', () => {
            searchField.classList.toggle('hidden');
        });

        document.addEventListener('click', (event) => {
            if (
                !searchField.classList.contains('hidden') &&
                !searchField.contains(event.target) &&
                !searchIcon.contains(event.target)
            ) {
                searchField.classList.add('hidden');
            }
        });
    }

    carousels.forEach((carousel) => {
        const wrapper = carousel.querySelector('.swiper-wrapper');
        const slides = Array.from(carousel.querySelectorAll('.swiper-slide'));
        const prevButton = carousel.querySelector('[data-carousel-prev]');
        const nextButton = carousel.querySelector('[data-carousel-next]');
        const autoplayMs = Number(carousel.dataset.autoplayMs || 5000);
        let currentIndex = 0;
        let autoplayId = null;

        const goToSlide = (index) => {
            if (!wrapper || slides.length === 0) {
                return;
            }

            currentIndex = (index + slides.length) % slides.length;
            wrapper.scrollTo({
                left: slides[currentIndex].offsetLeft,
                behavior: 'smooth',
            });
        };

        const startAutoplay = () => {
            if (slides.length <= 1 || autoplayMs <= 0) {
                return;
            }

            clearInterval(autoplayId);
            autoplayId = window.setInterval(() => {
                goToSlide(currentIndex + 1);
            }, autoplayMs);
        };

        const stopAutoplay = () => {
            clearInterval(autoplayId);
        };

        prevButton?.addEventListener('click', () => {
            goToSlide(currentIndex - 1);
            startAutoplay();
        });

        nextButton?.addEventListener('click', () => {
            goToSlide(currentIndex + 1);
            startAutoplay();
        });

        carousel.addEventListener('mouseenter', stopAutoplay);
        carousel.addEventListener('mouseleave', startAutoplay);

        wrapper?.addEventListener('scroll', () => {
            const wrapperLeft = wrapper.scrollLeft;
            let nearestIndex = 0;
            let nearestDistance = Number.POSITIVE_INFINITY;

            slides.forEach((slide, index) => {
                const distance = Math.abs(slide.offsetLeft - wrapperLeft);
                if (distance < nearestDistance) {
                    nearestDistance = distance;
                    nearestIndex = index;
                }
            });

            currentIndex = nearestIndex;
        });

        startAutoplay();
    });
});
