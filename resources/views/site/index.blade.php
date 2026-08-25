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
  ['nome' => 'Administrativo', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-Administrativo', 'image' => '/assets/icon/adm.jpeg'],
  ['nome' => 'Comercial', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-Comercial', 'image' => '/assets/icon/com.jpeg'],
  ['nome' => 'Compras', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-Compras', 'image' => '/assets/icon/comesup.jpeg'],
  ['nome' => 'Controladoria', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-Controladoria', 'image' => '/assets/icon/cont.jpeg'],
  ['nome' => 'Financeiro', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-Financeiro', 'image' => '/assets/icon/fin.jpeg'],
  ['nome' => 'Fiscal/Contábil', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-Fiscal_contabil', 'image' => '/assets/icon/fis.jpeg'],
  ['nome' => 'Gerência', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-Gerencia', 'image' => '/assets/icon/ger.jpeg'],
  ['nome' => 'Jurídico', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-juridico/SitePages/CollabHome.aspx', 'image' => '/assets/icon/jur.jpeg'],
  ['nome' => 'Logística', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-Logistica', 'image' => '/assets/icon/logetrans.jpeg'],
  ['nome' => 'Manutenção', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-Manutencao', 'image' => '/assets/icon/man.jpeg'],
  ['nome' => 'Marketing', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-Marketing', 'image' => '/assets/icon/mark.jpeg'],
  ['nome' => 'NFe', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-NF', 'image' => '/assets/icon/nfe.jpeg'],
  ['nome' => 'Orçamento', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-Orcamento', 'image' => '/assets/icon/orc.jpeg'],
  ['nome' => 'Patrimonial', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-Patrimonial', 'image' => '/assets/icon/pat.jpeg'],
  ['nome' => 'PCP', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-PCP', 'image' => '/assets/icon/pcp.jpeg'],
  ['nome' => 'Pública', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-Publica', 'image' => '/assets/icon/publ.jpeg'],
  ['nome' => 'Qualidade / PeD', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-Qualidade/SitePages/CollabHome.aspx', 'image' => '/assets/icon/quali.jpeg'],
  ['nome' => 'RH', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-RH', 'image' => '/assets/icon/rh.jpeg'],
  ['nome' => 'SST', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-SST', 'image' => '/assets/icon/sst.jpeg'],
  ['nome' => 'Sustentabilidade', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/Departamento-Sustentabilidade', 'image' => '/assets/icon/sust.jpeg'],
  ['nome' => 'TI', 'link' => 'https://sequoiatortillas.sharepoint.com/sites/intrasequoia/SitePages/Inova%C3%A7%C3%B5es-Tecnol%C3%B3gicas.aspx', 'image' => '/assets/icon/inov.jpeg'],
  ];

  $linksUteis = [
  ['nome' => 'Qive', 'link' => 'https://qive.com.br/', 'logo' => 'https://www.google.com/s2/favicons?domain=qive.com.br&sz=128'],
  ['nome' => 'Mercos', 'link' => 'https://app.mercos.com/login/', 'logo' => 'https://www.google.com/s2/favicons?domain=mercos.com&sz=128'],
  ['nome' => 'Hive Cloud - CTe', 'link' => 'https://cte.hivecloud.com.br/ctes', 'logo' => 'https://www.google.com/s2/favicons?domain=hivecloud.com.br&sz=128'],
  ['nome' => 'Hive Cloud - MDFe', 'link' => 'https://mdfe.hivecloud.com.br/', 'logo' => 'https://www.google.com/s2/favicons?domain=hivecloud.com.br&sz=128'],
  ['nome' => 'Universidade Sankhya', 'link' => 'https://ead.sankhya.com.br/login.php', 'logo' => 'https://www.google.com/s2/favicons?domain=sankhya.com.br&sz=128'],
  ['nome' => 'Sankhya Om', 'link' => 'https://sequoia.sankhyacloud.com.br/mge/', 'logo' => 'https://www.google.com/s2/favicons?domain=sankhya.com.br&sz=128'],
  ['nome' => 'Manutenção', 'link' => 'https://forms.office.com/Pages/ResponsePage.aspx?id=iQL2wSFX90aaQLCc6Yi0DLMaVurEnZBCsdqn3fvEx5RURUtYQTBPVUdSQk05RkY5TTJVSU0wV0w4My4u', 'logo' => 'https://www.google.com/s2/favicons?domain=forms.office.com&sz=128'],
  ['nome' => 'Patrimonial', 'link' => 'https://forms.office.com/Pages/ResponsePage.aspx?id=iQL2wSFX90aaQLCc6Yi0DJLv1d-JqxVOkIzJSns4QY1UOTlMSFQ5NlYxUUdJTUw2UlhTSlJUR0dRNyQlQCN0PWcu', 'logo' => 'https://www.google.com/s2/favicons?domain=forms.office.com&sz=128'],
  ['nome' => 'Plataforma de Treinamentos', 'link' => 'https://gruposequoia.grupoimpulsionar.com/', 'logo' => '/assets/logo-grupo-sequoia.png'],
  ['nome' => 'Admissão de Colaboradores', 'link' => 'https://forms.office.com/pages/responsepage.aspx?id=iQL2wSFX90aaQLCc6Yi0DJOpBteh8IVCkQqORfhz3J1UNjBVUkpSSjgwWlZUOEExWkhTSEM5SlVXTi4u&route=shorturl'],
  ['nome' => 'Solicitação Demissional', 'link' => 'https://forms.office.com/pages/responsepage.aspx?id=iQL2wSFX90aaQLCc6Yi0DJOpBteh8IVCkQqORfhz3J1UODhUVFgxN0YyME1TREZJT0pNV0tOVEU1Vy4u&route=shorturl'],
  ['nome' => 'Pontotel', 'link' => 'https://gestao.pontotel.com.br/#/cognito/login', 'logo' => 'https://www.google.com/s2/favicons?domain=pontotel.com.br&sz=128'],
  ['nome' => 'Canal de Ética', 'link' => 'https://contatoseguro.com.br/sequoiabrasil'],
  ['nome' => 'Canal da mulher', 'link' => 'https://contatoseguro.com.br/pt/canaldamulhersequoiabrasil'],
  ['nome' => 'Formulário Anônimo de Denuncia e Sugestões', 'link' => 'https://forms.office.com'],
  ];

  $linksUteis = collect($linksUteis)->map(function (array $item) {
  $host = null;
  $logo = $item['logo'] ?? null;

  if ($item['link'] !== '#') {
  $host = parse_url($item['link'], PHP_URL_HOST);
  $logo ??= 'https://www.google.com/s2/favicons?sz=128&domain_url=' . urlencode($item['link']);
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

  $departamentos = collect($departamentos)->map(function (array $item) {
  $host = null;
  if ($item['link'] !== '#') {
  $host = parse_url($item['link'], PHP_URL_HOST);
  }
  $palavras = preg_split('/\s+|\/|\//', $item['nome']) ?: [];
  $iniciais = collect($palavras)
  ->filter()
  ->take(2)
  ->map(fn (string $palavra) => mb_strtoupper(mb_substr($palavra, 0, 1)))
  ->implode('');
  return [
  'nome' => $item['nome'],
  'link' => $item['link'],
  'host' => $host,
  'image' => $item['image'] ?? null,
  'iniciais' => $iniciais !== '' ? $iniciais : 'DP',
  ];
  })->values();

  $contatos = [
  [
  'nome' => 'Sequoia',
  'endereco' => 'Rua Waldemar Colombo Garcia, 491, Santo Aleixo, Magé - RJ, 25926',
  'link' => 'https://www.sequoiaalimentos.com.br/',
  'logo' => '/assets/sequoialogo.png',
  ],
  [
  'nome' => 'Shasta',
  'endereco' => 'Estrada Adam Blumer, 6225, Magé - RJ, 25931-128',
  'link' => 'https://www.shastadistribuidora.com.br/',
  'logo' => '/assets/Shastalogo.png',
  ],
  [
  'nome' => 'Ocotillo',
  'endereco' => 'BR-040, Pedro do Rio, Areal - RJ, 25845-000',
  'link' => '#',
  'logo' => '/assets/Ocotillologo.png',
  ],
  [
  'nome' => 'Valeric',
  'endereco' => 'Estrada Adam Blumer, 6225, Magé - RJ, 25931-128',
  'link' => '#',
  'logo' => '/assets/Valericlogo.png',
  ],
  ];

  $departamentosColunas = collect($departamentos)->chunk((int) ceil(count($departamentos) / 3));
  $linksUteisColunas = collect($linksUteis)->chunk((int) ceil(count($linksUteis) / 3));
  @endphp

  @include('site.partials.navbar')

   <!-- Slider -->
  <section id="product-slider">
    <div class="main-slider swiper-container relative" data-carousel data-autoplay-ms="5000">
      <div class="swiper-wrapper">
        @forelse ($boards as $board)
        <div class="swiper-slide">
          <img src="{{ $board->image_url }}" alt="{{ $board->title }}">
          <div class="swiper-slide-content">
            <h2 class="mb-2 text-3xl font-bold text-white md:mb-4 md:text-7xl ml-5">{{ $board->title }}</h2>
            <p class="mb-4 text-white md:text-2xl ml-5">{{ \Illuminate\Support\Str::limit($board->content, 120) }}</p>
            <div class="flex flex-wrap items-center gap-3 ml-5">
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
                class="inline-block rounded-full border border-white bg-white/10 px-4 py-2 font-semibold text-white ">
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

  <div class="text-slate-900 font-sans bg-white ">
    <section id="links-uteis" class="bg-white py-8 px-4 ">
      <div class="container mx-auto max-w-screen-xl px-4 testimonials">
        <div class="text-center mb-8">
          <h2 class="text-3xl font-bold mb-2 ">Links <span class="text-primary">Úteis</span></h2>
          <p class="text-slate-600">Acesse rapidamente as principais plataformas usadas no dia a dia.</p>
        </div>
        <div class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
          @foreach ($linksUteis as $item)
          <a
            href="{{ $item['link'] !== '#' ? $item['link'] : '#' }}"
            @if ($item['link'] !=='#' ) target="_blank" rel="noopener noreferrer" @endif
            class="flex min-h-[11rem] flex-col items-center justify-center rounded-2xl border border-slate-200 bg-slate-50 p-4 text-center shadow-sm transition hover:-translate-y-1 hover:border-primary hover:bg-white hover:shadow-lg">
            <div class="mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-white shadow-sm ring-1 ring-slate-200 p-2">
              @if ($item['logo'])
              <img src="{{ $item['logo'] }}" alt="Logo {{ $item['nome'] }}" class="h-9 w-9 rounded-xl object-contain">
              @else
              <span class="text-base font-bold tracking-wide text-primary">{{ $item['iniciais'] }}</span>
              @endif
            </div>
            <h3 class="text-sm font-semibold leading-snug text-slate-900">{{ $item['nome'] }}</h3>
            <p class="mt-1 text-xs text-slate-500">
              {{ $item['host'] ?? 'Link interno em breve' }}
            </p>
          </a>
          @endforeach
        </div>
    </section>


    <!-- Departamentos section -->
    <section id="departamentos" class="bg-slate-50 py-8 px-4">
      <div class="container mx-auto max-w-screen-xl px-4">
        <div class="text-center mb-8">
          <h2 class="text-5xl font-bold mb-4 text-primary">Departamentos</h2>
          <p class="text-slate-600">Acesse rapidamente os canais de cada departamento.</p>
        </div>
        @php
        $linhas = [
        $departamentos->slice(0, 7)->values(),
        $departamentos->slice(7, 7)->values(),
        $departamentos->slice(14, 7)->values(),
        ];
        @endphp
        <div class="flex flex-col gap-3">
          @foreach ($linhas as $linha)
          <div class="flex items-stretch justify-center gap-3">
            @foreach ($linha as $item)
            <a
              href="{{ $item['link'] !== '#' ? $item['link'] : '#' }}"
              @if ($item['link'] !=='#' ) target="_blank" rel="noopener noreferrer" @endif
              class="flex flex-1 min-w-0 flex-col items-center justify-center rounded-2xl border border-slate-200 bg-white p-3 text-center shadow-sm transition hover:-translate-y-1 hover:border-primary hover:bg-slate-50 hover:shadow-lg overflow-hidden">
              @if ($item['image'])
              <div class="mb-3 flex h-20 w-full items-center justify-center rounded-xl overflow-hidden bg-slate-50">
                <img src="{{ $item['image'] }}" alt="{{ $item['nome'] }}" class="h-16 object-contain p-2">
              </div>
              @else
              <div class="mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-50 shadow-sm ring-1 ring-slate-200">
                <span class="text-base font-bold tracking-wide text-primary">{{ $item['iniciais'] }}</span>
              </div>
              @endif
              <h3 class="text-sm font-semibold leading-snug text-slate-900">{{ $item['nome'] }}</h3>

            </a>
            @endforeach
          </div>
          @endforeach
        </div>
    </section>


    <!-- News section -->
    <section id="news">
      <div class="container mx-auto px-4 text-center">
        <div class="container mx-auto max-w-screen-xl px-4 testimonials">
          <div class="text-center mb-12 lg:mb-20">
            <h2 class="text-5xl font-bold mb-4 text-primary">Notícias</h2>
            <p class="my-7">Acesse rapidamente as principais notícias do sistema interno.</p>
            <div class="flex flex-wrap items-center justify-center gap-3">
              <a href="{{ route('site.news.index') }}" class="inline-flex rounded-full border border-primary px-4 py-2 text-sm font-semibold text-primary transition hover:bg-primary hover:text-white">
                Veja mais
              </a>
              <a href="{{ route('site.content.index') }}" class="inline-flex rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-primary hover:text-primary">
                Ver tudo em uma página
              </a>
            </div>
          </div>
        </div>
        @if ($noticias->isNotEmpty())
        <div class="flex flex-wrap -mx-4">
          @foreach ($noticias as $noticia)
          <div class="w-full sm:w-1/2 lg:w-1/4 px-4 mb-8">
            <article class="bg-white p-3 rounded-lg shadow-lg h-full flex flex-col">
              <img src="{{ $noticia->image_url }}" alt="{{ $noticia->title }}" class="w-full h-52 object-cover mb-4 rounded-lg">
              <h3 class="text-lg font-semibold mb-2">{{ $noticia->title }}</h3>
              <p class="my-2 text-sm font-medium text-primary uppercase tracking-wide">{{ $noticia->category_name }}</p>
              <p class="mb-4 text-sm text-gray-txt">{{ \Illuminate\Support\Str::limit($noticia->content, 110) }}</p>
              <div class="mt-auto flex items-center justify-between gap-3">
                <span class="text-sm font-semibold text-gray-900">{{ \Illuminate\Support\Carbon::parse($noticia->created_at)->format('d/m/Y') }}</span>
                <a href="{{ route('site.news.show', $noticia) }}" class="bg-primary border border-transparent hover:bg-transparent hover:border-primary text-white hover:text-primary font-semibold py-2 px-4 rounded-full inline-flex items-center justify-center">
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
        <div class="flex flex-wrap items-center justify-center gap-3">
          <a href="{{ route('site.events.index') }}" class="inline-flex rounded-full border border-primary px-4 py-2 text-sm font-semibold text-primary transition hover:bg-primary hover:text-white">
            Veja mais
          </a>
          <a href="{{ route('site.content.index') }}" class="inline-flex rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-primary hover:text-primary">
            Ver tudo em uma página
          </a>
        </div>
      </div>
      <div class="relative items-center w-full px-5 py-12 mx-auto md:px-12 lg:px-24 max-w-7xl">
        @if ($eventos->isNotEmpty())
        <div class="grid w-full grid-cols-1 gap-6 mx-auto lg:grid-cols-3">
          @foreach ($eventos as $evento)
          <article class="flex h-full flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-lg">
            <img
              class="h-56 w-full object-cover object-center"
              src="{{ $evento->image_url }}"
              alt="{{ $evento->title }}">
            <div class="flex flex-1 flex-col p-6">
              <div class="mb-4 flex items-center justify-between gap-3">
                <span class="inline-flex rounded-full bg-primary/10 px-3 py-1 text-xs font-semibold uppercase tracking-widest text-primary">
                  {{ $evento->category_name }}
                </span>
                <span class="text-sm text-slate-500">
                  {{ $evento->start_date ? $evento->start_date->format('d/m/Y') : \Illuminate\Support\Carbon::parse($evento->created_at)->format('d/m/Y') }}
                </span>
              </div>
              <h3 class="mb-4 text-2xl font-semibold leading-tight text-gray-dark">
                {{ $evento->title }}
              </h3>
              @if ($evento->start_time || $evento->end_time)
              <p class="mb-4 text-sm font-medium text-slate-500">
                {{ $evento->start_time ? \Illuminate\Support\Carbon::parse($evento->start_time)->format('H:i') : '--:--' }}
                @if ($evento->end_time)
                - {{ \Illuminate\Support\Carbon::parse($evento->end_time)->format('H:i') }}
                @endif
              </p>
              @endif
              <p class="flex-grow text-base font-medium leading-relaxed text-gray-txt">
                {{ \Illuminate\Support\Str::limit(strip_tags($evento->content), 160) }}
              </p>
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
          <p class="mt-3 text-slate-300">Unidades e endereços principais das empresas.</p>
        </div>
        <div class="flex flex-col gap-6 justify-center mt-6 md:flex-row">
          @foreach ($contatos as $contato)
          <a
            href="{{ $contato['link'] }}"
            class="group rounded-3xl border border-white/10 bg-white/5 p-5 transition hover:border-primary hover:bg-white/10 w-full md:max-w-xs">
            <div class="flex flex-col items-center text-center">
              <div class="flex h-20 w-28 items-center justify-center rounded-2xl border border-dashed border-white/15 bg-white px-3 py-2 shadow-sm">
                <img
                  src="{{ $contato['logo'] }}"
                  alt="Logo {{ $contato['nome'] }}"
                  class="h-full w-full object-contain">
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
            <h3 class="text-lg font-semibold">Portal</h3>
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
              <a href="https://www.instagram.com/sequoia.alimentos/" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/15 text-white transition hover:border-primary hover:bg-primary">
                <i class="fa-brands fa-instagram"></i>
              </a>
              <a href="https://www.instagram.com/garytos/" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/15 text-white transition hover:border-primary hover:bg-primary">
                <i class="fa-brands fa-instagram"></i>
              </a>

            </div>
            <p class="mt-4 text-sm text-slate-400">© {{ now()->year }} Sistema Interno</p>
          </div>
        </div>
      </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  </div>
</body>

</html>