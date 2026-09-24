@php
    if (! isset($pdfs)) {
        $pdfs = \App\Models\Pdf::latest()->limit(21)->get();
    }
@endphp

<div class="pdfs-container container mx-auto px-5">
    <div class="mb-10 text-center">
        <h2 class="text-5xl font-bold mb-4">Arquivos <span class="text-primary">PDFs</span></h2>
        <p class="mt-3 text-slate-700">Documentos, formulários, manuais e comunicados em PDF da Sequoia.</p>

        <div class="flex flex-wrap items-center justify-center gap-3 mt-4">
            <a href="{{ route('site.pdf.index') }}" class="inline-flex rounded-full border border-primary px-4 py-2 text-sm font-semibold text-primary transition hover:bg-primary hover:text-white">
                Veja mais
            </a>
            <a href="{{ route('site.content.index') }}" class="inline-flex rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-primary hover:text-primary">
                Ver tudo em uma página
            </a>
        </div>
    </div>

    @if ($pdfs->isNotEmpty())
        <div class="pdfs-carousel relative">
            <div class="relative overflow-hidden rounded-lg">
                <div class="pdfs-slide-track flex slide-transition">
                    @foreach($pdfs as $pdf)
                        <div class="pdfs-slide w-full md:w-1/3 flex-shrink-0 px-2 py-4">
                            <div class="block rounded-lg overflow-hidden shadow-md h-full transition hover:shadow-xl hover:-translate-y-0.5 duration-200 bg-white">
                                <a href="{{ route('site.pdf.show', $pdf) }}" class="block">
                                    <div class="bg-slate-100 h-48 md:h-56 flex items-center justify-center p-4 border-b border-slate-200">
                                        <div class="flex flex-col items-center gap-2 text-primary transition group-hover:text-primary-600">
                                            <i class="fa-regular fa-file-pdf text-6xl"></i>
                                            <span class="text-[11px] font-semibold uppercase tracking-[0.2em]">Documento PDF</span>
                                        </div>
                                    </div>

                                    <div class="p-4">
                                        <div class="mb-3 flex items-center justify-between gap-2">
                                            <span class="inline-flex rounded-full bg-primary/10 px-2.5 py-1 text-[11px] font-semibold uppercase tracking-widest text-primary">
                                                PDF
                                            </span>
                                            <span class="text-xs text-slate-500 shrink-0">
                                                {{ \Illuminate\Support\Carbon::parse($pdf->created_at)->format('d/m/Y') }}
                                            </span>
                                        </div>

                                        <h3 class="text-xl font-semibold text-gray-dark leading-snug line-clamp-2 min-h-[3rem]">
                                            {{ $pdf->title }}
                                        </h3>

                                        <p class="mt-2 text-sm text-slate-600 line-clamp-2">
                                            Clique para visualizar o documento completo em tela cheia.
                                        </p>
                                    </div>
                                </a>

                                <div class="px-4 pb-4 flex flex-col gap-2">
                                    <a
                                        href="{{ route('site.pdf.show', $pdf) }}"
                                        class="inline-flex w-full items-center justify-center rounded-full border border-transparent bg-primary px-3 py-2 text-xs font-semibold text-white transition hover:border-primary hover:bg-transparent hover:text-primary"
                                    >
                                        <i class="fa-solid fa-eye mr-2"></i>Visualizar
                                    </a>
                                    @if ($pdf->file_url)
                                        <a
                                            href="{{ $pdf->file_url }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            download
                                            class="inline-flex w-full items-center justify-center rounded-full border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-700 transition hover:border-primary hover:text-primary"
                                        >
                                            <i class="fa-solid fa-download mr-2"></i>Baixar PDF
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="button" class="pdfs-prev absolute left-0 top-1/2 -translate-y-1/2
                bg-white/80 hover:bg-white rounded-full w-10 h-10
                flex items-center justify-center shadow-md z-10 -ml-4
                disabled:opacity-50 disabled:cursor-not-allowed transition">
                <i class="fa-solid fa-chevron-left text-slate-700"></i>
            </button>

            <button type="button" class="pdfs-next absolute right-0 top-1/2 -translate-y-1/2
                bg-white/80 hover:bg-white rounded-full w-10 h-10
                flex items-center justify-center shadow-md z-10 -mr-4
                disabled:opacity-50 disabled:cursor-not-allowed transition">
                <i class="fa-solid fa-chevron-right text-slate-700"></i>
            </button>
        </div>

        <div class="pdfs-indicators flex justify-center mt-4 space-x-2"></div>
    @else
        <div class="border-2 border-dashed border-slate-300 rounded-2xl bg-slate-50 py-16 text-center">
            <i class="fa-regular fa-file-pdf text-5xl text-slate-300 mb-4"></i>
            <p class="text-slate-500 font-medium">Nenhum PDF cadastrado no momento.</p>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.pdfs-container').forEach(function (container) {
            const carousel = container.querySelector('.pdfs-carousel');
            if (! carousel) return;

            const track = carousel.querySelector('.pdfs-slide-track');
            const slides = carousel.querySelectorAll('.pdfs-slide');
            const prevButton = carousel.querySelector('.pdfs-prev');
            const nextButton = carousel.querySelector('.pdfs-next');
            const indicators = container.querySelector('.pdfs-indicators');

            if (! track || slides.length === 0) return;

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
                if (! indicators) return;
                indicators.innerHTML = '';

                const totalIndicators = Math.max(1, slides.length - visibleSlides + 1);

                for (let i = 0; i < totalIndicators; i++) {
                    const button = document.createElement('button');
                    button.type = 'button';
                    button.className = 'w-3 h-3 rounded-full transition-colors bg-gray-300 hover:bg-gray-400';
                    button.setAttribute('aria-label', 'Ir para slide ' + (i + 1));
                    button.addEventListener('click', function () { goTo(i); });
                    indicators.appendChild(button);
                }

                updateIndicators();
            }

            function updateIndicators() {
                if (! indicators) return;
                const buttons = indicators.querySelectorAll('button');
                buttons.forEach(function (button, index) {
                    if (index === currentSlide) {
                        button.classList.remove('bg-gray-300', 'hover:bg-gray-400');
                        button.classList.add('bg-blue-600');
                    } else {
                        button.classList.remove('bg-blue-600');
                        button.classList.add('bg-gray-300', 'hover:bg-gray-400');
                    }
                });
            }

            if (nextButton) nextButton.addEventListener('click', next);
            if (prevButton) prevButton.addEventListener('click', prev);

            window.addEventListener('resize', function () {
                updateVisibleSlides();
            });

            updateVisibleSlides();
        });
    });
</script>
