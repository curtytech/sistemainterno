<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biblioteca de Documentos | Ápice</title>
  <link rel="icon" type="icon" href="/assets/images/favicon.png" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 font-sans text-slate-900">
  @include('site.partials.navbar')

  <main class="mx-auto max-w-7xl px-4 py-12">
    <div class="mb-10 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
      <div>
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-primary">Biblioteca</p>
        <h1 class="mt-2 text-4xl font-bold text-slate-900">Biblioteca de Documentos</h1>
        <p class="mt-3 max-w-2xl text-slate-600">Acesse rapidamente os documentos e setores disponíveis na intranet.</p>
      </div>
      <a href="{{ route('site.index') }}" class="text-sm font-semibold text-primary transition hover:opacity-80">
        <i class="fa-solid fa-arrow-left mr-1.5"></i>Voltar para a home
      </a>
    </div>

    @if ($documentLibraries->isNotEmpty())
      <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-7">
        @foreach ($documentLibraries as $document)
          <a href="{{ $document->link }}" target="_blank" rel="noopener noreferrer"
             class="flex min-w-0 flex-col items-center justify-center overflow-hidden rounded-2xl border border-slate-200 bg-white p-3 text-center shadow-sm transition hover:-translate-y-1 hover:border-primary hover:shadow-lg">
            @if ($document->icon_url)
              <div class="mb-3 flex h-16 w-full items-center justify-center rounded-xl bg-slate-50">
                <img src="{{ $document->icon_url }}" alt="" class="h-14 max-w-full object-contain p-2">
              </div>
            @else
              <div class="mb-3 flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-50 text-base font-bold tracking-wide text-primary">
                {{ collect(preg_split('/\s+/', $document->name) ?: [])->filter()->take(2)->map(fn ($word) => mb_strtoupper(mb_substr($word, 0, 1)))->implode('') }}
              </div>
            @endif
            <h2 class="break-words text-sm font-semibold leading-snug text-slate-900">{{ $document->name }}</h2>
          </a>
        @endforeach
      </div>
    @else
      <div class="rounded-3xl border border-dashed border-slate-300 bg-white px-6 py-14 text-center">
        <i class="fa-solid fa-folder-open mb-4 text-5xl text-slate-300"></i>
        <h2 class="text-2xl font-semibold text-slate-800">Nenhum documento cadastrado</h2>
      </div>
    @endif
  </main>
</body>

</html>
