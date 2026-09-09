    <div class="container mx-auto px-4 py-12">

        <div id="carousel" class="relative">

            <div class="relative overflow-hidden rounded-lg shadow-xl bg-white">

                <div id="slideTrack" class="flex slide-transition">

                    <!-- Slide 1 -->
                    <div class="slide w-full md:w-1/3 flex-shrink-0 px-2 py-4">
                        <div class="rounded-lg overflow-hidden shadow-md h-full">

                            <div class="bg-gray-200 h-48 md:h-64 flex items-center justify-center">
                                <img src="https://picsum.photos/id/10/800/600" alt="Nature 1"
                                    class="w-full h-full object-cover">
                            </div>

                            <div class="p-4">
                                <h3 class="text-xl font-semibold">
                                    Nature 1
                                </h3>

                                <p class="text-gray-600 mt-2">
                                    Nature first
                                </p>
                            </div>

                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="slide w-full md:w-1/3 flex-shrink-0 px-2 py-4">
                        <div class="rounded-lg overflow-hidden shadow-md h-full">

                            <div class="bg-gray-200 h-48 md:h-64 flex items-center justify-center">
                                <img src="https://picsum.photos/id/11/800/600" alt="Nature 2"
                                    class="w-full h-full object-cover">
                            </div>

                            <div class="p-4">
                                <h3 class="text-xl font-semibold">
                                    Nature 2
                                </h3>

                                <p class="text-gray-600 mt-2">
                                    Nature second
                                </p>
                            </div>

                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="slide w-full md:w-1/3 flex-shrink-0 px-2 py-4">
                        <div class="rounded-lg overflow-hidden shadow-md h-full">

                            <div class="bg-gray-200 h-48 md:h-64 flex items-center justify-center">
                                <img src="https://picsum.photos/id/12/800/600" alt="Nature 3"
                                    class="w-full h-full object-cover">
                            </div>

                            <div class="p-4">
                                <h3 class="text-xl font-semibold">
                                    Nature 3
                                </h3>

                                <p class="text-gray-600 mt-2">
                                    Nature third
                                </p>
                            </div>

                        </div>
                    </div>

                    <!-- Slide 4 -->
                    <div class="slide w-full md:w-1/3 flex-shrink-0 px-2 py-4">
                        <div class="rounded-lg overflow-hidden shadow-md h-full">

                            <div class="bg-gray-200 h-48 md:h-64 flex items-center justify-center">
                                <img src="https://picsum.photos/id/13/800/600" alt="Nature 4"
                                    class="w-full h-full object-cover">
                            </div>

                            <div class="p-4">
                                <h3 class="text-xl font-semibold">
                                    Nature 4
                                </h3>

                                <p class="text-gray-600 mt-2">
                                    Nature last
                                </p>
                            </div>

                        </div>
                    </div>

                </div>
            </div>


            <!-- Botão anterior -->
            <button id="prevButton" type="button" class="absolute left-0 top-1/2 -translate-y-1/2
                       bg-white/80 hover:bg-white
                       rounded-full w-10 h-10
                       flex items-center justify-center
                       shadow-md z-10 -ml-4
                       disabled:opacity-50
                       disabled:cursor-not-allowed">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>


            <!-- Botão próximo -->
            <button id="nextButton" type="button" class="absolute right-0 top-1/2 -translate-y-1/2
                       bg-white/80 hover:bg-white
                       rounded-full w-10 h-10
                       flex items-center justify-center
                       shadow-md z-10 -mr-4
                       disabled:opacity-50
                       disabled:cursor-not-allowed">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>


            <!-- Indicadores -->
            <div id="indicators" class="flex justify-center mt-4 space-x-2"></div>

        </div>

    </div>

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const track = document.getElementById('slideTrack');
            const slides = document.querySelectorAll('.slide');
            const prevButton = document.getElementById('prevButton');
            const nextButton = document.getElementById('nextButton');
            const indicators = document.getElementById('indicators');

            let currentSlide = 0;
            let visibleSlides = 1;


            /*
            |--------------------------------------------------------------------------
            | Atualiza quantidade de slides visíveis
            |--------------------------------------------------------------------------
            */

            function updateVisibleSlides() {

                if (window.innerWidth < 768) {
                    visibleSlides = 1;
                } else {
                    visibleSlides = 3;
                }

                /*
                * Corrige o slide atual caso a tela seja redimensionada
                */
                const maxSlide = slides.length - visibleSlides;

                if (currentSlide > maxSlide) {
                    currentSlide = Math.max(0, maxSlide);
                }

                updateCarousel();
                createIndicators();
            }


            /*
            |--------------------------------------------------------------------------
            | Atualiza posição do carrossel
            |--------------------------------------------------------------------------
            */

            function updateCarousel() {

                const slidePercentage = 100 / visibleSlides;

                const translateX = currentSlide * slidePercentage;

                track.style.transform = `translateX(-${translateX}%)`;

                updateButtons();
                updateIndicators();
            }


            /*
            |--------------------------------------------------------------------------
            | Botões
            |--------------------------------------------------------------------------
            */

            function updateButtons() {

                const maxSlide = slides.length - visibleSlides;

                prevButton.disabled = currentSlide === 0;

                nextButton.disabled = currentSlide >= maxSlide;
            }


            /*
            |--------------------------------------------------------------------------
            | Próximo
            |--------------------------------------------------------------------------
            */

            function next() {

                const maxSlide = slides.length - visibleSlides;

                if (currentSlide < maxSlide) {

                    currentSlide++;

                    updateCarousel();
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Anterior
            |--------------------------------------------------------------------------
            */

            function prev() {

                if (currentSlide > 0) {

                    currentSlide--;

                    updateCarousel();
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Ir para slide
            |--------------------------------------------------------------------------
            */

            function goTo(index) {

                const maxSlide = slides.length - visibleSlides;

                currentSlide = Math.min(index, maxSlide);

                updateCarousel();
            }


            /*
            |--------------------------------------------------------------------------
            | Indicadores
            |--------------------------------------------------------------------------
            */

            function createIndicators() {

                indicators.innerHTML = '';

                const totalIndicators =
                    slides.length - visibleSlides + 1;


                for (let i = 0; i < totalIndicators; i++) {

                    const button = document.createElement('button');

                    button.type = 'button';

                    button.className =
                        'w-3 h-3 rounded-full transition-colors';


                    button.setAttribute(
                        'aria-label',
                        `Ir para slide ${i + 1}`
                    );


                    button.addEventListener(
                        'click',
                        function () {

                            goTo(i);

                        }
                    );


                    indicators.appendChild(button);
                }

                updateIndicators();
            }


            /*
            |--------------------------------------------------------------------------
            | Atualiza indicadores
            |--------------------------------------------------------------------------
            */

            function updateIndicators() {

                const buttons =
                    indicators.querySelectorAll('button');


                buttons.forEach(function (button, index) {

                    if (index === currentSlide) {

                        button.classList.remove('bg-gray-300');

                        button.classList.add('bg-blue-600');

                    } else {

                        button.classList.remove('bg-blue-600');

                        button.classList.add('bg-gray-300');

                    }

                });
            }


            /*
            |--------------------------------------------------------------------------
            | Erro nas imagens
            |--------------------------------------------------------------------------
            */

            slides.forEach(function (slide) {

                const image = slide.querySelector('img');

                image.addEventListener('error', function () {

                    image.src =
                        'https://picsum.photos/id/20/800/600';

                });

            });


            /*
            |--------------------------------------------------------------------------
            | Eventos
            |--------------------------------------------------------------------------
            */

            nextButton.addEventListener('click', next);

            prevButton.addEventListener('click', prev);


            window.addEventListener('resize', function () {

                updateVisibleSlides();

            });


            /*
            |--------------------------------------------------------------------------
            | Inicialização
            |--------------------------------------------------------------------------
            */

            updateVisibleSlides();

        });

    </script>