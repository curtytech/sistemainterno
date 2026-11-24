<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vídeos | Ápice</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 font-sans text-slate-900">
    @include('site.partials.navbar')

    <main class="mx-auto max-w-7xl px-4 py-12">
        <header class="mb-12 text-center">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-primary">Vídeos</p>
            <h1 class="mt-3 text-4xl font-bold text-slate-900">Vídeos do YouTube</h1>
            <p class="mx-auto mt-4 max-w-3xl text-slate-600">Assista aos vídeos incorporados ou abra-os diretamente no YouTube.</p>
        </header>

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @forelse ($videos as $video)
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
                    <h2 class="text-lg font-semibold">{{ $video->name }}</h2>
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
            @empty
                <div class="col-span-full rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-14 text-center">
                    <h2 class="text-2xl font-semibold text-slate-800">Nenhum vídeo cadastrado</h2>
                    <p class="mt-3 text-slate-500">Os vídeos adicionados no painel administrativo aparecerão aqui.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $videos->links() }}
        </div>
    </main>
</body>

</html>
