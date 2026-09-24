<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PDFs | Ápice</title>
  <link rel="icon" type="icon" href="/assets/images/favicon.png" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 font-sans text-slate-900">
  @include('site.partials.navbar')

  <main class="mx-auto max-w-7xl px-4 py-12">
    <div class="mb-10 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
      <div>
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-primary">Biblioteca</p>
        <h1 class="mt-2 text-4xl font-bold text-slate-900">Todos os PDFs</h1>
        <p class="mt-3 max-w-2xl text-slate-600">Documentos, formulários, manuais e comunicados em PDF disponíveis para consulta e download.</p>
      </div>
      <a href="{{ route('site.index') }}" class="text-sm font-semibold text-primary transition hover:opacity-80">
        <i class="fa-solid fa-arrow-left mr-1.5"></i>Voltar para a home
      </a>
    </div>

    @if ($pdfs->isNotEmpty())
      <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        @foreach ($pdfs as $pdfItem)
          <article class="group flex h-full flex-col overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition hover:shadow-lg">
            <div class="flex h-56 w-full items-center justify-center bg-slate-100 p-6">
              <div class="flex flex-col items-center gap-3 text-slate-500 transition group-hover:text-primary">
                <i class="fa-regular fa-file-pdf text-6xl"></i>
                <span class="text-xs font-semibold uppercase tracking-widest">Documento PDF</span>
              </div>
            </div>

            <div class="flex flex-1 flex-col p-6">
              <div class="mb-4 flex items-center justify-between gap-3">
                <span class="inline-flex rounded-full bg-primary/10 px-3 py-1 text-xs font-semibold uppercase tracking-widest text-primary">
                  PDF
                </span>
                <span class="text-sm text-slate-500">
                  {{ \Illuminate\Support\Carbon::parse($pdfItem->created_at)->format('d/m/Y') }}
                </span>
              </div>

              <h2 class="text-2xl font-semibold leading-tight text-slate-900 line-clamp-2 min-h-[3.5rem]">
                {{ $pdfItem->title }}
              </h2>

              <div class="mt-4 flex-1" aria-hidden="true"></div>

              <div class="mt-6 flex flex-col gap-2">
                <a
                  href="{{ route('site.pdf.show', $pdfItem) }}"
                  class="inline-flex items-center justify-center rounded-full border border-transparent bg-primary px-4 py-2 text-sm font-semibold text-white transition hover:border-primary hover:bg-transparent hover:text-primary"
                >
                  <i class="fa-solid fa-eye mr-2"></i>Visualizar
                </a>
                @if ($pdfItem->file_url)
                  <a
                    href="{{ $pdfItem->file_url }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    download
                    class="inline-flex items-center justify-center rounded-full border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-primary hover:text-primary"
                  >
                    <i class="fa-solid fa-download mr-2"></i>Baixar PDF
                  </a>
                @endif
              </div>
            </div>
          </article>
        @endforeach
      </div>

      <div class="mt-12">
        {{ $pdfs->links() }}
      </div>
    @else
      <div class="rounded-3xl border border-dashed border-slate-300 bg-white px-6 py-14 text-center">
        <i class="fa-regular fa-file-pdf text-5xl text-slate-300 mb-4"></i>
        <h2 class="text-2xl font-semibold text-slate-800">Nenhum PDF cadastrado</h2>
        <p class="mt-3 text-slate-500">Assim que houver documentos PDF no sistema, eles aparecerão nesta página.</p>
      </div>
    @endif
  </main>

  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>

</html>
