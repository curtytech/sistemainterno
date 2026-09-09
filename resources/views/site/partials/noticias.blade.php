@php
if (! isset($noticias)) {
$noticias = \App\Models\Event::future()->limit(21)->get();
}
@endphp

<div class="events-container container mx-auto px-5 mb-5">
    <div class="container mx-auto max-w-screen-xl px-4 testimonials">
        <div class="text-center mb-12 lg:mb-20">
            <h2 class="text-5xl font-bold mb-4 text-primary">Notícias</h2>
            <p class="my-7">Acesse rapidamente as principais notícias.</p>
            <div class="flex flex-wrap items-center justify-center gap-3">
                <a href="{{ route('site.news.index') }}" class="inline-flex rounded-full border border-primary px-4 py-2 text-sm font-semibold text-primary transition hover:bg-primary hover:text-white">
                    Veja mais
                </a>
                <a href="{{ route('site.content.index') }}" class="inline-flex rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-primary hover:text-primary">
                    Ver tudo em uma página
                </a>
            </div>
        </div>
    </div>
    @if ($noticias->isNotEmpty())
    <div class="events-carousel relative">
        <div class="relative overflow-hidden rounded-lg ">
            <div class="events-slide-track flex slide-transition">
                @foreach($noticias as $evento)
                <div class="events-slide w-full md:w-1/3 flex-shrink-0 px-2 py-4">
                    <a
                        href="{{ route('site.news.show', $evento) }}"
                        class="block rounded-lg overflow-hidden shadow-md h-full transition hover:shadow-xl hover:-translate-y-0.5 duration-200">
                        <div class=" flex items-center justify-center">
                            <img
                                src="{{ $evento->image_url ?? '/assets/images/banner1.jpg' }}"
                                alt="{{ $evento->title }}"
                                class="w-full h-full object-contain"
                                onerror="this.onerror=null;this.src='/assets/images/banner1.jpg';">
                        </div>

                        <div class="p-4">
                            <div class="mb-3 flex items-center justify-between gap-2">
                                @if ($evento->category_name)
                                <span class="inline-flex rounded-full bg-primary/10 px-2.5 py-1 text-[11px] font-semibold uppercase tracking-widest text-primary">
                                    {{ $evento->category_name }}
                                </span>
                                @endif
                                <span class="text-xs text-slate-500 shrink-0">
                                    {{ $evento->start_date ? $evento->start_date->format('d/m/Y') : \Illuminate\Support\Carbon::parse($evento->created_at)->format('d/m/Y') }}
                                </span>
                            </div>

                            <h3 class="text-xl font-semibold text-gray-dark leading-snug line-clamp-2">
                                {{ $evento->title }}
                            </h3>

                            @if ($evento->start_time || $evento->end_time)
                            <p class="mt-2 text-sm font-medium text-slate-500">
                                <i class="fa-regular fa-clock mr-1"></i>
                                {{ $evento->start_time ? \Illuminate\Support\Carbon::parse($evento->start_time)->format('H:i') : '--:--' }}
                                @if ($evento->end_time)
                                - {{ \Illuminate\Support\Carbon::parse($evento->end_time)->format('H:i') }}
                                @endif
                            </p>
                            @endif

                            @if ($evento->content)
                            <p class="mt-2 text-sm text-slate-600 line-clamp-3">
                                {{ \Illuminate\Support\Str::limit(strip_tags($evento->content), 110) }}
                            </p>
                            @endif
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>

        <button type="button" class="events-prev absolute left-0 top-1/2 -translate-y-1/2
                bg-white/80 hover:bg-white rounded-full w-10 h-10
                flex items-center justify-center shadow-md z-10 -ml-4
                disabled:opacity-50 disabled:cursor-not-allowed transition">
            <i class="fa-solid fa-chevron-left text-slate-700"></i>
        </button>

        <button type="button" class="events-next absolute right-0 top-1/2 -translate-y-1/2
                bg-white/80 hover:bg-white rounded-full w-10 h-10
                flex items-center justify-center shadow-md z-10 -mr-4
                disabled:opacity-50 disabled:cursor-not-allowed transition">
            <i class="fa-solid fa-chevron-right text-slate-700"></i>
        </button>
    </div>

    <div class="events-indicators flex justify-center mt-4 space-x-2"></div>
    @else
    <div class="border-2 border-dashed border-slate-300 rounded-2xl bg-slate-50 py-16 text-center">
        <i class="fa-regular fa-calendar-xmark text-5xl text-slate-300 mb-4"></i>
        <p class="text-slate-500 font-medium">Nenhum evento cadastrado no momento.</p>
    </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fallbackImage = '/assets/images/banner1.jpg';

        document.querySelectorAll('.events-container').forEach(function(container) {
            const carousel = container.querySelector('.events-carousel');
            if (!carousel) return;

            const track = carousel.querySelector('.events-slide-track');
            const slides = carousel.querySelectorAll('.events-slide');
            const prevButton = carousel.querySelector('.events-prev');
            const nextButton = carousel.querySelector('.events-next');
            const indicators = container.querySelector('.events-indicators');

            if (!track || slides.length === 0) return;

            let currentSlide = 0;
            let visibleSlides = 1;

            function updateVisibleSlides() {
                if (window.innerWidth < 768) {
                    visibleSlides = 1;
                } else {
                    visibleSlides = 3;
                }

                const maxSlide = Math.max(0, slides.length - visibleSlides);
                if (currentSlide > maxSlide) {
                    currentSlide = maxSlide;
                }

                updateCarousel();
                createIndicators();
            }

            function updateCarousel() {
                const slidePercentage = 100 / visibleSlides;
                const translateX = currentSlide * slidePercentage;
                track.style.transform = 'translateX(-' + translateX + '%)';
                updateButtons();
                updateIndicators();
            }

            function updateButtons() {
                const maxSlide = Math.max(0, slides.length - visibleSlides);
                if (prevButton) prevButton.disabled = currentSlide === 0;
                if (nextButton) nextButton.disabled = currentSlide >= maxSlide;
            }

            function next() {
                const maxSlide = Math.max(0, slides.length - visibleSlides);
                if (currentSlide < maxSlide) {
                    currentSlide++;
                    updateCarousel();
                }
            }

            function prev() {
                if (currentSlide > 0) {
                    currentSlide--;
                    updateCarousel();
                }
            }

            function goTo(index) {
                const maxSlide = Math.max(0, slides.length - visibleSlides);
                currentSlide = Math.min(Math.max(0, index), maxSlide);
                updateCarousel();
            }

            function createIndicators() {
                if (!indicators) return;
                indicators.innerHTML = '';

                const totalIndicators = Math.max(1, slides.length - visibleSlides + 1);

                for (let i = 0; i < totalIndicators; i++) {
                    const button = document.createElement('button');
                    button.type = 'button';
                    button.className = 'w-3 h-3 rounded-full transition-colors bg-gray-300 hover:bg-gray-400';
                    button.setAttribute('aria-label', 'Ir para slide ' + (i + 1));
                    button.addEventListener('click', function() {
                        goTo(i);
                    });
                    indicators.appendChild(button);
                }

                updateIndicators();
            }

            function updateIndicators() {
                if (!indicators) return;
                const buttons = indicators.querySelectorAll('button');
                buttons.forEach(function(button, index) {
                    if (index === currentSlide) {
                        button.classList.remove('bg-gray-300', 'hover:bg-gray-400');
                        button.classList.add('bg-blue-600');
                    } else {
                        button.classList.remove('bg-blue-600');
                        button.classList.add('bg-gray-300', 'hover:bg-gray-400');
                    }
                });
            }

            slides.forEach(function(slide) {
                const image = slide.querySelector('img');
                if (!image) return;
                image.addEventListener('error', function() {
                    image.onerror = null;
                    image.src = fallbackImage;
                });
            });

            if (nextButton) nextButton.addEventListener('click', next);
            if (prevButton) prevButton.addEventListener('click', prev);

            window.addEventListener('resize', function() {
                updateVisibleSlides();
            });

            updateVisibleSlides();
        });
    });
</script>