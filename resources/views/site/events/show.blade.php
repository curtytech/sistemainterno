<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $evento->title }} | Eventos</title>
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
        <img src="{{ $evento->image_url }}" alt="{{ $evento->title }}" class="max-h-[32rem] w-full object-contain">
      </div>
      <div class="p-6 md:p-10">
        <div class="mb-6 flex flex-wrap items-center gap-3">
          <span class="inline-flex rounded-full bg-primary/10 px-3 py-1 text-xs font-semibold uppercase tracking-widest text-primary">
            {{ $evento->category_name }}
          </span>
          <span class="text-sm text-slate-500">
            {{ $evento->start_date ? $evento->start_date->format('d/m/Y') : \Illuminate\Support\Carbon::parse($evento->created_at)->format('d/m/Y') }}
            @if ($evento->end_date && $evento->end_date->ne($evento->start_date))
            ate {{ $evento->end_date->format('d/m/Y') }}
            @endif
          </span>
          @if ($evento->start_time || $evento->end_time)
          <span class="text-sm text-slate-500">
            {{ $evento->start_time ? \Illuminate\Support\Carbon::parse($evento->start_time)->format('H:i') : '--:--' }}
            @if ($evento->end_time)
            - {{ \Illuminate\Support\Carbon::parse($evento->end_time)->format('H:i') }}
            @endif
          </span>
          @endif
        </div>

        <h1 class="text-3xl font-bold text-slate-900 md:text-5xl">{{ $evento->title }}</h1>
        <div class="mt-6 text-base leading-8 text-slate-700">
          {!! $evento->content !!}
        </div>
      </div>
    </article>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</body>

</html>
