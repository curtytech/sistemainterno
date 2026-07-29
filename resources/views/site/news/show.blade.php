<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $noticia->title }} | Notícias</title>
  <link rel="icon" type="icon" href="/assets/images/favicon.png" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 font-sans text-slate-900">
  @include('site.partials.navbar')

  <main class="mx-auto max-w-6xl px-4 py-10 md:py-14">

    <article class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
      <div class="grid gap-0 lg:grid-cols-[360px_minmax(0,1fr)]">
        <div class="border-b border-slate-200 bg-slate-100 lg:border-b-0 lg:border-r">
          <img src="{{ $noticia->image_url }}" alt="{{ $noticia->title }}" class="h-64 w-full object-cover md:h-80 lg:h-full">
        </div>

        <div class="p-6 md:p-8">
          <div class="mb-4 flex flex-wrap items-center gap-3">
            <span class="inline-flex rounded-full bg-primary/10 px-3 py-1 text-xs font-semibold uppercase tracking-widest text-primary">
              {{ $noticia->category_name }}
            </span>
            <span class="text-sm font-medium text-slate-500">Publicado em {{ \Illuminate\Support\Carbon::parse($noticia->created_at)->format('d/m/Y') }}</span>
          </div>

          <h1 class="text-3xl font-bold text-slate-900 md:text-4xl">{{ $noticia->title }}</h1>

          <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
              <p class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">Categoria</p>
              <p class="mt-2 text-sm font-semibold text-slate-900">{{ $noticia->category_name ?? 'Nao informada' }}</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
              <p class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">Publicado em</p>
              <p class="mt-2 text-sm font-semibold text-slate-900">{{ \Illuminate\Support\Carbon::parse($noticia->created_at)->format('d/m/Y') }}</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
              <p class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">Atualizado em</p>
              <p class="mt-2 text-sm font-semibold text-slate-900">{{ \Illuminate\Support\Carbon::parse($noticia->updated_at)->format('d/m/Y') }}</p>
            </div>
          </div>

          <div class="mt-8 rounded-2xl border border-slate-200 p-5 md:p-6">
            <h2 class="text-lg font-semibold text-slate-900">Conteudo da noticia</h2>
            <div class="mt-4 whitespace-pre-line text-base leading-8 text-slate-700">
              {{ $noticia->content }}
            </div>
          </div>
        </div>
      </div>
    </article>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</body>

</html>
