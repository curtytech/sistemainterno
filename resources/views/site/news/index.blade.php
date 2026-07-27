<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notícias | Sistema Interno</title>
  <link rel="icon" type="icon" href="/assets/images/favicon.png" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 font-sans text-slate-900">
  <header class="border-b border-slate-200 bg-white">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-5">
      <a href="{{ route('site.index') }}" class="text-lg font-semibold text-slate-900">Sistema Interno</a>
      <nav class="flex items-center gap-3">
        <a href="{{ route('site.index') }}" class="rounded-full border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-primary hover:text-primary">Voltar ao site</a>
        <a href="{{ route('site.events.index') }}" class="rounded-full bg-primary px-4 py-2 text-sm font-semibold text-white transition hover:opacity-90">Ver eventos</a>
      </nav>
    </div>
  </header>

  <main class="mx-auto max-w-7xl px-4 py-12">
    <div class="mb-10 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
      <div>
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-primary">Conteúdo</p>
        <h1 class="mt-2 text-4xl font-bold text-slate-900">Todas as notícias</h1>
        <p class="mt-3 max-w-2xl text-slate-600">Acompanhe os comunicados e atualizações mais recentes do sistema interno.</p>
      </div>
      <a href="{{ route('site.index') }}#news" class="text-sm font-semibold text-primary transition hover:opacity-80">Voltar para a seção da home</a>
    </div>

    @if ($noticias->isNotEmpty())
    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
      @foreach ($noticias as $noticia)
      <article class="flex h-full flex-col overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
        <img src="{{ $noticia->image_url }}" alt="{{ $noticia->title }}" class="h-56 w-full object-cover">
        <div class="flex flex-1 flex-col p-6">
          <div class="mb-4 flex items-center justify-between gap-3">
            <span class="inline-flex rounded-full bg-primary/10 px-3 py-1 text-xs font-semibold uppercase tracking-widest text-primary">
              {{ $noticia->category_name }}
            </span>
            <span class="text-sm text-slate-500">{{ \Illuminate\Support\Carbon::parse($noticia->created_at)->format('d/m/Y') }}</span>
          </div>
          <h2 class="text-2xl font-semibold text-slate-900">{{ $noticia->title }}</h2>
          <p class="mt-4 flex-1 text-sm leading-7 text-slate-600">{{ \Illuminate\Support\Str::limit($noticia->content, 180) }}</p>
          <div class="mt-6">
            <a href="{{ route('site.news.show', $noticia) }}" class="inline-flex rounded-full border border-transparent bg-primary px-4 py-2 text-sm font-semibold text-white transition hover:border-primary hover:bg-transparent hover:text-primary">
              Ler notícia
            </a>
          </div>
        </div>
      </article>
      @endforeach
    </div>

    <div class="mt-10">
      {{ $noticias->links() }}
    </div>
    @else
    <div class="rounded-3xl border border-dashed border-slate-300 bg-white px-6 py-14 text-center">
      <h2 class="text-2xl font-semibold text-slate-800">Nenhuma notícia cadastrada</h2>
      <p class="mt-3 text-slate-500">Assim que houver notícias no sistema, elas aparecerão nesta página.</p>
    </div>
    @endif
  </main>
</body>

</html>
