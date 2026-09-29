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
    @php
      $arquivos = $pdf->files_list;
      $totalArquivos = count($arquivos);
      $primeiro = $arquivos->first();
    @endphp
    <article
      class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm"
      x-data="{
        aberto: @js($totalArquivos === 1 ? [0] : []),
        carregado: @js($totalArquivos === 1 ? [0] : []),
        alternar(indice) {
          if (this.aberto.includes(indice)) {
            this.aberto = this.aberto.filter(i => i !== indice);
          } else {
            this.aberto.push(indice);
            if (! this.carregado.includes(indice)) {
              this.carregado.push(indice);
            }
            setTimeout(() => {
              const el = document.getElementById('pdf-accordion-' + indice);
              if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 250);
          }
        },
        abrirERolar(indice) {
          if (! this.aberto.includes(indice)) {
            this.aberto.push(indice);
            if (! this.carregado.includes(indice)) {
              this.carregado.push(indice);
            }
          }
          setTimeout(() => {
            const el = document.getElementById('pdf-accordion-' + indice);
            if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
          }, 250);
        },
        todosAbertos() {
          return this.aberto.length === @js($totalArquivos);
        },
        alternarTodos() {
          if (this.todosAbertos()) {
            this.aberto = [];
          } else {
            this.aberto = Array.from({length: @js($totalArquivos)}, (_, i) => i);
            const todos = Array.from({length: @js($totalArquivos)}, (_, i) => i);
            this.carregado = [...new Set([...this.carregado, ...todos])];
          }
        }
      }"
    >
      <div class="flex w-full flex-col items-center justify-center bg-slate-100 p-4 md:p-8">
        <div class="flex flex-col items-center gap-3 text-primary">
          <i class="fa-regular fa-file-pdf text-6xl md:text-7xl"></i>
          <span class="text-xs font-semibold uppercase tracking-[0.25em]">
            {{ $totalArquivos <= 1 ? 'Documento PDF' : "{$totalArquivos} documentos PDF" }}
          </span>
        </div>
      </div>

      <div class="p-6 md:p-10">
        <div class="mb-6 flex flex-wrap items-center gap-3">
          <span class="inline-flex rounded-full bg-primary/10 px-3 py-1 text-xs font-semibold uppercase tracking-widest text-primary">
            PDF{{ $totalArquivos > 1 ? 's' : '' }}
          </span>
          <span class="text-sm text-slate-500">
            Publicado em {{ \Illuminate\Support\Carbon::parse($pdf->created_at)->format('d/m/Y') }}
          </span>
          <span class="text-sm text-slate-500">
            Atualizado em {{ \Illuminate\Support\Carbon::parse($pdf->updated_at)->format('d/m/Y') }}
          </span>
          @if ($totalArquivos > 0)
            <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
              <i class="fa-solid fa-layer-group text-primary"></i>
              {{ $totalArquivos }} arquivo{{ $totalArquivos === 1 ? '' : 's' }}
            </span>
          @endif
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
            @if ($primeiro && ! empty($primeiro['file_url']))
              <a
                href="{{ $primeiro['file_url'] }}"
                target="_blank"
                rel="noopener noreferrer"
                download
                class="inline-flex items-center justify-center rounded-full border border-transparent bg-primary px-4 py-2 text-sm font-semibold text-white transition hover:border-primary hover:bg-transparent hover:text-primary"
              >
                <i class="fa-solid fa-download mr-2"></i>Baixar primeiro PDF
              </a>
            @endif
          </div>
        </div>

        @if ($arquivos->isNotEmpty())
          @if ($totalArquivos > 1)
            <div class="mt-8 rounded-2xl border border-slate-200 bg-slate-50/60 p-4 md:p-5">
              <div class="mb-3 flex flex-wrap items-center justify-between gap-3">
                <div class="flex items-center gap-2 text-sm font-semibold text-slate-700">
                  <i class="fa-solid fa-list text-primary"></i>
                  Todos os arquivos incluídos
                </div>
                <div class="flex items-center gap-2">
                  <button
                    type="button"
                    @click="alternarTodos()"
                    class="inline-flex items-center gap-1.5 rounded-full border border-primary/20 bg-white px-3 py-1.5 text-xs font-semibold text-primary transition hover:bg-primary hover:text-white"
                  >
                    <i class="fa-solid fa-layer-group"></i>
                    <span x-show="! todosAbertos()">Expandir todos</span>
                    <span x-show="todosAbertos()">Minimizar todos</span>
                  </button>
                </div>
              </div>
              <div class="grid gap-3 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($arquivos as $indice => $arquivo)
                  <button
                    type="button"
                    @click="abrirERolar({{ $indice }})"
                    class="group flex w-full items-center justify-between gap-3 rounded-2xl border border-slate-200 bg-white p-3 text-left shadow-sm transition hover:-translate-y-0.5 hover:border-primary hover:shadow-md"
                  >
                    <div class="flex min-w-0 items-center gap-3">
                      <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-50 text-red-600 ring-1 ring-red-100 group-hover:bg-red-100">
                        <i class="fa-regular fa-file-pdf text-lg"></i>
                      </div>
                      <div class="min-w-0 flex flex-col">
                        <span class="flex items-center gap-2 text-sm font-semibold text-slate-800 group-hover:text-primary">
                          <span class="inline-flex h-5 w-5 items-center justify-center rounded-full bg-slate-900 text-[10px] font-bold text-white">
                            {{ $indice + 1 }}
                          </span>
                          <span class="truncate">{{ $arquivo['filename'] }}</span>
                        </span>
                        <span class="mt-0.5 text-xs text-slate-500"
                              :class="aberto.includes({{ $indice }}) ? 'text-primary' : ''"
                              x-text="aberto.includes({{ $indice }}) ? 'Aberto · clique para minimizar' : 'Clique para abrir o visualizador'"
                        ></span>
                      </div>
                    </div>
                    <div class="flex shrink-0 items-center gap-1.5">
                      <i
                        class="fa-solid text-xs transition"
                        :class="aberto.includes({{ $indice }}) ? 'fa-minus text-primary' : 'fa-plus text-slate-400 group-hover:text-primary'"
                      ></i>
                    </div>
                  </button>
                @endforeach
              </div>
            </div>
          @endif

          <div class="mt-8 flex flex-col gap-4">
            @foreach ($arquivos as $indice => $arquivo)
              <div
                id="pdf-accordion-{{ $indice }}"
                class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-50"
                :class="aberto.includes({{ $indice }}) ? 'ring-2 ring-primary/10' : ''"
              >
                <button
                  type="button"
                  @click="alternar({{ $indice }})"
                  class="flex w-full flex-wrap items-center justify-between gap-3 border-b border-slate-200 bg-white px-4 py-3 text-left transition hover:bg-slate-50"
                >
                  <div class="flex items-center gap-3">
                    <span class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-slate-900 text-xs font-bold text-white">
                      {{ $indice + 1 }}
                    </span>
                    <div class="min-w-0 flex flex-col">
                      <div class="flex items-center gap-2 text-sm font-semibold text-slate-700">
                        <i class="fa-regular fa-file-pdf text-primary"></i>
                        Visualizador de PDF
                      </div>
                      <span class="truncate text-xs text-slate-500 max-w-[30ch] sm:max-w-[50ch] md:max-w-[70ch]">{{ $arquivo['filename'] }}</span>
                    </div>
                  </div>
                  <div class="flex items-center gap-1.5">
                    <a
                      href="{{ $arquivo['file_url'] }}"
                      target="_blank"
                      rel="noopener noreferrer"
                      download
                      @click.stop
                      class="inline-flex items-center gap-1.5 rounded-full border border-slate-200 px-2.5 py-1.5 text-[11px] font-semibold text-slate-700 transition hover:border-primary hover:text-primary"
                    >
                      <i class="fa-solid fa-download"></i>
                      <span class="hidden sm:inline">Baixar</span>
                    </a>
                    <a
                      href="{{ $arquivo['file_url'] }}"
                      target="_blank"
                      rel="noopener noreferrer"
                      @click.stop
                      class="inline-flex items-center gap-1.5 text-xs font-semibold text-primary transition hover:opacity-80 px-2 py-1 rounded-full hover:bg-primary/5"
                    >
                      <i class="fa-solid fa-up-right-from-square"></i>
                      <span class="hidden sm:inline">Nova aba</span>
                    </a>
                    <span class="ml-1 inline-flex h-8 w-8 items-center justify-center rounded-full border border-slate-200 bg-white">
                      <i
                        class="fa-solid fa-chevron-down text-sm text-slate-500 transition-all duration-300"
                        :class="aberto.includes({{ $indice }}) ? 'rotate-180 text-primary' : ''"
                      >
                      </i>
                    </span>
                  </div>
                </button>

                <div
                  class="overflow-hidden transition-all duration-500 ease-in-out"
                  x-show="aberto.includes({{ $indice }})"
                  x-collapse
                >
                  <div class="bg-slate-100">
                    <template x-if="carregado.includes({{ $indice }})">
                      <iframe
                        src="{{ $arquivo['file_url'] }}#toolbar=1&navpanes=1"
                        title="Visualizar {{ $arquivo['filename'] }}"
                        class="w-full bg-white"
                        style="min-height: 85vh;"
                        loading="lazy"
                      ></iframe>
                    </template>
                    <div
                      x-show="! carregado.includes({{ $indice }}) && aberto.includes({{ $indice }})"
                      class="flex h-[85vh] items-center justify-center bg-white"
                      style="display: none;"
                    >
                      <div class="flex flex-col items-center gap-3 text-slate-400">
                        <i class="fa-solid fa-spinner fa-spin text-3xl text-primary"></i>
                        <span class="text-sm font-semibold">Carregando visualizador de PDF…</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        @else
          <div class="mt-8 rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-6 py-10 text-center">
            <i class="fa-regular fa-file-pdf text-4xl text-slate-300 mb-3"></i>
            <p class="text-slate-500 font-medium">Nenhum arquivo PDF disponível para este registro.</p>
          </div>
        @endif
      </div>
    </article>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>

</html>
