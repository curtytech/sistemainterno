<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Conteúdos | Ápice</title>
  <link rel="icon" type="icon" href="/assets/images/favicon.png" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 font-sans text-slate-900">
  @include('site.partials.navbar')

  <main class="mx-auto max-w-7xl px-4 py-12">
    <div class="mb-12 text-center">
      <p class="text-sm font-semibold uppercase tracking-[0.2em] text-primary">Conteúdo completo</p>
      <h1 class="mt-3 text-4xl font-bold text-slate-900">Notícias e eventos em uma só página</h1>
      <p class="mx-auto mt-4 max-w-3xl text-slate-600">Acompanhe tudo o que foi publicado no sistema interno com paginação separada para cada seção.</p>
    </div>

    <section id="conteudos-noticias">
      <div class="mb-8 flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
        <div>
          <h2 class="text-3xl font-bold text-primary">Notícias</h2>
          <p class="mt-2 text-slate-600">Comunicados, novidades e atualizações da operação.</p>
        </div>
        <a href="{{ route('site.news.index') }}" class="text-sm font-semibold text-primary transition hover:opacity-80">Abrir página só de notícias</a>
      </div>

      @if ($noticias->isNotEmpty())
      <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
        @foreach ($noticias as $noticia)
        <article class="flex h-full flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white p-3 shadow-lg">
          <img src="{{ $noticia->image_url }}" alt="{{ $noticia->title }}" class="mb-4 h-52 w-full rounded-lg object-cover">
          <h3 class="mb-2 text-lg font-semibold">{{ $noticia->title }}</h3>
          <p class="my-2 text-sm font-medium uppercase tracking-wide text-primary">{{ $noticia->category_name }}</p>
          <p class="mb-4 text-sm text-gray-txt">{{ \Illuminate\Support\Str::limit($noticia->content, 110) }}</p>
          <div class="mt-auto flex items-center justify-center gap-3 ">
            <a href="{{ route('site.news.show', $noticia) }}" class="w-full inline-flex items-center justify-center rounded-full border border-transparent bg-primary px-4 py-2 font-semibold text-white transition hover:border-primary hover:bg-transparent hover:text-primary">
              Ler mais
            </a>
          </div>
        </article>
        @endforeach
      </div>

      @else
      <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-14 text-center">
        <h3 class="text-2xl font-semibold text-slate-800">Nenhuma notícia cadastrada</h3>
        <p class="mt-3 text-slate-500">Assim que houver notícias no sistema, elas aparecerão nesta página.</p>
      </div>
      @endif
    </section>

    <section id="conteudos-eventos" class="mt-20">
      <div class="mb-8 flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
        <div>
          <h2 class="text-3xl font-bold text-slate-900">Eventos</h2>
          <p class="mt-2 text-slate-600">Treinamentos, comunicados e ações internas publicados no sistema.</p>
        </div>
        <a href="{{ route('site.events.index') }}" class="text-sm font-semibold text-primary transition hover:opacity-80">Abrir página só de eventos</a>
      </div>

      @if ($eventos->isNotEmpty())
      <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        @foreach ($eventos as $evento)
        <article class="flex h-full flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-lg">
          <img src="{{ $evento->image_url }}" alt="{{ $evento->title }}" class="h-56 w-full object-cover object-center">
          <div class="flex flex-1 flex-col p-6">
            <div class="mb-4 flex items-center justify-between gap-3">
              <span class="inline-flex rounded-full bg-primary/10 px-3 py-1 text-xs font-semibold uppercase tracking-widest text-primary">
                {{ $evento->category_name }}
              </span>
              <span class="text-sm text-slate-500">{{ $evento->start_date ? $evento->start_date->format('d/m/Y') : \Illuminate\Support\Carbon::parse($evento->created_at)->format('d/m/Y') }}</span>
            </div>
            <h3 class="mb-4 text-2xl font-semibold leading-tight text-gray-dark">{{ $evento->title }}</h3>
            @if ($evento->start_time || $evento->end_time)
            <p class="mb-4 text-sm font-medium text-slate-500">
              {{ $evento->start_time ? \Illuminate\Support\Carbon::parse($evento->start_time)->format('H:i') : '--:--' }}
              @if ($evento->end_time)
              - {{ \Illuminate\Support\Carbon::parse($evento->end_time)->format('H:i') }}
              @endif
            </p>
            @endif
            <p class="flex-grow text-base font-medium leading-relaxed text-gray-txt">{{ \Illuminate\Support\Str::limit(strip_tags($evento->content), 160) }}</p>
            <div class="mt-8">
              <a href="{{ route('site.events.show', $evento) }}" class="inline-flex w-full items-center justify-center rounded-full border border-transparent bg-primary px-4 py-2 font-semibold text-white transition hover:border-primary hover:bg-transparent hover:text-primary">
                Ver detalhes
              </a>
            </div>
          </div>
        </article>
        @endforeach
      </div>

      
      @else
      <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-14 text-center">
        <h3 class="text-2xl font-semibold text-slate-800">Nenhum evento cadastrado</h3>
        <p class="mt-3 text-slate-500">Assim que houver eventos no sistema, eles aparecerão nesta página.</p>
      </div>
      @endif
    </section>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>

</html>
