@php
    if (! isset($youtubeVideos)) {
        $youtubeVideos = \App\Models\YoutubeVideo::query()
            ->latest()
            ->limit(6)
            ->get();
    }
@endphp

<section id="videos" class="container mx-auto px-5 py-12">
    <div class="mb-10 text-center">
        <h2 class="mb-4 text-5xl font-bold">Vídeos <span class="text-primary">do YouTube</span></h2>
        <p class="mt-3 text-slate-700">Assista aos vídeos mais recentes da Sequoia.</p>
        <div class="mt-4">
            <a href="{{ route('site.youtube-videos.index') }}" class="inline-flex rounded-full border border-primary px-4 py-2 text-sm font-semibold text-primary transition hover:bg-primary hover:text-white">
                Ver todos os vídeos
            </a>
        </div>
    </div>

    @if ($youtubeVideos->isNotEmpty())
        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($youtubeVideos as $video)
                <article class="flex h-full flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-lg">
                    @if ($video->embed_url && $video->image_url)
                        <details class="group">
                            <summary class="relative block aspect-video cursor-pointer list-none bg-slate-900">
                                <img class="h-full w-full object-cover" src="{{ $video->image_url }}" alt="Capa do vídeo {{ $video->name }}" loading="lazy">
                                <span class="absolute inset-0 flex items-center justify-center bg-black/30 text-lg font-semibold text-white transition group-open:hidden">
                                    Reproduzir vídeo
                                </span>
                            </summary>
                            <div class="aspect-video bg-slate-900">
                                <iframe
                                    class="h-full w-full"
                                    src="{{ $video->embed_url }}"
                                    title="{{ $video->name }}"
                                    loading="lazy"
                                    referrerpolicy="strict-origin-when-cross-origin"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen></iframe>
                            </div>
                        </details>
                    @elseif ($video->embed_url)
                        <div class="aspect-video bg-slate-900">
                            <iframe
                                class="h-full w-full"
                                src="{{ $video->embed_url }}"
                                title="{{ $video->name }}"
                                loading="lazy"
                                referrerpolicy="strict-origin-when-cross-origin"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen></iframe>
                        </div>
                    @endif

                    <div class="flex flex-1 flex-col p-5">
                        <h3 class="text-lg font-semibold">{{ $video->name }}</h3>
                        @if ($video->description)
                            <p class="mt-3 flex-1 whitespace-pre-line text-sm text-slate-600">{{ $video->description }}</p>
                        @endif
                        @if ($video->embed_url)
                            <a
                                href="{{ $video->link }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="mt-5 inline-flex items-center justify-center rounded-full bg-primary px-4 py-2 font-semibold text-white transition hover:opacity-90">
                                Abrir no YouTube
                            </a>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    @else
        <div class="rounded-2xl border-2 border-dashed border-slate-300 bg-slate-50 py-16 text-center">
            <i class="fa-brands fa-youtube mb-4 text-5xl text-slate-300"></i>
            <p class="font-medium text-slate-500">Nenhum vídeo cadastrado no momento.</p>
        </div>
    @endif
</section>
