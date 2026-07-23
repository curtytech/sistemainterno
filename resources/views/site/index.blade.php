<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="icon" href="/assets/images/favicon.png" />
  <title>Sistema Interno</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans bg-white text-slate-900">
  @php
  $departamentos = [
  ['nome' => 'Comercial', 'link' => '#'],
  ['nome' => 'Compras', 'link' => '#'],
  ['nome' => 'Controladoria', 'link' => '#'],
  ['nome' => 'Financeiro', 'link' => '#'],
  ['nome' => 'Fiscal/Contábil', 'link' => '#'],
  ['nome' => 'Gerência', 'link' => '#'],
  ['nome' => 'Jurídico', 'link' => '#'],
  ['nome' => 'Logística', 'link' => '#'],
  ['nome' => 'Manutenção', 'link' => '#'],
  ['nome' => 'Marketing', 'link' => '#'],
  ['nome' => 'NFe', 'link' => '#'],
  ['nome' => 'Orçamento', 'link' => '#'],
  ['nome' => 'Patrimonial', 'link' => '#'],
  ['nome' => 'PCP', 'link' => '#'],
  ['nome' => 'Pública', 'link' => '#'],
  ['nome' => 'Qualidade / PeD', 'link' => '#'],
  ['nome' => 'RH', 'link' => '#'],
  ['nome' => 'SST', 'link' => '#'],
  ['nome' => 'Sustentabilidade', 'link' => '#'],
  ['nome' => 'TI', 'link' => '#'],
  ];

  $linksUteis = [
  ['nome' => 'Conexão NFE', 'link' => 'https://www.conexaonfe.com.br/'],
  ['nome' => 'Mercos', 'link' => 'https://app.mercos.com/login/'],
  ['nome' => 'Hive Cloud - CTe', 'link' => 'https://cte.hivecloud.com.br/ctes'],
  ['nome' => 'Hive Cloud - MDFe', 'link' => 'https://mdfe.hivecloud.com.br/'],
  ['nome' => 'Universidade Sankhya', 'link' => 'https://ead.sankhya.com.br/login.php'],
  ['nome' => 'Sankhya Om', 'link' => 'https://sequoia.sankhyacloud.com.br/mge/'],
  ['nome' => 'Ordens de Serviço', 'link' => '#'],
  ['nome' => 'Manutenção', 'link' => '#'],
  ['nome' => 'Patrimonial', 'link' => 'https://forms.office.com/Pages/ResponsePage.aspx?id=iQL2wSFX90aaQLCc6Yi0DJLv1d-JqxVOkIzJSns4QY1UOTlMSFQ5NlYxUUdJTUw2UlhTSlJUR0dRNyQlQCN0PWcu'],
  ['nome' => 'TI', 'link' => '#'],
  ['nome' => 'Plataforma de Treinamentos', 'link' => 'https://gruposequoia.grupoimpulsionar.com/'],
  ['nome' => 'Admissão de Colaboradores', 'link' => 'https://forms.office.com/pages/responsepage.aspx?id=iQL2wSFX90aaQLCc6Yi0DJOpBteh8IVCkQqORfhz3J1UNjBVUkpSSjgwWlZUOEExWkhTSEM5SlVXTi4u&route=shorturl'],
  ['nome' => 'Solicitação Demissional', 'link' => 'https://forms.office.com/pages/responsepage.aspx?id=iQL2wSFX90aaQLCc6Yi0DJOpBteh8IVCkQqORfhz3J1UODhUVFgxN0YyME1TREZJT0pNV0tOVEU1Vy4u&route=shorturl'],
  ['nome' => 'Pontotel', 'link' => 'https://gestao.pontotel.com.br/#/cognito/login'],
  ['nome' => 'Canal de Ética', 'link' => 'https://contatoseguro.com.br/sequoiabrasil'],
  ['nome' => 'Canal da mulher', 'link' => 'https://contatoseguro.com.br/pt/canaldamulhersequoiabrasil'],
  ['nome' => 'Formulário Anônimo de Denuncia e Sugestões', 'link' => 'https://forms.office.com/pages/responsepage.aspx?id=iQL2wSFX90aaQLCc6Yi0DEUrqtMkBb1GmQq4S0B2acRUMDBDNzBBR0gyMVM2TzRQMkFaTlhUWTRYMCQlQCN0PWcu&route=shorturl'],
  ];

  $linksUteis = collect($linksUteis)->map(function (array $item) {
  $host = null;
  $logo = null;

  if ($item['link'] !== '#') {
  $host = parse_url($item['link'], PHP_URL_HOST);
  if (is_string($host) && $host !== '') {
  $logo = 'https://www.google.com/s2/favicons?domain=' . $host . '&sz=128';
  }
  }

  $palavras = preg_split('/\s+/', $item['nome']) ?: [];
  $iniciais = collect($palavras)
  ->filter()
  ->take(2)
  ->map(fn (string $palavra) => mb_strtoupper(mb_substr($palavra, 0, 1)))
  ->implode('');

  return [
  'nome' => $item['nome'],
  'link' => $item['link'],
  'host' => $host,
  'logo' => $logo,
  'iniciais' => $iniciais !== '' ? $iniciais : 'SI',
  ];
  })->values();

  $contatos = [
  [
  'nome' => 'Sequoia',
  'endereco' => 'Rua Waldemar Colombo Garcia, 491, Santo Aleixo, Magé - RJ, 25926',
  'link' => '#',
  ],
  [
  'nome' => 'Shasta',
  'endereco' => 'Estrada Adam Blumer, 6225, Magé - RJ, 25931-128',
  'link' => '#',
  ],
  [
  'nome' => 'Ocotillo',
  'endereco' => 'BR-040, Pedro do Rio, Areal - RJ, 25845-000',
  'link' => '#',
  ],
  [
  'nome' => 'Valeric',
  'endereco' => 'Estrada Adam Blumer, 6225, Magé - RJ, 25931-128',
  'link' => '#',
  ],
  ];

  $departamentosColunas = collect($departamentos)->chunk((int) ceil(count($departamentos) / 3));
  $linksUteisColunas = collect($linksUteis)->chunk((int) ceil(count($linksUteis) / 3));
  @endphp
  <!-- Header -->
  <header class="bg-gray-dark sticky top-0 z-50">
    <div class="container mx-auto flex justify-between items-center py-4">
      <!-- Left section: Logo -->
      <a href="{{ route('site.index') }}" class="flex items-center">
        <div class="ml-5">
          <!-- <img src="/assets/images/template-white-logo.png" alt="Logo" class="h-14 w-auto mr-4"> -->
          <a href="{{ route('site.index') }}" class="text-white font-semibold pl-5">Sistema Interno</a>
        </div>
      </a>

      <!-- Hamburger menu (for mobile) -->
      <div class="flex lg:hidden">
        <button id="hamburger" class="text-white focus:outline-none">
          <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6h16M4 12h16m-7 6h7"></path>
          </svg>
        </button>
      </div>

      <!-- Center section: Menu -->
      <nav class="hidden lg:flex md:flex-grow justify-center">
        <ul class="flex justify-center space-x-4 text-white">
          <li><a href="{{ route('site.index') }}" class="font-semibold hover:text-secondary">Home</a></li>
          <li><a href="https://sequoiatortillas.sharepoint.com/sites/Bussoladoconhecimento" class="hover:text-secondary font-semibold">Bússola do Conhecimento</a></li>

          <!-- Men Dropdown -->
          <li class="relative group" x-data="{ open: false }">
            <a href="shop.html" @mouseover="open = true" @mouseleave="open = false" href="#" class="hover:text-secondary font-semibold flex items-center">
              Departamentos
              <i :class="open ? 'fa-solid fa-chevron-up ml-1 text-xs' : 'fa-solid fa-chevron-down ml-1 text-xs'"></i>
            </a>
            <div
              x-show="open"
              @mouseover="open = true"
              @mouseleave="open = false"
              class="mega-menu-panel"
              x-transition:enter="transition ease-out duration-100"
              x-transition:enter-start="opacity-0 scale-90"
              x-transition:enter-end="opacity-100 scale-100"
              x-transition:leave="transition ease-in duration-100"
              x-transition:leave-start="opacity-100 scale-100"
              x-transition:leave-end="opacity-0 scale-90">
              <div class="mb-4 border-b border-slate-200 px-3 pb-3">
                <p class="text-sm font-semibold text-slate-900">Departamentos</p>
                <p class="mt-1 text-xs text-slate-500">Acesso rapido aos principais setores da intranet.</p>
              </div>
              <div class="mega-menu-grid">
                @foreach ($departamentosColunas as $coluna)
                <div class="mega-menu-column space-y-1">
                  @foreach ($coluna as $item)
                  <div>
                    <a
                      href="{{ $item['link'] }}"
                      @if ($item['link'] !=='#' ) target="_blank" rel="noopener noreferrer" @endif
                      class="block rounded-lg px-3 py-2 text-sm leading-snug transition hover:bg-primary hover:text-white">
                      {{ $item['nome'] }}
                    </a>
                  </div>
                  @endforeach
                </div>
                @endforeach
              </div>
            </div>
          </li>

          <li class="relative group" x-data="{ open: false }">
            <a href="shop.html" @mouseover="open = true" @mouseleave="open = false" href="#" class="hover:text-secondary font-semibold flex items-center">
              Links Úteis
              <i :class="open ? 'fa-solid fa-chevron-up ml-1 text-xs' : 'fa-solid fa-chevron-down ml-1 text-xs'"></i>
            </a>
            <div
              x-show="open"
              @mouseover="open = true"
              @mouseleave="open = false"
              class="mega-menu-panel"
              x-transition:enter="transition ease-out duration-100"
              x-transition:enter-start="opacity-0 scale-90"
              x-transition:enter-end="opacity-100 scale-100"
              x-transition:leave="transition ease-in duration-100"
              x-transition:leave-start="opacity-100 scale-100"
              x-transition:leave-end="opacity-0 scale-90">
              <div class="mb-4 border-b border-slate-200 px-3 pb-3">
                <p class="text-sm font-semibold text-slate-900">Links Uteis</p>
                <p class="mt-1 text-xs text-slate-500">Ferramentas, formularios e plataformas de uso frequente.</p>
              </div>
              <div class="mega-menu-grid">
                @foreach ($linksUteisColunas as $coluna)
                <div class="mega-menu-column space-y-1">
                  @foreach ($coluna as $item)
                  <div>
                    <a
                      href="{{ $item['link'] }}"
                      @if ($item['link'] !=='#' ) target="_blank" rel="noopener noreferrer" @endif
                      class="block rounded-lg px-3 py-2 text-sm leading-snug transition hover:bg-primary hover:text-white">
                      {{ $item['nome'] }}
                    </a>
                  </div>
                  @endforeach
                </div>
                @endforeach
              </div>
            </div>
          </li>

          <li><a href="#events" class="hover:text-secondary font-semibold">Eventos</a></li>
          <li><a href="#news" class="hover:text-secondary font-semibold">Noticias</a></li>
        </ul>
      </nav>

      <!-- Right section: Buttons (for desktop) -->
      <div class="hidden lg:flex items-center space-x-4 relative">
        <a href="{{ route('filament.admin.pages.dashboard') }}"
          class="bg-primary border border-primary hover:bg-transparent text-white hover:text-primary font-semibold px-4 py-2 rounded-full inline-block">Área Interna</a>
      </div>
    </div>
  </header>

  <!-- Mobile menu -->
  <nav id="mobile-menu-placeholder" class="mobile-menu hidden flex-col items-center space-y-8 lg:hidden">
    <ul class="w-full space-y-2">
      <li>
        <a href="{{ route('site.index') }}" class="block rounded-xl px-4 py-3 font-semibold transition hover:bg-white/10">Home</a>
      </li>
      <li>
        <a href="https://sequoiatortillas.sharepoint.com/sites/Bussoladoconhecimento" target="_blank" rel="noopener noreferrer" class="block rounded-xl px-4 py-3 font-semibold transition hover:bg-white/10">Bússola do Conhecimento</a>
      </li>
      <li class="rounded-2xl border border-white/10 bg-white/5 px-2 py-1" x-data="{ open: false }">
        <button type="button" @click="open = !open" class="flex w-full items-center justify-between rounded-xl px-2 py-3 text-left font-semibold">
          <span>Departamentos</span>
          <i :class="open ? 'fa-solid fa-chevron-up text-xs' : 'fa-solid fa-chevron-down text-xs'"></i>
        </button>
        <ul class="mobile-dropdown-menu" x-show="open" x-transition>
          @foreach ($departamentos as $item)
          <li>
            <a
              href="{{ $item['link'] }}"
              class="block rounded-xl px-4 py-2 text-sm font-medium transition hover:bg-primary hover:text-white">
              {{ $item['nome'] }}
            </a>
          </li>
          @endforeach
        </ul>
      </li>
      <li class="rounded-2xl border border-white/10 bg-white/5 px-2 py-1" x-data="{ open: false }">
        <button type="button" @click="open = !open" class="flex w-full items-center justify-between rounded-xl px-2 py-3 text-left font-semibold">
          <span>Links Úteis</span>
          <i :class="open ? 'fa-solid fa-chevron-up text-xs' : 'fa-solid fa-chevron-down text-xs'"></i>
        </button>
        <ul class="mobile-dropdown-menu" x-show="open" x-transition>
          @foreach ($linksUteis as $item)
          <li>
            <a
              href="{{ $item['link'] }}"
              @if ($item['link'] !=='#' ) target="_blank" rel="noopener noreferrer" @endif
              class="block rounded-xl px-4 py-2 text-sm font-medium transition hover:bg-primary hover:text-white">
              {{ $item['nome'] }}
            </a>
          </li>
          @endforeach
        </ul>
      </li>
      <li>
        <a href="#eventos" class="block rounded-xl px-4 py-3 font-semibold transition hover:bg-white/10">Eventos</a>
      </li>
      <li>
        <a href="#news" class="block rounded-xl px-4 py-3 font-semibold transition hover:bg-white/10">Noticias</a>
      </li>
    </ul>
    <div class="mt-4 flex w-full flex-col items-stretch">
      <a
        href="{{ route('filament.admin.pages.dashboard') }}"
        class="flex w-full items-center justify-center rounded-full border border-primary bg-primary px-4 py-3 font-semibold text-white transition hover:bg-transparent hover:text-primary">
        Área Interna
      </a>
    </div>
  </nav>

  <!-- Slider -->
  <section id="product-slider">
    <div class="main-slider swiper-container relative" data-carousel data-autoplay-ms="5000">
      <div class="swiper-wrapper">
        @forelse ($boards as $board)
        <div class="swiper-slide">
          <img src="{{ $board->image_url }}" alt="{{ $board->title }}">
          <div class="swiper-slide-content">
            <h2 class="mb-2 text-3xl font-bold text-white md:mb-4 md:text-7xl">{{ $board->title }}</h2>
            <p class="mb-4 text-white md:text-2xl">{{ \Illuminate\Support\Str::limit($board->content, 120) }}</p>
            <div class="flex flex-wrap items-center gap-3">
              @if ($board->link)
              <a
                href="{{ $board->link }}"
                target="_blank"
                rel="noopener noreferrer"
                class="inline-block rounded-full border border-transparent bg-primary px-4 py-2 font-semibold text-white hover:border-white hover:bg-transparent hover:text-white">
                Acessar link
              </a>
              @endif
              @if ($board->file_url)
              <a
                href="{{ $board->file_url }}"
                target="_blank"
                rel="noopener noreferrer"
                class="inline-block rounded-full border border-white bg-white/10 px-4 py-2 font-semibold text-white hover:bg-white hover:text-slate-900">
                Baixar arquivo
              </a>
              @endif
            </div>
          </div>
        </div>
        @empty
        <div class="swiper-slide">
          <img src="/assets/images/main-slider/5.jpg" alt="Banner principal">
          <div class="swiper-slide-content">
            <h2 class="mb-2 text-3xl font-bold text-white md:mb-4 md:text-7xl">Sistema Interno</h2>
            <p class="mb-4 text-white md:text-2xl">Acesse comunicados, documentos e links importantes em um so lugar.</p>
            <a href="#news"
              class="inline-block rounded-full border border-transparent bg-primary px-4 py-2 font-semibold text-white hover:border-white hover:bg-transparent hover:text-white">
              Ver noticias
            </a>
          </div>
        </div>
        @endforelse
      </div>
      <button
        type="button"
        class="slider-nav-button slider-nav-prev"
        data-carousel-prev
        aria-label="Voltar slide">
        <i class="fa-solid fa-chevron-left"></i>
      </button>
      <button
        type="button"
        class="slider-nav-button slider-nav-next"
        data-carousel-next
        aria-label="Avançar slide">
        <i class="fa-solid fa-chevron-right"></i>
      </button>
    </div>
  </section>

  <!-- Links uteis section -->
  <section id="links-uteis" class="bg-white py-16 px-4">
    <div class="container mx-auto max-w-screen-xl px-4 testimonials">
      <div class="text-center mb-12 lg:mb-20">
        <h2 class="text-5xl font-bold mb-4">Links <span class="text-primary">Úteis</span></h2>
        <p class="my-7">Acesse rapidamente as principais plataformas usadas no dia a dia.</p>
      </div>
      <div class="swiper brands-swiper-slider relative" data-carousel data-autoplay-ms="3200">
        <div class="swiper-wrapper">
          @foreach ($linksUteis as $item)
          <a
            href="{{ $item['link'] !== '#' ? $item['link'] : '#' }}"
            @if ($item['link'] !=='#' ) target="_blank" rel="noopener noreferrer" @endif
            class="swiper-slide flex min-h-[11rem] min-w-[13rem] flex-col items-center justify-center rounded-2xl border border-slate-200 bg-slate-50 p-6 text-center shadow-sm transition hover:-translate-y-1 hover:border-primary hover:bg-white hover:shadow-lg">
            <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">
              @if ($item['logo'])
              <img src="{{ $item['logo'] }}" alt="Logo {{ $item['nome'] }}" class="h-10 w-10 rounded-xl object-contain">
              @else
              <span class="text-lg font-bold tracking-wide text-primary">{{ $item['iniciais'] }}</span>
              @endif
            </div>
            <h3 class="text-sm font-semibold leading-snug text-slate-900">{{ $item['nome'] }}</h3>
            <p class="mt-2 text-xs text-slate-500">
              {{ $item['host'] ?? 'Link interno em breve' }}
            </p>
          </a>
          @endforeach
        </div>
        <button
          type="button"
          class="slider-nav-button slider-nav-prev slider-nav-button-light"
          data-carousel-prev
          aria-label="Voltar links úteis">
          <i class="fa-solid fa-chevron-left"></i>
        </button>
        <button
          type="button"
          class="slider-nav-button slider-nav-next slider-nav-button-light"
          data-carousel-next
          aria-label="Avançar links úteis">
          <i class="fa-solid fa-chevron-right"></i>
        </button>
      </div>
  </section>


  <!-- News section -->
  <section id="news">
    <div class="container mx-auto px-4 text-center">
      <div class="container mx-auto max-w-screen-xl px-4 testimonials">
        <div class="text-center mb-12 lg:mb-20">
          <h2 class="text-5xl font-bold mb-4 text-primary">Notícias</h2>
          <p class="my-7">Acesse rapidamente as principais notícias do sistema interno.</p>
        </div>
      </div>
      @if ($noticias->isNotEmpty())
      <div class="flex flex-wrap -mx-4">
        @foreach ($noticias as $noticia)
        <div class="w-full sm:w-1/2 lg:w-1/4 px-4 mb-8">
          <article class="bg-white p-3 rounded-lg shadow-lg h-full flex flex-col">
            <img src="{{ $noticia->image }}" alt="{{ $noticia->title }}" class="w-full h-52 object-cover mb-4 rounded-lg">
            <h3 class="text-lg font-semibold mb-2">{{ $noticia->title }}</h3>
            <p class="my-2 text-sm font-medium text-primary uppercase tracking-wide">{{ $noticia->category_name }}</p>
            <p class="mb-4 text-sm text-gray-txt">{{ \Illuminate\Support\Str::limit($noticia->content, 110) }}</p>
            <div class="mt-auto flex items-center justify-between gap-3">
              <span class="text-sm font-semibold text-gray-900">{{ \Illuminate\Support\Carbon::parse($noticia->created_at)->format('d/m/Y') }}</span>
              <a href="#news" class="bg-primary border border-transparent hover:bg-transparent hover:border-primary text-white hover:text-primary font-semibold py-2 px-4 rounded-full inline-flex items-center justify-center">
                Ler mais
              </a>
            </div>
          </article>
        </div>
        @endforeach
      </div>
      @else
      <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-6 py-14 text-center">
        <h3 class="text-2xl font-semibold text-slate-800">Nenhuma notícia cadastrada</h3>
        <p class="mt-3 text-slate-500">Assim que houver notícias no banco, elas aparecerão automaticamente nesta seção.</p>
      </div>
      @endif
    </div>
  </section>


  <!-- Banner section -->
  <!-- <section id="banner" class="relative my-16">
    <div class="container mx-auto px-4 py-20 rounded-lg relative bg-cover bg-center" style="background-image: url('/assets/images/banner1.jpg');">
      <div class="absolute inset-0 bg-black opacity-40 rounded-lg"></div>
      <div class="relative flex flex-col items-center justify-center h-full text-center text-white py-20">
        <h2 class="text-4xl font-bold mb-4">Welcome to Our Shop</h2>
        <div class="flex space-x-4">
          <a href="#" class="bg-primary hover:bg-transparent text-white hover:text-primary border border-transparent hover:border-primary font-semibold px-4 py-2 rounded-full inline-block">Shop Now</a>
          <a href="#" class="bg-primary hover:bg-transparent text-white hover:text-primary border border-transparent hover:border-primary font-semibold px-4 py-2 rounded-full inline-block">New Arrivals</a>
          <a href="#" class="bg-primary hover:bg-transparent text-white hover:text-primary border border-transparent hover:border-primary font-semibold px-4 py-2 rounded-full inline-block">Sale</a>
        </div>
      </div>
    </div>
  </section> -->

  <!-- Eventos section -->
  <section id="eventos" class="py-16">
    <div class="text-center mb-12 lg:mb-20">
      <h2 class="text-5xl font-bold mb-4">Próximos <span class="text-primary">Eventos</span></h2>
      <p class="my-7">Acompanhe comunicados, treinamentos e ações internas da Sequoia.</p>
    </div>
    <div class="relative items-center w-full px-5 py-12 mx-auto md:px-12 lg:px-24 max-w-7xl">
      @if ($eventos->isNotEmpty())
      <div class="grid w-full grid-cols-1 gap-6 mx-auto lg:grid-cols-3">
        @foreach ($eventos as $evento)
        <article class="flex h-full flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-lg">
          <img
            class="h-56 w-full object-cover object-center"
            src="{{ $evento->image }}"
            alt="{{ $evento->title }}">
          <div class="flex flex-1 flex-col p-6">
            <div class="mb-4 flex items-center justify-between gap-3">
              <span class="inline-flex rounded-full bg-primary/10 px-3 py-1 text-xs font-semibold uppercase tracking-widest text-primary">
                {{ $evento->category_name }}
              </span>
              <span class="text-sm text-slate-500">
                {{ \Illuminate\Support\Carbon::parse($evento->created_at)->format('d/m/Y') }}
              </span>
            </div>
            <h3 class="mb-4 text-2xl font-semibold leading-tight text-gray-dark">
              {{ $evento->title }}
            </h3>
            <p class="flex-grow text-base font-medium leading-relaxed text-gray-txt">
              {{ \Illuminate\Support\Str::limit($evento->content, 160) }}
            </p>
            <div class="mt-8">
              <a href="#eventos" class="inline-flex w-full items-center justify-center rounded-full border border-transparent bg-primary px-4 py-2 font-semibold text-white transition hover:border-primary hover:bg-transparent hover:text-primary">
                Ver detalhes
              </a>
            </div>
          </div>
        </article>
        @endforeach
      </div>
      @else
      <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-6 py-14 text-center">
        <h3 class="text-2xl font-semibold text-slate-800">Nenhum evento cadastrado</h3>
        <p class="mt-3 text-slate-500">Assim que houver eventos no banco, eles aparecerão automaticamente nesta seção.</p>
      </div>
      @endif
    </div>
  </section>


  <!-- Contatos section -->
  <section id="contatos" class="bg-gray-dark py-16 text-white">
    <div class="container mx-auto px-4">
      <div class="mb-10 text-center">
        <h2 class="text-4xl font-bold">Contatos</h2>
        <p class="mt-3 text-slate-300">Unidades e endereços principais da empresa.</p>
      </div>
      <div class="flex gap-6 justify-center mt-6">
        @foreach ($contatos as $contato)
        <a
          href="{{ $contato['link'] }}"
          class="group rounded-3xl border border-white/10 bg-white/5 p-5 transition hover:border-primary hover:bg-white/10 w-full">
          <div class="flex flex-col items-center text-center">
            <div class="flex h-20 w-20 items-center justify-center rounded-2xl border border-dashed border-white/15 bg-gray-dark/50 text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
              Logo
            </div>
            <h3 class="mt-5 text-2xl font-semibold text-white">{{ $contato['nome'] }}</h3>
            <p class="mt-4 text-base font-medium leading-7 text-slate-200">{{ $contato['endereco'] }}</p>
          </div>
        </a>
        @endforeach
      </div>
    </div>
  </section>

  <footer class="border-t border-gray-line bg-gray-dark text-white">
    <div class="container mx-auto px-4 py-8">
      <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-4">
        <div>
          <h3 class="text-lg font-semibold">Conta</h3>
          <ul class="mt-4 space-y-2 text-sm text-slate-300">
            <li><a href="{{ route('site.index') }}" class="transition hover:text-primary">Home</a></li>
            <li><a href="{{ route('filament.admin.pages.dashboard') }}" class="transition hover:text-primary">Área Interna</a></li>
            <li><a href="#news" class="transition hover:text-primary">Notícias</a></li>
            <li><a href="#eventos" class="transition hover:text-primary">Eventos</a></li>
            <li><a href="#contatos" class="transition hover:text-primary">Contatos</a></li>
          </ul>
        </div>
        <div>
          <h3 class="text-lg font-semibold">Links Úteis</h3>
          <ul class="mt-4 space-y-2 text-sm text-slate-300">
            @foreach (collect($linksUteis)->take(5) as $item)
            <li>
              <a href="{{ $item['link'] }}" @if ($item['link'] !=='#' ) target="_blank" rel="noopener noreferrer" @endif class="transition hover:text-primary">
                {{ $item['nome'] }}
              </a>
            </li>
            @endforeach
          </ul>
        </div>
        <div>
          <h3 class="text-lg font-semibold">Departamentos</h3>
          <ul class="mt-4 space-y-2 text-sm text-slate-300">
            @foreach (collect($departamentos)->take(5) as $item)
            <li><a href="{{ $item['link'] }}" class="transition hover:text-primary">{{ $item['nome'] }}</a></li>
            @endforeach
          </ul>
        </div>
        <div>
          <h3 class="text-lg font-semibold">Redes Sociais</h3>
          <div class="mt-4 flex flex-wrap gap-3">
            <a href="#" aria-label="Facebook" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/15 text-white transition hover:border-primary hover:bg-primary">
              <i class="fa-brands fa-facebook-f"></i>
            </a>
            <a href="#" aria-label="Instagram" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/15 text-white transition hover:border-primary hover:bg-primary">
              <i class="fa-brands fa-instagram"></i>
            </a>
            <a href="#" aria-label="LinkedIn" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/15 text-white transition hover:border-primary hover:bg-primary">
              <i class="fa-brands fa-linkedin-in"></i>
            </a>
            <a href="#" aria-label="YouTube" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/15 text-white transition hover:border-primary hover:bg-primary">
              <i class="fa-brands fa-youtube"></i>
            </a>
          </div>
          <p class="mt-4 text-sm text-slate-400">© {{ now()->year }} Sistema Interno</p>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</body>

</html>
