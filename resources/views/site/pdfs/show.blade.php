<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $pdf->title }} | PDFs</title>
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
      <div class="flex w-full items-center justify-center bg-slate-100 p-4 md:p-8">
        <div class="flex flex-col items-center gap-3 text-primary">
          <i class="fa-regular fa-file-pdf text-6xl md:text-7xl"></i>
          <span class="text-xs font-semibold uppercase tracking-[0.25em]">Documento PDF</span>
        </div>
      </div>

      <div class="p-6 md:p-10">
        <div class="mb-6 flex flex-wrap items-center gap-3">
          <span class="inline-flex rounded-full bg-primary/10 px-3 py-1 text-xs font-semibold uppercase tracking-widest text-primary">
            PDF
          </span>
          <span class="text-sm text-slate-500">
            Publicado em {{ \Illuminate\Support\Carbon::parse($pdf->created_at)->format('d/m/Y') }}
          </span>
          <span class="text-sm text-slate-500">
            Atualizado em {{ \Illuminate\Support\Carbon::parse($pdf->updated_at)->format('d/m/Y') }}
          </span>
        </div>

        <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between md:gap-8">
          <h1 class="flex-1 text-3xl font-bold text-slate-900 md:text-4xl">
            {{ $pdf->title }}
          </h1>

          <div class="flex flex-wrap items-center gap-2 md:justify-end">
            <a
              href="{{ route('site.pdf.index') }}"
              class="inline-flex items-center justify-center rounded-full border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-primary hover:text-primary"
            >
              <i class="fa-solid fa-arrow-left mr-2"></i>Voltar à lista
            </a>
            @if ($pdf->file_url)
              <a
                href="{{ $pdf->file_url }}"
                target="_blank"
                rel="noopener noreferrer"
                download
                class="inline-flex items-center justify-center rounded-full border border-transparent bg-primary px-4 py-2 text-sm font-semibold text-white transition hover:border-primary hover:bg-transparent hover:text-primary"
              >
                <i class="fa-solid fa-download mr-2"></i>Baixar PDF
              </a>
            @endif
          </div>
        </div>

        @if ($pdf->file_url)
          <div class="mt-8 overflow-hidden rounded-2xl border border-slate-200 bg-slate-50">
            <div class="flex items-center justify-between border-b border-slate-200 px-4 py-3">
              <div class="flex items-center gap-2 text-sm font-semibold text-slate-700">
                <i class="fa-regular fa-file-pdf text-primary"></i>
                Visualizador de PDF
              </div>
              <a
                href="{{ $pdf->file_url }}"
                target="_blank"
                rel="noopener noreferrer"
                class="inline-flex items-center gap-1.5 text-xs font-semibold text-primary transition hover:opacity-80"
              >
                <i class="fa-solid fa-up-right-from-square"></i>Abrir em nova aba
              </a>
            </div>
            <div class="bg-slate-100">
              <iframe
                src="{{ $pdf->file_url }}#toolbar=1&navpanes=1"
                title="Visualizar {{ $pdf->title }}"
                class="w-full bg-white"
                style="min-height: 85vh;"
              ></iframe>
            </div>
          </div>
        @else
          <div class="mt-8 rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-6 py-10 text-center">
            <i class="fa-regular fa-file-pdf text-4xl text-slate-300 mb-3"></i>
            <p class="text-slate-500 font-medium">Arquivo PDF não disponível para este registro.</p>
          </div>
        @endif
      </div>
    </article>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>

</html>
