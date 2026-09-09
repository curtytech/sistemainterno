    <!-- News section -->
    <section id="news">
      <div class="container mx-auto px-4 text-center">
        <div class="container mx-auto max-w-screen-xl px-4 testimonials">
          <div class="text-center mb-12 lg:mb-20">
            <h2 class="text-5xl font-bold mb-4 text-primary">Notícias em Destaque</h2>
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
        @if ($noticiasEmDestaque->isNotEmpty())
        <div class="flex flex-wrap -mx-4">
          @foreach ($noticiasEmDestaque as $noticia)
          <a href="{{ route('site.news.show', $noticia) }}">
            <div class="w-full sm:w-1/2 lg:w-1/4 px-4 mb-8">
              <article class="bg-white p-3 rounded-lg shadow-lg h-full flex flex-col">
                <img src="{{ $noticia->image_url }}" alt="{{ $noticia->title }}" class="w-full h-52 object-cover mb-4 rounded-lg">
                <h3 class="text-lg font-semibold mb-2">{{ $noticia->title }}</h3>
                <p class="my-2 text-sm font-medium text-primary uppercase tracking-wide">{{ $noticia->category_name }}</p>
                <p class="mb-2 text-sm text-gray-txt">{{ \Illuminate\Support\Str::limit($noticia->content, 110) }}</p>
                <div class="mt-auto flex items-center justify-center gap-3">
                  <a href="{{ route('site.news.show', $noticia) }}" class="bg-primary border border-transparent hover:bg-transparent hover:border-primary text-white hover:text-primary font-semibold py-2 px-4 rounded-full inline-flex items-center justify-center">
                    Ler mais
                  </a>
                </div>
              </article>
            </div>
          </a>
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
          <a href="{{ route('site.news.show', $noticia) }}">
            <div class="w-full sm:w-1/2 lg:w-1/4 px-4 mb-8">
              <article class="bg-white p-3 rounded-lg shadow-lg h-full flex flex-col">
                <img src="{{ $noticia->image_url }}" alt="{{ $noticia->title }}" class="w-full h-52 object-cover mb-4 rounded-lg">
                <h3 class="text-lg font-semibold mb-2">{{ $noticia->title }}</h3>
                <p class="my-2 text-sm font-medium text-primary uppercase tracking-wide">{{ $noticia->category_name }}</p>
                <p class="mb-2 text-sm text-gray-txt">{{ \Illuminate\Support\Str::limit($noticia->content, 110) }}</p>
                <div class="mt-auto flex items-center justify-center gap-3">
                  <a href="{{ route('site.news.show', $noticia) }}" class="bg-primary border border-transparent hover:bg-transparent hover:border-primary text-white hover:text-primary font-semibold py-2 px-4 rounded-full inline-flex items-center justify-center">
                    Ler mais
                  </a>
                </div>
              </article>
            </div>
          </a>
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
          <a href="{{ route('site.events.index') }}">
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
          </a>
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