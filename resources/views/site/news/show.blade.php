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
  <main class="mx-auto max-w-5xl px-4 py-10">
    <div class="mb-8 flex flex-wrap items-center gap-3">
      <a href="{{ route('site.news.index') }}" class="rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-primary hover:text-primary">Voltar para notícias</a>
      <a href="{{ route('site.index') }}" class="rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-primary hover:text-primary">Voltar ao site</a>
    </div>

    <article class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
      <img src="{{ $noticia->image_url }}" alt="{{ $noticia->title }}" class="h-72 w-full object-cover md:h-96">
      <div class="p-6 md:p-10">
        <div class="mb-6 flex flex-wrap items-center gap-3">
          <span class="inline-flex rounded-full bg-primary/10 px-3 py-1 text-xs font-semibold uppercase tracking-widest text-primary">
            {{ $noticia->category_name }}
          </span>
          <span class="text-sm text-slate-500">{{ \Illuminate\Support\Carbon::parse($noticia->created_at)->format('d/m/Y') }}</span>
        </div>

        <h1 class="text-3xl font-bold text-slate-900 md:text-5xl">{{ $noticia->title }}</h1>
        <div class="mt-6 text-base leading-8 text-slate-700">
          {!! nl2br(e($noticia->content)) !!}
        </div>
      </div>
    </article>
  </main>
</body>

</html>
